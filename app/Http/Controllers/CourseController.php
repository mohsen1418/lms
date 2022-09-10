<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Film;
use App\Message;
use Illuminate\Http\Request;
use Auth;
use App\Role;
use DB;
use Illuminate\Support\Facades\Hash;

class CourseController extends Controller
{
    public function add()
    {
        if (Role::where('id_user', Auth::user()->id)->first()->course_learn == 1) {
        $all_room = DB::table('room')->get();
        $all_teacher = DB::table('users')->where('role', 3)->get();
        $all_course = DB::table('courses')->orderby('id_room', "ASC")->get();
        return view('course.add', compact('all_room', 'all_course', 'all_teacher'));
        }
        else
        abort(404);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'id_room' => 'required',
            'name' => 'required',
            'kind' => 'required',
        ]);
        $inputData = $request->all();
        Course::create($inputData);
        return redirect()->route('add_course');
    }
    public function delete(Request $request)
    {
        DB::table('courses')->where('id_course', $request->id_course)->delete();
        return redirect()->route('add_course');
    }
    public function statistic_film(Request $request)
    {
        $film=DB::table('films')->orderby('count', "DESC")->get();
        return view('course.statistic_film',compact('film'));
    }
    public function update(Request $request)
    {
        DB::table('courses')->where('id_course', $request->id_course)->update(['name' => $request->name,'kind' => $request->kind,'id_teacher' => $request->id_teacher]);
        return redirect()->route('add_course');
    }
}
