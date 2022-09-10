<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Film;
use App\Message;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;

class MessageController extends Controller
{
    public function send()
    {
        $all_room = DB::table('room')->get();
        return view('message.send', compact('all_room'));
    }
    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'id_room' => 'required',
            'text' => 'required'
        ]);
        if ($request->photo != "") {
            $destination = base_path() . '/news/';
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $destination = $destination . '/';
            $filename = time();
            $file = $request->file('photo');
            $name = $filename . $request->photo->getClientOriginalName();
            $file->move($destination, $name);
        }
        $inputData = $request->all();
        $inputData['sender'] = Auth::user()->fname . " " . Auth::user()->lname;
        $inputData['photo'] =$name;
        Message::create($inputData);
        return redirect()->route('send_message');
    }
    public function show()
    {
        $message = DB::table('messages')->orderby('id',"DESC")->get();
        return view('message.show', compact('message'));
    }
}
