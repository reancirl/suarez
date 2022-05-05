<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\User;
use App\Models\Zone;

class UserManagementController extends Controller
{
    public function index()
    {
        $data = User::where('id','!=',1)
                    ->where('id','!=',auth()->id())
                    ->with('zone','resident')
                    ->latest()
                    ->get();

        return view('user_management.index',compact('data'));
    }

    public function create()
    {
        $data = Zone::leftJoin('users as u','u.zone_id','zones.id')
                    ->whereNull('u.id')
                    ->select('zones.*')
                    ->get();
                    
        return view('user_management.create',compact('data'));
    }

    public function store(Request $request)
    {
        return $request->all();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = User::with('resident')->find($id);
        $birthday = date('m-d-Y', strtotime($data->resident->birthday));

        $zones = Zone::leftJoin('users as u','u.zone_id','zones.id')
                    ->whereNull('u.id')
                    ->select('zones.*')
                    ->get();

        return view('user_management.edit',compact('data','zones','birthday'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $resident = Resident::find($user->resident->id);

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id.',id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required']
        ]);

        $resident->fill($request->except('birthday','email','role','password','zone_id','password_confirmation'));
        $resident->email_address = $request->email;
        $resident->birthday = $request->birthday;
        $resident->save();
        
        $user->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'zone_id' => $request->zone_id
        ]);

        return redirect()->back()->with('status','Sucessfully updated user!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $resident = Resident::find($user->resident_id);
        if ($resident) {
            $resident->delete();
        }
        $user->forceDelete();
        return 'success';
        return redirect()->back()->with('status','Deleted successfully!');
    }
}
