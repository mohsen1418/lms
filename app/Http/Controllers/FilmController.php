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

class FilmController extends Controller
{
    public function add()
    {
        if (Role::where('id_user', Auth::user()->id)->first()->film_add == 1) {
            $all_course = DB::table('room')->join('courses', 'courses.id_room', 'room.id_room')->get();
            return view('film.add', compact('all_course'));
        } else
            abort(404);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'id_course' => 'required',
            'name' => 'required',
            'url' => 'required',
            'session' => 'required',
            'time' => 'required',
            'status' => 'required',
        ]);
        $inputData = $request->all();
        $inputData['id_course'] = $request->id_course;
        Film::create($inputData);
        return redirect()->route('add_film');
    }
    public function show(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->film_show == 1) {
            $all_course = DB::table('room')->join('courses', 'courses.id_room', 'room.id_room')->get();
            if ($request->id_course != "") {
                $id_room = DB::table('courses')->where('id_course', $request->id_course)->first()->id_room;
                $all_user = DB::table('users')->where('id_room', $id_room)->where('role', 4)->orderby('lname', "ASC")->get();
                $all_film = DB::table('films')->where('id_course', $request->id_course)->orderby('session', "ASC")->get();
                return view('film.show', compact('all_course', 'all_film', 'all_user'));
            } else {
                return view('film.show', compact('all_course'));
            }
        } else
            abort(404);
    }
    public function update_status_film(Request $request)
    {
        $all_course = DB::table('courses')->get();
        $film1 = DB::table('films')->where('id_film', $request->id)->first();
        if ($film1->status == 1)
            DB::table('films')->where('id_film', $request->id)->update(['status' => 0]);
        else
            DB::table('films')->where('id_film', $request->id)->update(['status' => 1]);
        $id_room = DB::table('courses')->where('id_course', $request->id_course)->first()->id_room;
        $all_user = DB::table('users')->where('id_room', $id_room)->where('role', 4)->orderby('lname', "ASC")->get();
        $all_film = DB::table('films')->where('id_course', $request->id_course)->orderby('session', "ASC")->get();
        return view('film.show', compact('all_course', 'all_film', 'all_user'));
    }
    public function embed(Request $request)
    {
        $url = $request->url;
        return view('film.embed', compact('url'));
    }
    public function update(Request $request)
    {
        $all_course = DB::table('courses')->get();
        DB::table('films')->where('id_film', $request->id_film)->update(['name' => $request->name, 'time' => $request->time, 'session' => $request->session, 'url' => $request->url]);
        $id_room = DB::table('courses')->where('id_course', $request->id_course)->first()->id_room;
        $all_user = DB::table('users')->where('id_room', $id_room)->where('role', 4)->orderby('lname', "ASC")->get();
        $all_film = DB::table('films')->where('id_course', $request->id_course)->orderby('session', "ASC")->get();
        return view('film.show', compact('all_course', 'all_film', 'all_user'));
    }
    public function view(Request $request)
    {
        $all_film = DB::table('films')->where('id_course', $request->id_course)->orderby('session', "ASC")->get();
        return view('film.view', compact('all_film'));
    }
    public function delete(Request $request)
    {
        $id_course = Film::where('id_film', $request->id_film)->first()->id_course;
        $request->replace(['id_course' => $id_course]);
        DB::table('films')->where('id_film', $request->id_film)->delete();
        return $this->show($request);
    }
    public function report(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->film_report == 1) {
            $all_course = DB::table('courses')->get();
            if ($request->id_course != "") {
                $id_room = DB::table('courses')->where('id_course', $request->id_course)->first()->id_room;
                $all_user = DB::table('users')->where('id_room', $id_room)->where('role', 4)->orderby('lname', "ASC")->get();
                $all_film = DB::table('films')->where('id_course', $request->id_course)->orderby('session', "ASC")->get();
                $course = $request->id_course;
                return view('film.report', compact('all_course', 'all_film', 'all_user', 'course', 'id_room'));
            } else {
                return view('film.report', compact('all_course'));
            }
        } else
            abort(404);
    }
}
