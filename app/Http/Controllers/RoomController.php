<?php

namespace App\Http\Controllers;

use App\Room;
use App\Paye;
use Illuminate\Http\Request;
use Auth;
use DB;

class RoomController extends Controller
{
    public function add()
    {
        $all_room=DB::table('room')->get();
        $all_paye=DB::table('paye')->get();
        return view('room.add',compact('all_room','all_paye'));
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_paye' => 'required',
            'url' => 'required',
        ]);
        $inputData = $request->all();
        Room::create($inputData);
        return redirect()->route('add_room');
    }
    public function delete(Request $request)
    {
        DB::table('room')->where('id_room', $request->id_room)->delete();
        return redirect()->route('add_room');
    }
    public function update(Request $request)
    {
        DB::table('room')->where('id_room', $request->id_room)->update(['name' => $request->name]);
        return redirect()->route('add_room');
    }
}
