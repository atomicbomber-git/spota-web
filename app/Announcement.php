<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Announcement extends Model
{
    protected $fillable = ['title','content','status','target'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function major(){
        return $this->belongsTo('App\Major');
    }

    public function date(){
        Carbon::setLocale('id');
        $dt = Carbon::parse($this->updated_at);
        return $dt->formatLocalized('%A, %d %B %Y ');
    }

    public function target(){
        switch($this->target){
            case 'M':
                return 'Mahasiswa';
            case 'D':
                return 'Dosen';
            case 'A':
                return 'Semua';
        }
    }

    public function announce(){
        if($this->status = 'draft'){
            $this->update(['status' => 'announced']);
        }
    }

}
