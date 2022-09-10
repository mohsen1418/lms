<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\User;
use App\Paye;
use App\Sms;
use App\Msg;
use DB;
use Auth;
use App\Role;
use Ipecompany\Smsirlaravel\Smsirlaravel;
use Ipecompany\Smsirlaravel\SmsirlaravelLogs;

class SmsController extends Controller
{
    public function send(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->sms_person == 1) {
            if ((DB::table('charge')->sum('price') - (DB::table('sms')->sum('count') * 500)) >= 5000) {
                $all_room = Room::get();

                if ($request->id_room != null) {
                    $id_room = $request->id_room;
                    $all_user = User::where('id_room', $id_room)->where('role', 4)->orderby('lname', 'asc')->get();
                    $all_msg = Msg::orderby('id_msg', 'asc')->get();
                    return view('sms.send', compact('all_room', 'id_room', 'all_user', 'all_msg'));
                } else {
                    return view('sms.send', compact('all_room'));
                }
            } else
                return redirect()->route('charge');
        } else
            abort(404);
    }
    public function insert(Request $request)
    {
        $count = round(mb_strlen($request->msg) / 65) + 1;
        $tick = count($_POST['id_user']);
        $inputData = $request->all();
        for ($i = 0; $i < $tick; $i++) {
            $inputData['id_user'] = $request->id_user[$i];
            if ($request->detail == null)
                $inputData['msg'] = $request->msg;
            else
                $inputData['msg'] = $request->detail;
            $inputData['date'] = time();
            $inputData['count'] = $count;
            if ($request->id_user[$i] != null) {
                Sms::create($inputData);
                if ($request->cadre == "1")
                    Smsirlaravel::send([$inputData['msg']], [User::where('id', $request->id_user[$i])->first()->mobile]);
                else
                    Smsirlaravel::send([$inputData['msg']], [User::where('id', $request->id_user[$i])->first()->p_number]);
            }
        }
        if ($request->cadre == "1")
            return redirect()->route('send_sms_cadre');
        else
            return redirect()->route('send_sms');
    }
    public function send_class(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->sms_group == 1) {
            if ((DB::table('charge')->sum('price') - (DB::table('sms')->sum('count') * 500)) >= 5000) {
                $all_room = Room::get();
                $all_paye = Paye::get();
                return view('sms.class', compact('all_room', 'all_paye'));
            } else
                return redirect()->route('charge');
        } else
            abort(404);
    }
    public function insert_class(Request $request)
    {
        $count = round(mb_strlen($request->msg) / 65) + 1;
        $inputData = $request->all();
        if ($request->id_room != null)
            $user = User::where('id_room', $request->id_room)->orderby('lname', 'asc')->get();
        elseif ($request->id_paye != null)
            $user = User::where('id_paye', $request->id_paye)->orderby('lname', 'asc')->get();
        else
            $user = User::where('role', 4)->get();
        foreach ($user as $item) {
            $inputData['id_user'] = $item->id;
            $inputData['msg'] = $request->msg;
            $inputData['date'] = time();
            $inputData['count'] = $count;
            Sms::create($inputData);
            Smsirlaravel::send([$request->msg], [$item->p_number]);
        }
        return redirect()->route('send_class');
    }
    public function send_cadre(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->sms_cadre == 1) {
            if ((DB::table('charge')->sum('price') - (DB::table('sms')->sum('count') * 500)) >= 5000) {
                $all_user = User::where('role', '!=', 4)->orderby('lname', 'asc')->get();
                return view('sms.cadre', compact('all_user'));
            } else
                return redirect()->route('charge');
        } else
            abort(404);
    }
    public function charge(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->sms_charge == 1) {
            $charge = DB::table('charge')->get();
            return view('sms.charge', compact('charge'));
        } else
            abort(404);
    }
    public function show(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->sms_show == 1) {
            $sms = DB::table('sms')->orderby('date', "DESC")->paginate(20);
            return view('sms.show', compact('sms'));
        } else
            abort(404);
    }
}
