<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class TeacherController extends Controller
{
    public function add()
    {
        $all_room = DB::table('room')->get();
        $all_teacher = DB::table('users')->where('role', 3)->get();
        return view('teacher.add', compact('all_teacher', 'all_room'));
    }
    public function insert(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);
        $inputData = $request->all();
        $inputData['password'] = bcrypt($request->password);
        $inputData['pass'] = $request->password;
        $inputData['role'] = 3;
        User::create($inputData);
        return redirect()->route('add_teacher');
    }
    public function update(Request $request)
    {
        DB::table('users')->where('id', $request->id)->update(['fname' => $request->fname, 'lname' => $request->lname ,'mobile' => $request->mobile , 'pass' => $request->password , 'password' => bcrypt($request->password)]);
        return redirect()->route('add_teacher');
    }
    public function delete(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
        return redirect()->route('add_teacher');
    }
}
