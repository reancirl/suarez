<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $data = Holiday::get();
        return view('holiday.index',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = new Holiday;
        $data->name = $request->name;
        $data->date = date('Y-m-d',strtotime($request->date));
        $data->save();
        return redirect()->back()->with('status','Sucessfully added holiday!');
    }

    public function show(Holiday $holiday)
    {
        //
    }

    public function edit(Holiday $holiday)
    {
        //
    }

    public function update(Request $request, Holiday $holiday)
    {
        //
    }

    public function destroy(Holiday $holiday)
    {
        //
    }
}
