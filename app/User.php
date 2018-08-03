<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','identitiy_number','type','status','major_id', 'identity_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function admin(){
        return $this->hasOne('App\Admin');
    }

    public function lecturer(){
        return $this->hasOne('App\Lecturer');
    }

    public function student(){
        return $this->hasOne('App\Student');
    }

    public function major(){
        return $this->belongsTo('App\Major');
    }


    public function phone(){
        switch($this->type){
            case 'A':
                return $this->admin->phone;
                break;
            case 'D':
                return $this->lecturer->phone;
                break;
        }
    }

    public function activate(){
        $this->update([
            'status' => ($this->status == 'A' ? 'N' : 'A') ,
        ]);
    }

    public function storeAdmin(Request $request){
        $this->name             = $request->name;
        $this->email            = $request->email;
        $this->password         = bcrypt($request->password);
        $this->identity_number  = $request->identity_number;
        $this->type             = 'A';
        $this->major_id         = $request->major_id;
        $this->save();
        $this->admin()->save(new Admin([
            'position'  => $request->position,
            'phone'     => $request->phone,
        ]));
    }

    public function storeStudent(Request $request){
        DB::transaction(function() use ($request){
            $picture = "";
            $this->name             = $request->name;
            $this->email            = $request->email;
            $this->password         = bcrypt($request->password);
            $this->identity_number  = $request->identity_number;
            $this->type             = 'M';
            $this->major_id         = Auth::user()->major_id;
            $this->save();
            if($request->hasFile('picture')){
                $ext = $request->picture->extension();
                $picture = $this->identity_number.'.'.$ext;    
                $request->picture->storeAs('students/'.$this->major_id,$picture,'public');
            }
            $this->student()->save(new Student([
                'batch'     => $request->batch,
                'picture'   => $picture
            ]));
        },2);
    }

    public function storeLecturer(Request $request){
        DB::transaction(function() use ($request){
            $picture = "";
            $this->fill($request->all());
            $this->password = bcrypt($request->password);
            $this->type     = 'D';
            $this->major_id = Auth::user()->major_id;

            if($request->hasFile('picture')){
                $ext = $request->picture->extension();
                $picture = $this->identity_number.'.'.$ext;    
                $request->picture->storeAs('lecturers/'.$this->major_id,$picture,'public');
            }
            
            $this->save();
            $this->lecturer()->save(new Lecturer([
                'phone'     => $request->phone,
                'position'  => $request->position,
                'privileges'=> 'D',
                'picture'   => $picture
            ]));
        },2);
    }

}
