<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use App\Time;
use App\Paye;
use App\Fee;
use App\User;
use App\Rebate;
use App\Exception;
use App\Agreement;
use App\Cost;
use App\Room;
use DB;
use Hekmatinasser\Verta\Verta;
use App\Imports\AgreementImport;
use Maatwebsite\Excel\Facades\Excel;


class SalaryController extends Controller
{
    //time
    public function add_time()
    {
        $time = Time::orderby('date', "DESC")->get();
        return view('salary.time', compact('time'));
    }
    public function insert_time(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ]);
        $inputData = $request->all();
        Time::create($inputData);
        return redirect()->route('add_time');
    }
    public function delete_time(Request $request)
    {
        DB::table('time')->where('id_time', $request->id_time)->delete();
        return redirect()->route('add_time');
    }
    //fee
    public function add_fee()
    {
        $all_paye = Paye::get();
        $fee = Fee::get();
        return view('salary.fee', compact('all_paye', 'fee'));
    }
    public function insert_fee(Request $request)
    {
        $request->validate([
            'id_paye' => 'required',
            'fee' => 'required',
            'Summer' => 'required',
            'service' => 'required',
            'complete' => 'required',
        ]);
        $inputData = $request->all();
        $inputData['fee'] = str_replace(",", "", $request->fee);
        $inputData['complete'] = str_replace(",", "", $request->complete);
        $inputData['Summer'] = str_replace(",", "", $request->Summer);
        $inputData['service'] = str_replace(",", "", $request->service);
        $inputData['total'] = $inputData['fee'] + $inputData['Summer'] + $inputData['service'] + $inputData['complete'];
        Fee::create($inputData);
        return redirect()->route('add_fee');
    }
    public function update_fee(Request $request)
    {
        $request->fee = str_replace(",", "", $request->fee);
        $request->complete = str_replace(",", "", $request->complete);
        $request->summer = str_replace(",", "", $request->summer);
        $request->service = str_replace(",", "", $request->service);
        DB::table('fee')->where('id_fee', $request->id_fee)->update(['fee' => $request->fee, 'summer' => $request->summer, 'service' => $request->service, 'complete' => $request->complete, 'total' => ($request->complete + $request->service + $request->summer + $request->fee)]);
        return redirect()->route('add_fee');
    }
    public function delete_fee(Request $request)
    {
        DB::table('fee')->where('id_fee', $request->id_fee)->delete();
        return redirect()->route('add_fee');
    }
    //agreement
    public function add_agreement(Request $request)
    {
        $exception = Exception::join('users', 'users.id', 'exception.id_user')->orderby('users.lname', "ASC")->get();
        $all_room = Room::get();
        $all_paye = Paye::get();
        $all_user = User::where('role', 4)->orderby('lname', "ASC")->get();
        if ($request->id_user == "") {
            return view('salary.add_agreement', compact('exception', 'all_room', 'all_user','all_paye'));
        } else {
            $id_user = $request->id_user;
            $id_rebate = Exception::where('id_user', $id_user)->first()->id_rebate;
            $id_paye = User::where('id', $id_user)->first()->id_paye;
            $price = Fee::where('id_paye', $id_paye)->sum('fee') + Fee::where('id_paye', $id_paye)->sum('summer') + Fee::where('id_paye', $id_paye)->sum('complete') + Fee::where('id_paye', $id_paye)->sum('service');
            $normal = Exception::where('id_user', $id_user)->first()->normal;
            $amount = Exception::where('id_user', $id_user)->first()->amount;
            if (Exception::where('id_user', $id_user)->count() > 0)
                $month = Exception::where('id_user', $id_user)->first()->month;
            else
                $month = 0;
            $count = Rebate::where('id_rebate', $id_rebate)->first()->count;
            return view('salary.add_agreement', compact('exception', 'id_user', 'count', 'price', 'month', 'normal', 'amount', 'all_room', 'all_user','all_paye'));
        }
    }
    public function delete(Request $request)
    {
        Agreement::where('id_agreement', $request->id_agreement)->delete();
        $request->replace(['id_user' => $request->id_user]);
        return $this->show_agreement($request);
    }
    public function insert_agreement(Request $request)
    {
        $count = count($_POST['kind']);
        $inputData = $request->all();
        for ($i = 0; $i < $count; $i++) {
            $inputData['id_user'] = $request->id_user;
            $inputData['kind'] = $request->kind[$i];
            $inputData['section'] = $request->section[$i];
            $inputData['date'] = $request->date[$i];
            $inputData['bank'] = $request->bank[$i];
            $inputData['check'] = $request->check[$i];
            $inputData['price'] = str_replace(",", "", $request->price[$i]);
            $inputData['gift'] = str_replace(",", "", $request->gift);
            if ($inputData['price'] != "") {
                Agreement::create($inputData);
                if ($inputData['kind'] == "نقد") {
                    $id_agreement = DB::table('agreement')->orderby('id_agreement', "desc")->first()->id_agreement;
                    DB::table('agreement')->where('id_agreement', $id_agreement)->update(['status' => 1, 'pay' => $inputData['price'], 'payment' => $inputData['date']]);
                }
            }
        }
        if ($request->photo != "") {
            $destination = base_path() . '/../assets/Signature/';
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $destination = $destination . '/';
            $filename = time();
            $file = $request->file('photo');
            $name = $filename . $request->photo->getClientOriginalName();
            $file->move($destination, $name);
            DB::table('exception')->where('id_user', $request->id_user)->update(['status' => 1, 'gift' => $inputData['gift'], 'photo' => $name]);
        }
        DB::table('exception')->where('id_user', $request->id_user)->update(['status' => 1, 'gift' => $inputData['gift']]);

        return redirect()->route('add_agreement');
    }
    public function show_agreement(Request $request)
    {
        $exception = Agreement::select('id_user')->distinct()->get();
        if ($request->id_user == "") {
            return view('salary.show_agreement', compact('exception'));
        } else {
            $id_user = $request->id_user;
            $agreement = Agreement::where('id_user', $id_user)->orderby('date', 'asc')->get();
            $id_rebate = Exception::where('id_user', $id_user)->first()->id_rebate;
            $id_paye = User::where('id', $id_user)->first()->id_paye;
            $price = Fee::where('id_paye', $id_paye)->sum('complete') + Fee::where('id_paye', $id_paye)->sum('fee') + Fee::where('id_paye', $id_paye)->sum('summer') + Fee::where('id_paye', $id_paye)->sum('service');
            $normal = Exception::where('id_user', $id_user)->first()->normal;
            $amount = Exception::where('id_user', $id_user)->first()->amount;
            if (Exception::where('id_user', $id_user)->count() > 0)
                $month = Exception::where('id_user', $id_user)->first()->month;
            else
                $month = 0;
            $count = Rebate::where('id_rebate', $id_rebate)->first()->count;
            return view('salary.show_agreement', compact('exception', 'id_user', 'count', 'price', 'month', 'normal', 'amount', 'agreement'));
        }
    }
    public function update_agreement(Request $request)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $request->date = str_replace($persian, $english, $request->date);
        $request->pay = str_replace(",", "", $request->pay);
        $request->price = str_replace(",", "", $request->price);
        $request->pay = DB::table('agreement')->where('id_agreement', $request->id_agreement)->sum('pay') + $request->pay;
        if ($request->pay == \App\Agreement::where('id_agreement', $request->id_agreement)->first()->price)
            $status = 1;
        else
            $status = 0;
        if ($request->update != 1) {
            $request->pay = str_replace(",", "", $request->pay);
            DB::table('agreement')->where('id_agreement', $request->id_agreement)->update(['status' => $status, 'payment' => $request->date, 'pay' => $request->pay]);
        } else {
            DB::table('agreement')->where('id_agreement', $request->id_agreement)->update(['payment' => $request->payment, 'date' => $request->date, 'price' => $request->price, 'pay' => $request->pay, 'kind' => $request->kind]);
        }
        $id_user = DB::table('agreement')->where('id_agreement', $request->id_agreement)->first()->id_user;
        $request->replace(['id_user' => $id_user]);
        return $this->show_agreement($request);
    }
    public function export_pdf(Request $request)
    {
        $id_user = $request->id_user;
        $id_paye = User::where('id', $id_user)->first()->id_paye;
        $fee = Fee::where('id_paye', $id_paye)->sum('fee');
        $complete = Fee::where('id_paye', $id_paye)->sum('complete');
        $summer = Fee::where('id_paye', $id_paye)->sum('summer');
        $normal = Exception::where('id_user', $id_user)->first()->normal;
        $photo = Exception::where('id_user', $id_user)->first()->photo;
        $amount = Exception::where('id_user', $id_user)->first()->amount;
        $service = Fee::where('id_paye', $id_paye)->first()->service;
        $agreement = Agreement::where('id_user', $id_user)->get();
        $sum = Agreement::where('id_user', $id_user)->sum('price');
        return view('salary.pdf', compact('id_user', 'fee', 'complete', 'normal', 'amount', 'agreement', 'sum', 'summer', 'service', 'photo'));
    }
    public function fail(Request $request)
    {
        DB::table('exception')->where('id_exception', $request->id_exception)->update(['status' => 2]);
        return redirect()->route('add_agreement');
    }
    public function excel()
    {
        return view('salary.excel');
    }
    public function insert_excel(Request $request)
    {
        Excel::import(new AgreementImport, request()->file('photo'));
        return redirect('/')->with('success', 'All good!');
    }
    //rebate
    public function add_rebate()
    {
        $rebate = Rebate::get();
        return view('salary.rebate', compact('rebate'));
    }
    public function insert_rebate(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'rate' => 'required',
            'count' => 'required',
        ]);
        $inputData = $request->all();
        $inputData['rate'] = str_replace(",", "", $request->rate);
        Rebate::create($inputData);
        return redirect()->route('add_rebate');
    }
    public function update_rebate(Request $request)
    {
        DB::table('rebate')->where('id_rebate', $request->id_rebate)->update(['title' => $request->title, 'rate' => $request->rate, 'count' => $request->count]);
        return redirect()->route('add_rebate');
    }
    public function delete_rebate(Request $request)
    {
        DB::table('rebate')->where('id_rebate', $request->id_rebate)->delete();
        return redirect()->route('add_rebate');
    }
    //exception
    public function add_exception(Request $request)
    {
        $all_user = User::where('role', 4)->orderby('lname', "ASC")->get();
        $exception = Exception::join('users', 'users.id', 'exception.id_user')->orderby('users.lname', "ASC")->get();
        $rebate = Rebate::get();
        $paye = Paye::get();
        $id_user = $request->id_user;
        if ($request->id_user != null) {
            $id_paye = User::where('id', $request->id_user)->first()->id_paye;
            $msg = $request->msg;
            if ($request->msg1 == "" && $request->msg2 == "")
                return view('salary.exception', compact('all_user', 'exception', 'rebate', 'paye', 'id_paye', 'id_user'));
            if ($request->msg1 != "") {
                $msg1 = $request->msg1;
                return view('salary.exception', compact('all_user', 'exception', 'rebate', 'paye', 'msg1', 'id_paye', 'id_user'));
            }
            if ($request->msg2 != "") {
                $msg2 = $request->msg2;
                return view('salary.exception', compact('all_user', 'exception', 'rebate', 'paye', 'msg2', 'id_paye', 'id_user'));
            }
        } else {
            return view('salary.exception', compact('all_user', 'exception', 'rebate', 'paye', 'id_user'));
        }
    }
    public function insert_exception(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'amount' => 'required',
            'month' => 'required',
        ]);
        $inputData = $request->all();
        $inputData['amount'] = str_replace(",", "", $request->amount);
        $inputData['normal'] = str_replace(",", "", $request->normal);
        $fee = Fee::get();
        $sum = 0;
        foreach ($fee as $item) {
            $sum = $sum + ($item->total * (\App\User::where('id_paye', $item->id_paye)->where('role', 4)->count()));
        }
        $sum = $sum * DB::table('option')->where('name', "off")->first()->value;
        $off = Exception::sum('normal') + Exception::sum('amount');
        $total = \App\Paye::where('id_paye', \App\User::where('id', $request->id_user)->first()->id_paye)->first()->id_paye;
        if ((Fee::where('id_paye', $total)->first()->total * Rebate::where('id_rebate', $request->id_rebate)->first()->rate / 100) >= $inputData['normal']) {
            if (Exception::where('id_user', $request->id_user)->count() <= 0) {
                if ($sum - $off > 0) {
                    Exception::create($inputData);
                    return redirect()->route('add_exception');
                } else
                    return redirect()->route('add_exception', ['msg2' => 1]);
            } else
                return redirect()->route('add_exception');
        } else
            return redirect()->route('add_exception', ['msg1' => 1]);
    }
    public function update_exception(Request $request)
    {
        $amount = str_replace(",", "", $request->amount);
        $normal = str_replace(",", "", $request->normal);
        DB::table('exception')->where('id_exception', $request->id_exception)->update(['amount' => $amount, 'normal' => $normal, 'month' => $request->month]);
        return redirect()->route('add_exception');
    }
    public function delete_exception(Request $request)
    {
        DB::table('exception')->where('id_exception', $request->id_exception)->delete();
        return redirect()->route('add_exception');
    }
    //report
    public function show_result()
    {
        $paye = Paye::get();
        $fee = Fee::get();
        $sum = 0;
        foreach ($fee as $item) {
            $sum = $sum + ($item->total * (\App\User::where('id_paye', $item->id_paye)->where('role', 4)->count()));
        }
        $sum_complete = 0;
        foreach ($fee as $item) {
            $sum_complete = $sum_complete + ($item->complete * (\App\User::where('id_paye', $item->id_paye)->where('role', 4)->count()));
        }
        $sum_fee = 0;
        foreach ($fee as $item) {
            $sum_fee = $sum_fee + ($item->fee * (\App\User::where('id_paye', $item->id_paye)->where('role', 4)->count()));
        }
        $sum_summer = 0;
        foreach ($fee as $item) {
            $sum_summer = $sum_summer + ($item->summer * (\App\User::where('id_paye', $item->id_paye)->where('role', 4)->count()));
        }
        $sum_service = 0;
        foreach ($fee as $item) {
            $sum_service = $sum_service + ($item->service * (\App\User::where('id_paye', $item->id_paye)->where('role', 4)->count()));
        }
        $off = \App\Exception::sum('amount') + \App\Exception::sum('normal');
        return view('salary.result', compact('sum', 'off', 'paye', 'sum_fee', 'sum_complete', 'sum_summer', 'sum_service'));
    }
    public function date_result(Request $request)
    {
        if ($request->date1 != "") {
            $date1 = $request->date1;
            $date2 = $request->date2;
            $total = DB::table('users')->join('agreement','users.id','agreement.id_user')->whereBetween('agreement.date', [$date1, $date2])->where('agreement.status', $request->status)->where('agreement.kind', $request->kind)->get();
            return view('salary.date', compact('date1', 'date2', 'total'));
        } else {
            return view('salary.date');
        }
    }
    public function debtor()
    {
        $total = DB::table('users')->join('agreement','users.id','agreement.id_user')->where('agreement.date', '<', verta()->format('Y/m/d'))->where('agreement.status', 0)->orderby('agreement.date', 'asc')->get();
        return view('salary.debtor', compact('total'));
    }
    public function report(Request $request)
    {
        $all_room = DB::table('room')->get();
        if ($request->id_room != "") {
            $id_room = $request->id_room;
            $all_user = DB::table('users')->where('role', 4)->orderby('id_room', "DESC")->get();
            dd($all_user);
            $agreement = Agreement::orderby('date', 'asc')->get();
            return view('salary.report', compact('all_user', 'agreement', 'id_room','all_room'));
        } else {
            return view('salary.report', compact('all_room'));
        }
    }
    public function report_print(Request $request)
    {
        $user = $request->id_user;
        $agreement = Agreement::orderby('date', 'asc')->get();
        return view('salary.report_card', compact('user', 'agreement'));
    }
    //cost
    public function cost_in()
    {
        return view('salary.cost_in');
    }
    public function cost_out()
    {
        return view('salary.cost_out');
    }
    public function cost_insert(Request $request)
    {
        $inputData = $request->all();
        $inputData['rate'] = str_replace(",", "", $request->rate);
        if ($request->source == "غیره") {
            if ($inputData['rate'] > 1000000) {
                $request->validate([
                    'title' => 'required',
                    'rate' => 'required',
                    'date' => 'required',
                    'source' => 'required',
                    'photo' => 'required',
                    'description' => 'required',
                ]);
            } else {
                $request->validate([
                    'title' => 'required',
                    'rate' => 'required',
                    'date' => 'required',
                    'source' => 'required',
                    'description' => 'required',
                ]);
            }
        } else {
            if ($inputData['rate'] > 1000000) {
                $request->validate([
                    'title' => 'required',
                    'rate' => 'required',
                    'date' => 'required',
                    'source' => 'required',
                    'photo' => 'required',
                ]);
            } else {
                $request->validate([
                    'title' => 'required',
                    'rate' => 'required',
                    'date' => 'required',
                    'source' => 'required',
                ]);
            }
        }
        if ($request->photo != "") {
            $destination = base_path() . '/public/cost/';
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $destination = $destination . '/';
            $filename = time();
            $file = $request->file('photo');
            $name = $filename . $request->photo->getClientOriginalName();
            $file->move($destination, $name);
        }
        $inputData['photo'] = $name;
        Cost::create($inputData);
        if ($request->kind == 0)
            return redirect()->route('salary_cost_in');
        else
            return redirect()->route('salary_cost_out');
    }
    public function cost_out_show()
    {
        $cost = Cost::where('kind', 1)->orderby('date', 'desc')->get();
        return view('salary.cost_out_show', compact('cost'));
    }
    public function total(Request $request)
    {
        $all_room = Room::get();
        if ($request->id_room != null) {
            $id_room=$request->id_room;
            $all_user=User::where('id_room',$id_room)->orderby('lname',"asc")->get();
            return view('salary.total', compact('all_room','id_room','all_user'));
        } else
            return view('salary.total', compact('all_room'));
    }
    public function pay_agreement()
    {
        foreach(\App\Agreement::get() as $item)
        {
            DB::table('agreement')->where('date',"<=",verta()->format('Y/m/d'))->where('id_agreement',$item->id_agreement)->where('kind',"!=","نقد")->update(['status' => 1,'payment'=>$item->date,'pay'=>$item->price]);
        }
    }
}
