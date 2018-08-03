<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'major_id',
        'batch',
        'picture'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function major(){
        return $this->belongsTo('App\Major');
    }

    public function updateStudent(Request $request){
        DB::transaction(function() use ($request){
            $picture = '';
            $this->user->update([
                'name'              => $request->name,
                'email'             => $request->email,
                'password'          => empty($request->password) ? $this->user->password : $request->password,
            ]);

            if($request->hasFile('picture')){
                $ext = $request->picture->extension();
                $picture = $this->user->identity_number.'.'.$ext;    
                $request->picture->storeAs('students/'.$this->user->major_id,$picture,'public');
            }

            $this->update([
                'batch'     => $request->batch,
                'picture'   => $picture
            ]);
        },2);
    }
}
