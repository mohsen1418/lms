<?php

namespace App\Http\Controllers;

use App\User;
use App\Enzebati;
use App\Discipline;
use App\Room;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Role;
use Illuminate\Support\Facades\Hash;
use App\Sms;
use Ipecompany\Smsirlaravel\Smsirlaravel;
use Ipecompany\Smsirlaravel\SmsirlaravelLogs;

class DisciplineController extends Controller
{
    public function add_role()
    {
        if (Role::where('id_user', Auth::user()->id)->first()->discipline_role == 1) {
            $all_discipline = DB::table('discipline')->get();
            return view('discipline.role', compact('all_discipline'));
        } else
            abort(404);
    }
    public function insert_role(Request $request)
    {
        $inputData = $request->all();
        Discipline::create($inputData);
        return redirect()->route('add_role');
    }
    public function add()
    {
        if (Role::where('id_user', Auth::user()->id)->first()->discipline_add == 1) {
            $all_user = DB::table('users')->where('role', 4)->orderby('lname', "ASC")->get();
            $all_discipline = DB::table('discipline')->orderby('name', "ASC")->get();
            $all_room = Room::get();
            return view('discipline.add', compact('all_user', 'all_discipline', 'all_room'));
        } else
            abort(404);
    }
    public function insert(Request $request)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $request->date = str_replace($persian, $english, $request->date);
        $inputData = $request->all();
        if ($request->sort != 1) {
            $count = count($_POST['id_user']);
            for ($i = 0; $i < $count; $i++) {
                $inputData['date'] = $request->date;
                $inputData['id_discipline'] = $request->id_discipline;
                $inputData['detail'] = $request->detail;
                $inputData['id_user'] = $request->id_user[$i];
                $inputData['kind'] = $request->kind;
                Enzebati::create($inputData);
                if ($request->sms == "بله")
                    Smsirlaravel::send(["ثبت یک مورد انضباطی جدید : " . \App\Discipline::where('id_discipline', $request->id_discipline)->first()->name . " معاونت انضباطی " . DB::table('option')->where('name', 'name_School')->first()->value], [\App\User::where('id', $request->id_user[$i])->first()->p_number]);
            }
            return redirect()->route('add_discipline');
        } else {
            $inputData['date'] = $request->date;
            $inputData['id_discipline'] = $request->id_discipline;
            $inputData['detail'] = $request->detail;
            $inputData['id_user'] = $request->id_user;
            $inputData['kind'] = $request->kind;
            Enzebati::create($inputData);
            if ($request->sms == "بله")
                Smsirlaravel::send(["ثبت یک مورد انضباطی جدید : " . \App\Discipline::where('id_discipline', $request->id_discipline)->first()->name . " معاونت انضباطی " . DB::table('option')->where('name', 'name_School')->first()->value], [\App\User::where('id', $request->id_user)->first()->p_number]);
            $request->replace(['id_user' => $request->id_user]);
            return $this->add_person($request);
        }
    }
    public function show(Request $request)
    {
        $all_user = DB::table('users')->where('role', 4)->orderby('lname', "ASC")->get();
        if ($request->id_user != "") {
            $id_user = $request->id_user;
            $date1 = $request->date1;
            $date2 = $request->date2;
            if ($date1 == null && $date2 == null)
                $all_enzebati = DB::table('enzebati')->where('id_user', $request->id_user)->orderby('date', "desc")->get();
            else
                $all_enzebati = DB::table('enzebati')->where('id_user', $request->id_user)->whereBetween('date', [$request->date1, $request->date2])->orderby('date', "desc")->get();
            $score = DB::table('enzebati')->join('discipline', 'enzebati.id_discipline', 'discipline.id_discipline')->where('enzebati.id_user', $request->id_user)->where('kind', "بله")->whereBetween('enzebati.date', [$request->date1, $request->date2])->sum('discipline.score');
            return view('discipline.show', compact('all_user', 'all_enzebati', 'id_user', 'score', 'date1', 'date2'));
        } else
            return view('discipline.show', compact('all_user'));
    }
    public function update(Request $request)
    {
        DB::table('discipline')->where('id_discipline', $request->id_discipline)->update(['name' => $request->name, 'score' => $request->score]);
        return redirect()->route('add_role');
    }
    public function delete(Request $request)
    {
        DB::table('discipline')->where('id_discipline', $request->id_discipline)->delete();
        return redirect()->route('add_role');
    }
    public function add_person(Request $request)
    {
        $all_user = DB::table('users')->where('role', 4)->orderby('lname', "ASC")->get();
        if ($request->id_user != "") {
            $id_user = $request->id_user;
            $all_discipline = DB::table('discipline')->orderby('name', "DESC")->get();
            $all_enzebati = DB::table('enzebati')->where('id_user', $request->id_user)->orderby('date', "desc")->get();
            $score = DB::table('enzebati')->join('discipline', 'enzebati.id_discipline', 'discipline.id_discipline')->where('enzebati.id_user', $request->id_user)->where('kind', "بله")->sum('discipline.score');
            return view('discipline.person', compact('all_user', 'all_enzebati', 'id_user', 'score', 'all_discipline'));
        } else
            return view('discipline.person', compact('all_user'));
    }
    public function delete_enzebati(Request $request)
    {
        $id_user = DB::table('enzebati')->where('id_enzebati', $request->id_enzebati)->first()->id_user;
        DB::table('enzebati')->where('id_enzebati', $request->id_enzebati)->delete();
        $request->replace(['id_user' => $id_user]);
        return $this->add_person($request);
    }
}
