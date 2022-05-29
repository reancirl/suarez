<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Resident;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        $zone_count = Zone::count();
        $resident_count = Resident::count();
        $appointment_count = Appointment::where('date', date('Y-m-d'))->count();
        return view('dashboard',compact('zone_count','resident_count','appointment_count'));
    }

    public function import() 
    {
        $columns = ['FirstName','MiddleName','LastName','ZoneName','Gender','Birthday','EmailAddress','Address','Occupation','CivilStatus','PhoneNumber'];
        return view('import',compact('columns'));
    }

    public function importSave(Request $request)
    {
        $success = 0;
        if ($request->import) {
            foreach ($request->import as $i => $import) {
                $user = Resident::where('first_name',$import['FirstName'])->where('last_name',$import['LastName'])->where('middle_name',$import['MiddleName'])->first();
                $zone = Zone::where('name',$import['ZoneName'])->first();
                if(!$user && $zone) {
                    $data = new Resident();
                    $data->first_name = $import['FirstName'];
                    $data->last_name = $import['LastName'];
                    $data->middle_name = $import['MiddleName'];
                    $data->zone_id = $zone->id;
                    $data->gender = $import['Gender'];
                    $data->birthday = $import['Birthday'];
                    $data->email_address = $import['EmailAddress'];
                    $data->address = $import['Address'];
                    $data->occupation = $import['Occupation'];
                    $data->civil_status = $import['CivilStatus'];
                    $data->phone_number = $import['PhoneNumber'];
                    $data->save();
                    $success++;
                }
            }
        }
        return redirect('/import')->with('status','Sucessfully imported '.$success.' Resident/s!');
    }
}
