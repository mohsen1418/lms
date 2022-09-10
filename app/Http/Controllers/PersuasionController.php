<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persuasion;
use App\Besharat;
use Auth;
use DB;

class PersuasionController extends Controller
{
    public function add_role()
    {
        $all_persuasion = DB::table('persuasion')->get();
        return view('persuasion.role',compact('all_persuasion'));
    }
    public function insert_role(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'score' => 'required',
            'kind' => 'required',
        ]);
        $inputData = $request->all();
        Persuasion::create($inputData);
        return redirect()->route('add_persuasion');
    }
    public function add()
    {
        $all_user = DB::table('users')->where('role', 4)->orderby('lname', "ASC")->get();
        $all_persuasion = DB::table('persuasion')->get();
        $all_besharat = DB::table('besharat')->orderby('id_besharat', "DESC")->take(15)->get();
        return view('persuasion.add', compact('all_user', 'all_persuasion','all_besharat'));
    }
    public function insert(Request $request)
    {
        $inputData = $request->all();
        $inputData['name']=Auth::user()->fname." ".Auth::user()->lname;
        Besharat::create($inputData);
        $persuasion = DB::table('persuasion')->where('id_persuasion',$request->id_persuasion)->first();
        if($persuasion->kind=="تشویق")
        $persuasion = $persuasion->score+DB::table('users')->where('id',$request->id_user)->first()->score;
        else
        $persuasion = DB::table('users')->where('id',$request->id_user)->first()->score-$persuasion->score;
        DB::table('users')->where('id', $request->id_user)->update(['score'=>$persuasion]);
        return redirect()->route('add_persuasion_item');
    }
    public function Personal(Request $request)
    {
        $all_user = DB::table('users')->where('role', 4)->orderby('lname', "ASC")->get();
        if(!isset($request->id_user))
        {
        return view('persuasion.Personal',compact('all_user'));
        }
        else
        {
            $id_user = DB::table('users')->where('id', $request->id_user)->first()->id;
            $all_besharat = DB::table('besharat')->where('id_user', $request->id_user)->orderby('id_besharat', "DESC")->get();
            return view('persuasion.Personal',compact('all_user','all_besharat','id_user'));
        }
    }
    public function class(Request $request)
    {
        $all_room = DB::table('room')->get();
        if(!isset($request->id_room))
        {
        return view('persuasion.class',compact('all_room'));
        }
        else
        {
            $all_user = DB::table('users')->where('role', 4)->where('id_room', $request->id_room)->orderby('score', "DESC")->get();
            return view('persuasion.class',compact('all_room','all_user'));
        }
    }
    public function paye(Request $request)
    {
        $all_paye = DB::table('paye')->get();
        if(!isset($request->id_paye))
        {
        return view('persuasion.paye',compact('all_paye'));
        }
        else
        {
            $all_user = DB::table('users')->where('role', 4)->where('id_paye', $request->id_paye)->orderby('score', "DESC")->get();
            return view('persuasion.paye',compact('all_paye','all_user'));
        }
    }
    public function all(Request $request)
    {
            $all_user = DB::table('users')->where('role', 4)->orderby('score', "DESC")->get();
            return view('persuasion.all',compact('all_user'));
    }
    public function update(Request $request)
    {
        DB::table('persuasion')->where('id_persuasion', $request->id_persuasion)->update(['title'=>$request->title,'score'=>$request->score]);
        return redirect()->route('add_persuasion');
    }
    public function delete(Request $request)
    {
        DB::table('persuasion')->where('id_persuasion', $request->id_persuasion)->delete();
        return redirect()->route('add_persuasion');
    }
    public function delete_besharat(Request $request)
    {
        $besharat = DB::table('besharat')->where('id_besharat', $request->id_besharat)->first();
        $persuasion = DB::table('persuasion')->where('id_persuasion', $besharat->id_persuasion)->first();
        if ($persuasion->kind == "تشویق")
            $persuasion = DB::table('users')->where('id', $besharat->id_user)->first()->score - $persuasion->score;
        else
            $persuasion = DB::table('users')->where('id', $besharat->id_user)->first()->score + $persuasion->score;
        DB::table('users')->where('id', $besharat->id_user)->update(['score' => $persuasion]);
        DB::table('besharat')->where('id_besharat', $request->id_besharat)->delete();
        return redirect()->route('add_persuasion_item');
    }
    public function add_award()
    {
       $award = DB::table('award')->get();
       return view('award.add',compact('award'));
    }
    public function insert_award(Request $request)
    {
            $request->validate([
            'title' => 'required',
            'detail' => 'required',
            'rate' => 'required',
            'photo' => 'required',
        ]);
            $destination = base_path() . '/award/';
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $destination = $destination . '/';
            $filename = time();
            $file = $request->file('photo');
            $name = $filename . $request->photo->getClientOriginalName();
            $file->move($destination, $name);
        $inputData = $request->all();
        $inputData['photo']=$name;
        Award::create($inputData);
        return redirect()->route('add_award');
    }
    public function show_award()
    {
       return view('award.show');
    }
    public function show_order()
    {
        $order = DB::table('order')->get();
        return view('persuasion.order', compact('order'));
    }
    public function delete_order(Request $request)
    {
        DB::table('order')->where('id_order', $request->id_order)->delete();
        return redirect()->route('show_order');
    }
    public function status_award(Request $request)
    {
       $status=DB::table('award')->where('id_award', $request->id_award)->first()->status;
       if($status==1)
       DB::table('award')->where('id_award', $request->id_award)->update(['status' => 0]);
       else
       DB::table('award')->where('id_award', $request->id_award)->update(['status' => 1]);
       $award = DB::table('award')->get();
       return view('award.add',compact('award'));
    }
}
