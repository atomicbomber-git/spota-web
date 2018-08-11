<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = [
        'current_semester','approved_count','semesters_year'
    ];

    public function major(){
        return $this->belongsTo('App\Major');
    }
}
