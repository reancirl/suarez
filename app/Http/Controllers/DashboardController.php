<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Resident;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        $zone_count = Zone::count();
        $resident_count = Resident::count();
        return view('dashboard',compact('zone_count','resident_count'));
    }
}
