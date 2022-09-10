<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Role;
use Auth;

class EmployeController extends Controller
{
    public function add()
    {
        if (Role::where('id_user', Auth::user()->id)->first()->manager_personnel == 1) {
        $all_room = DB::table('room')->get();
        $all_teacher = DB::table('users')->where('role', 1)->get();
        return view('employe.add', compact('all_teacher', 'all_room'));
        }
        else
        abort(404);
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
        $inputData['role'] = 1;
        User::create($inputData);
        $user['id_user']=User::orderby('id','desc')->first()->id;
        Role::create($user);
        return redirect()->route('add_employe');
    }
    public function update(Request $request)
    {
        DB::table('users')->where('id', $request->id)->update(['mobile' => $request->mobile,'pass' => $request->password, 'password'=>bcrypt($request->password)]);
        return redirect()->route('add_employe');
    }
    public function delete(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
        return redirect()->route('add_employe');
    }
    public function role(Request $request)
    {
        if (Role::where('id_user', Auth::user()->id)->first()->manager_personnel == 1) {
        $id_user=$request->id;
        $kind=Role::where('id_user',$id_user)->first();
        return view('employe.role',compact('id_user','kind'));
        }
        else
        abort(404);
    }
    public function insert_role_employe(Request $request)
    {
        $inputData = Role::where('id_user',$request->id_user)->first();
        $inputData['id']=$request->id_user;
        $inputData->update($request->all());
        return redirect()->route('add_employe');
    }
}
