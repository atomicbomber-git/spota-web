<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Admin extends Model
{
    protected $fillable = [
        'phone',
        'position',
        'major_id'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }


    public function updateAdmin(Request $request){
        DB::transaction(function () use ($request) {
            $this->update([
                'phone' => $request->phone,
                'major_id'  => $request->major_id,
                'position'  => $request->position
            ]);
    
            $this->user->update([
                'name'              => $request->name,
                'email'             => $request->email,
                'password'          => bcrypt($request->password),
                'identity_number'   => $request->identity_number
            ]);
        });

    }
}
