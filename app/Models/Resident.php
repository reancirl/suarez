<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Resident extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function zone() {
        return $this->belongsTo('App\Models\Zone','zone_id','id');
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = date('Y-m-d',strtotime($value));
    }

    public function getFullNameAttribute(){
        return $this->last_name . ', ' . $this->first_name . ' ' . $this->middle_name;
    } 

    public function getAgeAttribute(){
        return Carbon::parse($this->birthday)->age;
    } 
}
