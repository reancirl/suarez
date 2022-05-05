<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Resident;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required']
        ]);

        $resident = Resident::create([
            'first_name' => ucwords($request->first_name),
            'last_name' => ucwords($request->last_name),
            'middle_name' => ucwords($request->middle_name),
            'zone_id' => $request->zone_id ?? 0,
            'gender' => $request->gender,
            'birthday' => date('Y-m-d',strtotime($request->birthday)),
            'email_address' => $request->email,
            'address' => $request->address,
            'occupation' => $request->occupation,
            'civil_status' => $request->civil_status,
            'phone_number' => $request->phone_number,
        ]);
        
        $user = User::create([
            'email' => $request->email,
            'zone_id' => $request->zone_id,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        if ($user && $resident) {
            $user->resident_id = $resident->id;
            $user->save();
        }

        return redirect('/user-management')->with('status','Sucessfully registered new user!');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
