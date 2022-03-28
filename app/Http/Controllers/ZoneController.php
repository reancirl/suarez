<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\User;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        $data = Zone::with('leader')
                        ->withCount('residents')
                        ->get();

        return view('zone.index',compact('data'));
    }

    public function create()
    {
        $data = User::where('role','leader')
                    ->whereNull('zone_id')
                    ->get();

        return view('zone.create',compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:zones'],
        ]);

        $data = new Zone;
        $data->name = $request->name;
        $data->note = $request->note;
        $data->save();

        $user = User::find($request->leader);
        $user->zone_id = $data->id;
        $user->save();

        return redirect('/zone')->with('status','Sucessfully created zone!');
    }

    public function show(Zone $zone)
    {
        //
    }

    public function edit($id)
    {
        $data = Zone::find($id);

        $leaders = User::where('role','leader')
                    ->whereNull('zone_id')
                    ->get();

        return view('zone.edit',compact('data','leaders'));
    }

    public function update(Request $request, $id)
    {
        $data = Zone::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:zones,name,'.$data->id.',id'],
        ]);

        $data->name = $request->name;
        $data->note = $request->note;
        
        $old_leader = $data->leader;
        if($old_leader) {
            $old_leader->zone_id = NULL;
            $old_leader->save();
        }

        $data->save();
        
        $new_leader = User::find($request->leader);
        $new_leader->zone_id = $data->id;
        $new_leader->save();

        return redirect()->back()->with('status','Sucessfully updated zone!');
    }

    public function destroy($id)
    {
        $zone = Zone::find($id);

        $user = User::where('zone_id',$id)
                    ->first();

        $user->zone_id = NULL;
        $user->save();

        $zone->delete();

        return 'success';
        return redirect()->back()->with('status','Deleted successfully!');
    }
}
