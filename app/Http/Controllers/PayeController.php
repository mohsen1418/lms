<?php

namespace App\Http\Controllers;

use App\Paye;
use Illuminate\Http\Request;
use Auth;
use DB;

class PayeController extends Controller
{
    public function add()
    {
        $all_paye = DB::table('paye')->get();
        return view('paye.add', compact('all_paye'));
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $inputData = $request->all();
        Paye::create($inputData);
        return redirect()->route('add_paye');
    }
    public function delete(Request $request)
    {
        DB::table('paye')->where('id_paye', $request->id_paye)->delete();
        return redirect()->route('add_paye');
    }
    public function update(Request $request)
    {
        DB::table('paye')->where('id_paye', $request->id_paye)->update(['name' => $request->name]);
        return redirect()->route('add_paye');
    }
}
