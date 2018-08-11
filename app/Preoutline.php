<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preoutline extends Model
{


    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function storePreoutline(Request $request){
        $this->title            = $request->title;
        $this->description      = $request->description;

    }
}
