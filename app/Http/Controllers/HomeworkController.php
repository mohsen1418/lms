<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Homework;
use App\User;
use App\Trouble;
use App\Role;
use Auth;

class HomeworkController extends Controller
{
    public function add()
    {
        if (Role::where('id_user', Auth::user()->id)->first()->homework_add == 1) {
            $all_course = DB::table('room')->join('courses', 'courses.id_room', 'room.id_room')->get();
            return view('homework.add', compact('all_course'));
        } else
            abort(404);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'id_course' => 'required',
            'date1' => 'required',
            'clock1' => 'required',
            'date2' => 'required',
            'clock2' => 'required',
        ]);
        $inputData = $request->all();
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $request->date1 = str_replace($persian, $english, $request->date1);
        $request->date2 = str_replace($persian, $english, $request->date2);
        if ($request->file != "") {
            $destination = base_path() . '/public/homework/';
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $destination = $destination . '/';
            $filename = time();
            $file = $request->file('file');
            $name = $filename . $request->file->getClientOriginalName();
            $file->move($destination, $name);
            $inputData['file'] = $name;
            Homework::create($inputData);
        } else {
            $inputData['file'] = "";
            Homework::create($inputData);
        }
        $users = User::where('id_room', \App\Course::where('id_course', $request->id_course)->first()->id_room)->orderby('lname', 'desc')->get();
        foreach ($users as $user) {
            $inputData1 = $request->all();
            $inputData1['id_homework'] = \App\Homework::first()->id_homework;
            $inputData1['id_user'] = $user->id;
            Trouble::create($inputData1);
        }

        return redirect()->route('add_homework');
    }
    public function show(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->homework_show == 1) {
            if ($request->id_course != "") {
                $id_course = $request->id_course;
                $id_room = DB::table('courses')->where('id_course', $request->id_course)->first()->id_room;
                $all_user = DB::table('users')->where('id_room', $id_room)->orderby('lname', 'asc')->get();
                $all_homework = DB::table('homework')->where('id_course', $request->id_course)->get();
                $all_course = DB::table('room')->join('courses', 'courses.id_room', 'room.id_room')->get();
                return view('homework.show', compact('all_course', 'all_homework', 'all_user', 'id_course'));
            } else {
                $all_course = DB::table('room')->join('courses', 'courses.id_room', 'room.id_room')->get();
                return view('homework.show', compact('all_course'));
            }
        } else
            abort(404);
    }
    public function score(Request $request)
    {
        $count = count($_POST['score']);
        $inputData = $request->all();
        for ($i = 0; $i < $count; $i++) {
            $inputData['id_user'] = $request->id_user[$i];
            $inputData['score'] = $request->score[$i];
            if ($inputData['score'] != "")
                DB::table('trouble')->where('id_user', $inputData['id_user'])->update(['score' => $inputData['score']]);
        }
        $request->replace(['id_course' => $request->id_course]);
        return $this->show($request);
    }
    public function report(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->homework_report == 1) {
            $all_course = DB::table('room')->join('courses', 'courses.id_room', 'room.id_room')->get();
            if ($request->id_course != "") {
                $id_course = $request->id_course;
                $id_room = DB::table('courses')->where('id_course', $request->id_course)->first()->id_room;
                $all_user = DB::table('users')->where('id_room', $id_room)->orderby('lname', 'asc')->get();
                return view('homework.report', compact('all_course', 'all_user', 'id_course'));
            } else {
                return view('homework.report', compact('all_course'));
            }
        } else
            abort(404);
    }
    public function person(Request $request)
    {
        $all_user = DB::table('users')->orderby('lname', 'asc')->get();
        if ($request->id_user != "") {
            $id_user = $request->id_user;
            if ($request->kind == "آموزشی")
                $all_course = DB::table('users')->join('courses', 'courses.id_room', 'users.id_room')->where('users.id', $id_user)->where('courses.kind', 'آموزشی')->orderby('courses.name', 'asc')->get();
            elseif ($request->kind == "مهارتی")
                $all_course = DB::table('users')->join('courses', 'courses.id_room', 'users.id_room')->where('users.id', $id_user)->where('courses.kind', 'مهارتی')->orderby('courses.name', 'asc')->get();
            else
                $all_course = DB::table('users')->join('courses', 'courses.id_room', 'users.id_room')->where('users.id', $id_user)->orderby('courses.name', 'asc')->get();
            return view('homework.person', compact('id_user', 'all_user', 'all_course'));
        } else {
            return view('homework.person', compact('all_user'));
        }
    }
}
