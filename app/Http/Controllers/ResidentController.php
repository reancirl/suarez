<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index()
    {
        $data = Resident::where('zone_id','!=',0)->get();
        return view('resident.index',compact('data'));
    }

    public function create()
    {
        $data = Zone::get();
        return view('resident.create',compact('data'));
    }

    public function store(Request $request)
    {
        $data = new Resident();
        $data->fill($request->except('birthday'));
        $data->birthday = $request->birthday;
        $data->save();

        return redirect('/resident')->with('status','Sucessfully created resident!');
    }

    public function show(Resident $resident)
    {
        //
    }

    public function edit(Resident $resident)
    {
        $data = Zone::get();
        $birthday = date('m-d-Y', strtotime($resident->birthday));
        return view('resident.edit',compact('resident','data','birthday'));
    }

    public function update(Request $request, Resident $resident)
    {
        $resident->fill($request->except('birthday'));
        $resident->birthday = $request->birthday;
        $resident->save();

        return redirect()->back()->with('status','Sucessfully created resident!');

    }

    public function destroy(Resident $resident)
    {
        $resident->delete();

        return 'success';
        return redirect()->back()->with('status','Deleted successfully!');
    }
}
