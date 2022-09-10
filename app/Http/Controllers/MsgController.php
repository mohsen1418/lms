<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Msg;

class MsgController extends Controller
{
    public function add()
    {
        $all_msg=DB::table('msg')->get();
        return view('msg.add',compact('all_msg'));
    }
    public function insert(Request $request)
    {
        $request->validate([
            'detail' => 'required',
        ]);
        $inputData = $request->all();
        Msg::create($inputData);
        return redirect()->route('add_msg');
    }
    public function delete(Request $request)
    {
        DB::table('msg')->where('id_msg', $request->id_msg)->delete();
        return redirect()->route('add_msg');
    }
    public function update(Request $request)
    {
        DB::table('msg')->where('id_msg', $request->id_msg)->update(['detail' => $request->detail]);
        return redirect()->route('add_msg');
    }
}
