<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $fillable = [
        'name',
        'department_id',
        'faculty_id'
    ];

    public function faculty(){
        return $this->belongsTo('App\Faculty');
    }

    public function department(){
        return $this->belongsTo('App\Department')->withDefault();
    }

    public function users(){
        return $this->hasMany('App\User','major_id');
    }

}
