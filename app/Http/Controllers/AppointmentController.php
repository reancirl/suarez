<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Resident;

class AppointmentController extends Controller
{
    public function index()
    {
        $data = Appointment::with('resident')->orderBy('date')->get();
        return view('appointment.index',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Appointment $appointment)
    {
        //
    }

    public function edit(Appointment $appointment)
    {
        //
    }

    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    public function destroy(Appointment $appointment)
    {
        //
    }

    public function setAppointment(Request $request) 
    {
        if ($request->appointment_id) {
            $data = Appointment::find($request->appointment_id);
        } else {
            $data = new Appointment;
            $data->resident_id = $request->resident_id;
        }

        $data->date = date('Y-m-d',strtotime($request->date));
        $data->time = $request->time;
        $data->status = 'not-cleared';
        $data->count = 1;
        $data->document_type = $request->document_type;
        $data->purpose = $request->purpose;
        $data->save();

        return redirect('/congrats')->with('message',date('M d,Y',strtotime($data->date)));
    }

    public function datepicker(Request $request)
    {
        $first_step = $this->dateAvailability($request);
        $am = 0;
        $pm = 0;
        if ($first_step) {
            $am = $this->timeAvailability($request,'am');
            $pm = $this->timeAvailability($request,'pm');
        }

        return response()->json([
            'first_step' => $first_step,
            'am' => $am,
            'pm' => $pm
        ]);
    }

    public function residentCheck(Request $request)
    {
        $date = date('Y-m-d',strtotime($request->date));
        $resident = Resident::with('zone')
                            ->where('last_name',$request->last_name)
                            ->where('first_name',$request->first_name)
                            ->orWhere('middle_name',$request->middle_name)
                            ->first() ?? null;

        $error_message = null;
        $warning_message = null;
        $appointment = null;
        
        if (!$resident) {
            $error_message = 'Your name is not currently in our database! Please recheck details or go to respective ZONE President to add your record!';
        } else {
            $appointment = Appointment::where('resident_id',$resident->id)
                                        ->where('status','open')
                                        ->whereDate('date','>',now()->format('Y-m-d'))
                                        ->first();
            if ($appointment) {
                $warning_message = 'You already have an appointment ('. date('M d, Y',strtotime($appointment->date)) .'), if you wish to change it - continue the process';
            }
        }

        return response()->json([
            'error_message' => $error_message,
            'warning_message' => $warning_message,
            'resident' =>  $resident,
            'appointment' =>  $appointment
        ]);
    }

    public function dateAvailability(Request $request)
    {
        $date = date('Y-m-d',strtotime($request->data));

        if ($date == now()->format('Y-m-d')) {
            $available = 0;
        } else {
            $appointment_count = Appointment::whereDate('date',$date)->sum('count');

            if ($appointment_count == 30) {
                $available = 0;
            } else {
                $available = 1;
            }   
        }

        return $available;
    }

    public function timeAvailability(Request $request, $time)
    {
        $date = date('Y-m-d',strtotime($request->data));
        
        $appointment_count = Appointment::whereDate('date',$date)
                                        ->where('time',$time)
                                        ->sum('count');

        if ($appointment_count == 15) {
            return 0;
        } 
        return 1;
    }
}