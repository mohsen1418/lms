<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Course;
use App\Study;
use App\Role;
use App\User;
use App\Etude;
use App\Room;
use Redirect;
use Auth;

class StudyController extends Controller
{
    //group

    public function add_group(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->study_group == 1) {
            $all_room = DB::table('room')->get();
            if ($request->id_room != null) {
                $id_room = $request->id_room;
                $day = array("شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه", "جمعه");
                $all_course = Course::where('id_room', $id_room)->get();
                $study = Study::join('courses', 'study.id_course', 'courses.id_course')->where('courses.id_room', $id_room)->get();
                return view('study.add_group', compact('all_room', 'id_room', 'day', 'all_course', 'study'));
            } else {
                return view('study.add_group', compact('all_room'));
            }
        } else
            abort(404);
    }
    public function insert_group(Request $request)
    {
        $request->validate([
            'id_course' => 'required',
            'clock1' => 'required',
        ]);
        $inputData = $request->all();
        $inputData['clock'] = $request->clock1;
        Study::create($inputData);
        $all_user = User::where('id_room', Course::where('id_course', $request->id_course)->first()->id_room)->get();
        foreach ($all_user as $user) {
            $inputData['id_user'] = $user->id;
            Etude::create($inputData);
        }
        return $this->add_group($request);
    }
    public function delete_group(Request $request)
    {
        DB::table('study')->where('id_course', $request->id_course)->where('clock', $request->clock)->where('day', $request->day)->delete();
        DB::table('etude')->where('id_course', $request->id_course)->where('clock', $request->clock)->where('day', $request->day)->delete();
        return $this->add_group($request);
    }
    //person
    public function add_person(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->study_person == 1) {
            $all_user = User::where('role', 4)->orderby('lname', "ASC")->get();
            if ($request->id_user != null) {
                $id_user = $request->id_user;
                $day = array("شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه", "جمعه");
                $all_course = Course::join('users', 'users.id_room', 'courses.id_room')->where('users.id', $request->id_user)->get();
                $etude = Etude::where('id_user', $request->id_user)->orderby('clock', 'asc')->get();
                return view('study.add_person', compact('all_user', 'id_user', 'day', 'all_course', 'etude'));
            } else {
                return view('study.add_person', compact('all_user'));
            }
        } else
            abort(404);
    }
    public function insert_person(Request $request)
    {
        $request->validate([
            'id_course' => 'required',
            'clock1' => 'required',
        ]);
        $inputData = $request->all();
        $inputData['clock'] = $request->clock1;
        Etude::create($inputData);
        return $this->add_person($request);
    }
    public function delete_person(Request $request)
    {
        DB::table('etude')->where('id_user', $request->id_user)->where('id_course', $request->id_course)->where('clock', $request->clock)->where('day', $request->day)->delete();
        return $this->add_person($request);
    }
    public function mounthly(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->study_mounthly == 1) {
            $all_room = DB::table('room')->get();
            if ($request->mounth != null) {
                $id_room = $request->id_room;
                $mounth = $request->mounth;
                if ($request->mounth == "فروردین") {
                    $date1 = "1402/01/01";
                    $date2 = "1402/01/31";
                    $count = 31;
                    $m = "01";
                    $y = "1402";
                }
                if ($request->mounth == "اردیبهشت") {
                    $date1 = "1402/02/01";
                    $date2 = "1402/02/31";
                    $count = 31;
                    $m = "02";
                    $y = "1402";
                }
                if ($request->mounth == "خرداد") {
                    $date1 = "1402/02/01";
                    $date2 = "1402/02/31";
                    $count = 31;
                    $m = "03";
                    $y = "1402";
                }
                if ($request->mounth == "تیر") {
                    $date1 = "1401/04/01";
                    $date2 = "1402/04/31";
                    $count = 31;
                    $m = "04";
                    $y = "1401";
                }
                if ($request->mounth == "مرداد") {
                    $date1 = "1401/05/01";
                    $date2 = "1401/05/31";
                    $count = 31;
                    $m = "05";
                    $y = "1401";
                }
                if ($request->mounth == "شهریور") {
                    $date1 = "1401/06/01";
                    $date2 = "1401/06/31";
                    $count = 31;
                    $m = "06";
                    $y = "1401";
                }
                if ($request->mounth == "مهر") {
                    $date1 = "1401/07/01";
                    $date2 = "1401/07/30";
                    $count = 30;
                    $m = "07";
                    $y = "1401";
                }
                if ($request->mounth == "آبان") {
                    $date1 = "1401/08/01";
                    $date2 = "1401/08/30";
                    $count = 30;
                    $m = "08";
                    $y = "1401";
                }
                if ($request->mounth == "آذر") {
                    $date1 = "1401/09/01";
                    $date2 = "1401/09/30";
                    $count = 30;
                    $m = "09";
                    $y = "1401";
                }
                if ($request->mounth == "دی") {
                    $date1 = "1401/10/01";
                    $date2 = "1401/10/30";
                    $count = 30;
                    $m = "10";
                    $y = "1401";
                }
                if ($request->mounth == "بهمن") {
                    $date1 = "1401/11/01";
                    $date2 = "1401/11/30";
                    $count = 30;
                    $m = "11";
                    $y = "1401";
                }
                if ($request->mounth == "اسفند") {
                    $date1 = "1401/12/01";
                    $date2 = "1401/12/29";
                    $count = 29;
                    $m = "12";
                    $y = "1401";
                }
                $all_user = User::where('role', 4)->where('id_room', $request->id_room)->orderby('lname', "ASC")->get();
                return view('study.report_monthly', compact('count', 'all_room', 'all_user', 'm', 'y', 'mounth', 'date1', 'date2'));
            } else {
                return view('study.report_monthly', compact('all_room'));
            }
        } else
            abort(404);
    }
    public function daily(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->study_daily == 1) {
            $all_room = Room::get();
            if ($request->id_room != null) {
                $id_room = $request->id_room;
                $date = $request->date;
                $kind = $request->kind;
                if ($request->kind == "آموزشی" || $request->kind == "مهارتی")
                    $all_course = Course::where('id_room', $id_room)->where('kind', $request->kind)->get();
                else
                    $all_course = Course::where('id_room', $id_room)->get();
                $all_user = User::where('id_room', $id_room)->orderby('lname', 'asc')->get();
                return view('study.report_daily', compact('all_room', 'id_room', 'all_user', 'all_course', 'date', 'kind'));
            } else {
                return view('study.report_daily', compact('all_room'));
            }
        } else
            abort(404);
    }
    public function weekly(Request $request)
    {
        $all_user = User::where('role', 4)->orderby('lname', 'asc')->get();
        if ($request->id_user != null) {
            $id_user = $request->id_user;
            $date = $request->date;
            $rooz = array("شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه", "جمعه");
            $kind = $request->kind;
            if ($request->kind == "آموزشی" || $request->kind == "مهارتی")
                $all_course = Course::join('users', 'users.id_room', 'courses.id_room')->where('users.id', $id_user)->where('courses.kind', $request->kind)->get();
            else
                $all_course = Course::join('users', 'users.id_room', 'courses.id_room')->where('users.id', $id_user)->get();
            return view('study.report_weekly', compact('all_user', 'id_user', 'rooz', 'all_course', 'date', 'kind'));
        } else {
            return view('study.report_weekly', compact('all_user'));
        }
    }
    public function print_weekly(Request $request)
    {
        $id_user = $request->id_user;
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $date = str_replace($persian, $english, $request->date);
        $id_room = $request->id_room;
        $all_course = Course::join('users', 'users.id_room', 'courses.id_room')->where('users.id', $id_user)->where('courses.kind', $request->kind)->get();
        $rooz = array("شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه", "جمعه");
        return view('study.print_weekly', compact('id_user', 'date', 'id_room', 'all_course', 'rooz'));
    }
    public function print_person(Request $request)
    {
        $id_user = $request->id_user;
        $rooz = array("شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه", "جمعه");
        $all_course = Course::join('users', 'users.id_room', 'courses.id_room')->where('users.id', $request->id_user)->get();
        $etude = Etude::where('id_user', $request->id_user)->orderby('clock', 'asc')->get();
        return view('study.print_person', compact('id_user', 'rooz', 'all_course', 'etude'));
    }
}
