<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Lecturer extends Model
{
    protected $fillable =[
        'phone','position','picture'
    ];

    public function major(){
        return $this->belongsTo('App\Major');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    

    public function updateLecturer(Request $request){
        DB::transaction(function() use ($request){
            $picture =$this->picture;
            if($request->identity_number != $this->user->identity_number && !$request->hasFile('picture')){
                $ext = explode('.',$picture);
                $old = 'lecturers/'.Auth::user()->major_id.'/'.$picture;
                $picture = $request->identity_number.'.'.end($ext);
                $new = 'lecturers/'.Auth::user()->major_id.'/'.$picture;
                Storage::move($old , $new);
                $this->picture = $new;
                $this->save();
            }

            $this->user->update([
                'name'              => $request->name,
                'email'             => $request->email,
                'password'          => empty($request->password) ? $this->user->password : $request->password,
                'identity_number'   => $request->identity_number,
            ]);

            if($request->hasFile('picture')){
                $ext = $request->picture->extension();
                if(!empty($picture)){
                    Storage::delete('lecturers/'.Auth::user()->major_id.'/'.$picture);
                }
                $picture = $this->user->identity_number.'.'.$ext;    
                $request->picture->storeAs('lecturers/'.$this->user->major_id,$picture,'public');
            }

            $this->update([
                'phone'             => $request->phone,
                'position'          => $request->position,
                'privileges'        => $request->privileges,
                'picture'           => $picture
            ]);


        },2);
    }

}
