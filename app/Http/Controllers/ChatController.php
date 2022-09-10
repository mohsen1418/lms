<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
use App\Room;
use App\Access;
use Auth;
use DB;

class ChatController extends Controller
{
    public function show(Request $request)
    {
        $all_user = User::where('role', 4)->orderby('lname', 'asc')->get();
        if ($request->id_user != null) {
            $id_user = User::where('id', $request->id_user)->first();
            $chat = Chat::orderby('time', "ASC")->get();
            DB::table('chat')->where('receiver', Auth::user()->id)->update(['view' => 1]);
            $msg = Chat::where('view', 0)->where('receiver', Auth::user()->id)->select('sender')->distinct()->get();
            return view('chat.show', compact('id_user', 'chat', 'all_user', 'msg'));
        } else {
            $msg = Chat::where('view', 0)->where('receiver', Auth::user()->id)->select('sender')->distinct()->get();
            return view('chat.show', compact('all_user', 'msg'));
        }
    }
    public function insert(Request $request)
    {
        $request->validate([
            'msg' => 'required',
        ]);
        $inputData = $request->all();
        $inputData['sender'] = Auth::user()->id;
        $inputData['time'] = time();
        Chat::create($inputData);
    }
    public function role(Request $request)
    {
        $all_user = User::where('role', 1)->orderby('lname', 'asc')->get();
        $all_room = Room::get();
        if ($request->id_user != null) {
            $all_room = Room::get();
            $id_user = $request->id_user;
            if (Access::where('id_user', $id_user)->count() <= 0) {
                foreach ($all_room as $item) {
                    $inputData = $request->all();
                    $inputData['id_room'] = $item->id_room;
                    Access::create($inputData);
                }
            }
            $all_access = Access::where('id_user', $id_user)->first();
            return view('chat.role', compact('all_user', 'id_user', 'all_room', 'all_access'));
        } else {
            return view('chat.role', compact('all_user'));
        }
    }
    public function insert_role_chat(Request $request)
    {
        $count=count($_POST['kind']);
        for($i=0;$i<$count;$i++)
        {
            DB::table('access')->where('id_user', $request->id_user)->where('id_room', $request->id_room[$i])->update(['kind' => $request->kind[$i]]);
        }
        return redirect()->route('role_chat');
    }  
}
