<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Zone;

class UserManagementController extends Controller
{
    public function index()
    {
        $data = User::where('id','!=',1)
                    ->where('id','!=',auth()->id())
                    ->with('zone')
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
        $data = User::find($id);

        $zones = Zone::leftJoin('users as u','u.zone_id','zones.id')
                    ->whereNull('u.id')
                    ->select('zones.*')
                    ->get();

        return view('user_management.edit',compact('data','zones'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id.',id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required']
        ]);
        

        $user->update([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'zone_id' => $request->zone_id
        ]);

        return redirect()->back()->with('status','Sucessfully updated user!');
    }

    public function destroy($id)
    {
        User::find($id)->delete();

        return 'success';
        return redirect()->back()->with('status','Deleted successfully!');
    }
}
