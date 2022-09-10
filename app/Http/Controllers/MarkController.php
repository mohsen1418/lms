<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Mark;
use App\Role;
use Auth;

class MarkController extends Controller
{
    public function add(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->mark_add == 1) {
            $all_course = DB::table('courses')->orderby('id_room', "ASC")->get();
            if ($request->id_course != null) {
                $request->validate([
                    'detail' => 'required',
                ]);
                $kind = $request->kind;
                $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                $date = str_replace($persian, $english, $request->date);
                $id_course = $request->id_course;
                $detail = $request->detail;
                $id_room = DB::table('room')->join('courses', 'room.id_room', 'courses.id_room')->where('courses.id_course', $id_course)->first()->id_room;
                $all_user = User::where('id_room', $id_room)->orderby('lname', "asc")->get();
                return view('mark.add', compact('all_course', 'id_course', 'all_user', 'id_room', 'kind', 'date', 'detail'));
            } else {
                return view('mark.add', compact('all_course'));
            }
        } else
            abort(404);
    }
    public function insert(Request $request)
    {
        $inputData = $request->all();
        $count = count($_POST['id_user']);
        for ($i = 0; $i < $count; $i++) {
            $inputData['date'] = $request->date;
            $inputData['id_course'] = $request->id_course;
            $inputData['detail'] = $request->detail;
            $inputData['id_user'] = $request->id_user[$i];
            $inputData['mark'] = $request->mark[$i];
            if ($inputData['mark'] != null)
                Mark::create($inputData);
        }
        return redirect()->route('add_mark');
    }
    public function show(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->mark_show == 1) {
            $all_course = DB::table('courses')->orderby('id_room', "ASC")->get();
            if ($request->id_course != null) {
                $id_course = $request->id_course;
                $id_room = DB::table('room')->join('courses', 'room.id_room', 'courses.id_room')->where('courses.id_course', $id_course)->first()->id_room;
                $all_user = User::where('id_room', $id_room)->orderby('lname', "asc")->get();
                $all_date = DB::table('mark')->select('date')->where('id_course', $id_course)->orderby('date', 'asc')->distinct()->get();
                return view('mark.show', compact('all_course', 'id_course', 'all_user', 'id_room', 'all_date'));
            } else {
                return view('mark.show', compact('all_course'));
            }
        } else
            abort(404);
    }
    public function update(Request $request)
    {
        $count = count($_POST['id_user']);
        for ($i = 0; $i < $count; $i++) {
            if ($request->mark[$i] != null) {
                $id_mark = DB::table('mark')->where('id_course', $request->id_course)->where('date', $request->date)->where('id_user', $request->id_user[$i])->first()->id_mark;
                DB::table('mark')->where('id_mark', $id_mark)->update(['mark' => $request->mark[$i]]);
            }
        }
        return redirect()->route('show_mark');
    }
    public function delete(Request $request)
    {
        DB::table('mark')->where('id_course', $request->id_course)->where('date', $request->date)->delete();
        return $this->show($request);
    }
}
