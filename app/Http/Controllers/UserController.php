<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use App\Paye;
use App\Role;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;



class UserController extends Controller
{
    public function add()
    {
        if (Role::where('id_user', Auth::user()->id)->first()->student_add == 1) {
            $all_paye = DB::table('paye')->get();
            return view('user.add', compact('all_paye'));
        } else
            abort(404);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'id_paye' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);
        $inputData = $request->all();
        $inputData['password'] = bcrypt($request->password);
        $inputData['role'] = 4;
        $inputData['pass'] = $request->password;
        User::create($inputData);
        return redirect()->route('add_user');
    }
    public function show(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->student_show == 1) {
            $all_room = Room::get();
            $all_paye = Paye::get();
            if ($request->id_room == "" && $request->id_paye == "") {
                return view('user.show', compact('all_room', 'all_paye'));
            } else {
                if ($request->id_room != null) {
                    $user = User::where('role', 4)->where('id_room', $request->id_room)->orderby('lname', "ASC")->get();
                    $class = Room::where('id_room', $request->id_room)->first()->name;
                    $id_room = $request->id_room;
                    return view('user.show', compact('user', 'all_room', 'class', 'all_paye', 'id_room'));
                } else {
                    $user = User::where('role', 4)->where('id_paye', $request->id_paye)->orderby('lname', "ASC")->get();
                    $paye = Paye::where('id_paye', $request->id_paye)->first()->name;
                    $id_paye = $request->id_paye;
                    return view('user.show', compact('user', 'all_room', 'all_paye', 'paye', 'id_paye'));
                }
            }
        } else
            abort(404);
    }
    public function update(Request $request)
    {
        $password = bcrypt($request->password);
        DB::table('users')->where('id', $request->id)->update(['fname' => $request->fname, 'lname' => $request->lname, 'f_fname' => $request->f_fname, 'm_lname' => $request->m_lname, 'mobile' => $request->mobile, 'date' => $request->date, 'f_number' => $request->f_number, 'm_number' => $request->m_number, 'p_number' => $request->p_number, 'f_job' => $request->f_job, 'm_job' => $request->m_job, 'zipcode' => $request->zipcode, 'f_adr' => $request->f_adr, 'm_adr' => $request->m_adr, 'adr' => $request->adr, 'tel' => $request->tel, 'password' => $password, 'pass' => $request->password]);
        if ($request->photo != "") {
            $destination = base_path() . '/public/avatar/';
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $destination = $destination . '/';
            $filename = time();
            $file = $request->file('photo');
            $name = $filename . $request->photo->getClientOriginalName();
            $file->move($destination, $name);
            DB::table('users')->where('id', $request->id)->update(['avatar' => $name]);
        }
        if (isset($request->id_paye))
            $request->replace(['id_paye' => $request->id_paye]);
        else
            $request->replace(['id_room' => $request->id_room]);
        return $this->show($request);
    }
    public function delete(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
        return redirect()->route('show_user');
    }
    public function search(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->student_search == 1) {
            if ($request->id_user != null) {
                $all_user = DB::table('users')->where('role', 4)->orderby('id_room', "DESC")->get();
                $select_user = DB::table('users')->where('id', $request->id_user)->first();
                $all_trouble = DB::table('trouble')->where('id_user', $request->id_user)->orderby('id_trouble', "DESC")->get();
                $all_message = DB::table('sms')->where('id_user', $request->id_user)->orderby('date', "DESC")->get();
                $all_enzebati = DB::table('enzebati')->where('id_user', $request->id_user)->orderby('date', "DESC")->get();
                $all_consultant = DB::table('consultant')->where('id_user', $request->id_user)->get();
                $statistic = DB::table('statistic')->where('id_user', $request->id_user)->orderby('date_in', "DESC")->get();
                return view('user.search', compact('all_user', 'select_user', 'all_message', 'all_enzebati', 'all_consultant', 'statistic', 'all_trouble'));
            } else
                $all_user = DB::table('users')->where('role', 4)->orderby('id_room', "DESC")->get();
            return view('user.search', compact('all_user'));
        } else
            abort(404);
    }
    public function album(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->student_album == 1) {
        $all_room = DB::table('room')->get();
        if ($request->id_room != null) {
            $all_user = DB::table('users')->where('role', 4)->where('id_room', $request->id_room)->get();
            return view('user.album', compact('all_room', 'all_user'));
        } else
            return view('user.album', compact('all_room'));
        } else
        abort(404);
    }
    public function online()
    {
        $users = User::where('role', 4)->orderby('lname', "ASC")->get();
        return view('user.online', compact('users'));
    }
    public function import_show()
    {
        if (Role::where('id_user', Auth::user()->id)->first()->student_excel == 1) {
        $all_paye = DB::table('paye')->get();
        return view('user.import', compact('all_paye'));
    } else
    abort(404);
    }
    public function import_insert(Request $request)
    {
        Excel::import(new UsersImport($request->id_paye), request()->file('photo'));
        return redirect('/')->with('success', 'All good!');
    }
    public function class(Request $request)
    {
        $all_paye = DB::table('paye')->get();
        if ($request->id_paye != "") {
            $id_paye = $request->id_paye;
            $all_user_yes = User::where('id_paye', $id_paye)->where('id_room', '!=', "")->orderby('lname', 'asc')->get();
            $all_user_no = User::where('id_paye', $id_paye)->where('id_room', null)->orderby('lname', 'asc')->get();
            $all_room = Room::where('id_paye', $id_paye)->get();
            return view('user.class', compact('all_paye', 'id_paye', 'all_user_yes', 'all_user_no', 'all_room'));
        } else {
            return view('user.class', compact('all_paye'));
        }
    }
    public function update_room(Request $request)
    {
        $count = count($_POST['id_user']);
        $inputData = $request->all();
        for ($i = 0; $i < $count; $i++) {
            DB::table('users')->where('id', $request->id_user[$i])->update(['id_room' => $request->id_room[$i]]);
        }
        $request->replace(['id_paye' => $request->id_paye]);
        return $this->class($request);
    }
    public function pass(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->student_pass == 1) {
        $all_room = DB::table('room')->get();
        if ($request->id_room != "") {
            return redirect()->route('print_pass', ['id_room' => $request->id_room]);
        } else {
            return view('user.pass', compact('all_room'));
        }
    } else
    abort(404);
    }
    public function print_pass(Request $request)
    {
        $id_room = $request->id_room;
        $all_user = User::where('id_room', $id_room)->orderby('lname', 'asc')->get();
        return view('user.print_pass', compact('id_room', 'all_user'));
    }
    public function export(Request $request)
    {
        $all_room = DB::table('room')->get();
        if ($request->id_room != null) {
            return Excel::download(new UsersExport($request->id_room), 'users.xlsx');
        }
        return view('user.export', compact('all_room'));
    }
}
