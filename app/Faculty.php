<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'name',
        'code',
        'token',    
    ];


    public function department(){
        return $this->hasMany('App\Department');
    }

    public function majors(){
        return $this->hasMany('App\Major');
    }
}
