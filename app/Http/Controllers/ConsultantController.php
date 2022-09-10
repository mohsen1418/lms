<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Consultant;
use App\Role;
use Auth;
use App\User;

class ConsultantController extends Controller
{
    public function add(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->consultant_add == 1) {
            $all_user = DB::table('users')->where('role', 4)->orderby('lname', "ASC")->get();
            if ($request->id_user != null) {
                $id_user = $request->id_user;
                $all_consultant = DB::table('consultant')->where('id_user', $id_user)->orderby('date', "DESC")->get();
                return view('consultant.add', compact('all_user', 'id_user', 'all_consultant'));
            } else {
                return view('consultant.add', compact('all_user'));
            }
        } else
            abort(404);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'Present' => 'required',
            'kind' => 'required',
            'time' => 'required',
            'date' => 'required',
            'text' => 'required',
        ]);
        $inputData = $request->all();
        $inputData['author'] = Auth::User()->id;
        Consultant::create($inputData);
        return redirect()->route('add_consultant');
    }
    public function report(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->consultant_show == 1) {
            $all_room = DB::table('room')->get();
            if ($request->id_room != null) {
                $id_room = $request->id_room;
                $all_user=User::where('id_room',$id_room)->orderby('lname',"ASC")->get();
                return view('consultant.report', compact('all_room', 'id_room','all_user'));
            } else {
                return view('consultant.report', compact('all_room'));
            }
        } else
            abort(404);
    }
}
