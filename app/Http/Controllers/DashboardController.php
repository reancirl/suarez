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

        $may_count = Appointment::whereMonth('date','05')->where('document_type','indigency')->count();
        $june_count = Appointment::whereMonth('date','06')->where('document_type','indigency')->count();

        $resident_zone = Zone::withCount('residents')->orderBy('residents_count','desc')->take(6)->get();
        $zone1 = null;
        $zone2 = null;
        $zone3 = null;
        $zone4 = null;
        $zone5 = null;
        $zone6 = null;
        $zone1_count = null;
        $zone2_count = null;
        $zone3_count = null;
        $zone4_count = null;
        $zone5_count = null;
        $zone6_count = null;

        foreach ($resident_zone as $i => $data) {
            switch ($i) {
                case 0:
                    $zone1 = $data->name;
                    $zone1_count = $data->residents_count;
                    break;
                case 1:
                    $zone2 = $data->name;
                    $zone2_count = $data->residents_count;
                    break;
                case 2:
                    $zone3 = $data->name;
                    $zone3_count = $data->residents_count;
                    break;
                case 3:
                    $zone4 = $data->name;
                    $zone4_count = $data->residents_count;
                    break;
                case 4:
                    $zone5 = $data->name;
                    $zone5_count = $data->residents_count;
                    break;
                case 5:
                    $zone6 = $data->name;
                    $zone6_count = $data->residents_count;
                    break;
                default:
                    break;
            }
        }

        return view('dashboard',compact('zone_count','resident_count','appointment_count','may_count','june_count','zone1','zone2','zone3','zone4','zone5','zone6','zone1_count','zone2_count','zone3_count','zone4_count','zone5_count','zone6_count'));
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
