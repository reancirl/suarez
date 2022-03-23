<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory,SoftDeletes;

    public function leader() {
        return $this->belongsTo('App\Models\User','id','zone_id');
    }
}
