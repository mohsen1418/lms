<?php

namespace App\Http\Controllers;

use App\User;
use App\Slider;
use DB;
use Illuminate\Http\Request;
use Ipecompany\Smsirlaravel\Smsirlaravel;
use Ipecompany\Smsirlaravel\SmsirlaravelLogs;



class HomeController extends Controller
{
    public function home()
    {
       //Smsirlaravel::send(['سلام'], ['09353929837']);
        $all_room = DB::table('room')->orderby('id_room', 'asc')->get();
        return view('index.home', compact('all_room'));
    }
    public function logout()
    {
        auth()->logout();
        return redirect('login');
    }
    public function add_slider()
    {
        $slider = DB::table('slider')->orderby('id_slider', 'desc')->get();
        return view('index.slider', compact('slider'));
    }
    public function insert_slider(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'photo' => 'required',
        ]);
        $inputData = $request->all();
        $destination = base_path() . '/slider/';
        if (!is_dir($destination)) {
            mkdir($destination, 0777, true);
        }
        $destination = $destination . '/';
        $filename = time();
        $file = $request->file('photo');
        $name = $filename . $request->photo->getClientOriginalName();
        $file->move($destination, $name);
        $inputData['photo'] = $name;
        Slider::create($inputData);
        return redirect()->route('add_slider');
    }
    public function delete_slider(Request $request)
    {
        DB::table('slider')->where('id_slider', $request->id_slider)->delete();
        return redirect()->route('add_slider');
    }
    public function update_slider(Request $request)
    {
        $slider = DB::table('slider')->where('id_slider', $request->id_slider)->first();
        if ($slider->status == 1)
            DB::table('slider')->where('id_slider', $request->id_slider)->update(['status' => 0]);
        else
            DB::table('slider')->where('id_slider', $request->id_slider)->update(['status' => 1]);
        return redirect()->route('add_slider');
    }
}
