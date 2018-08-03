<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Admin;
use App\Major;
use App\Faculty;
use Auth;

class AdminController extends Controller
{
    public function updateMyProfile(Request $request){
        $user = User::find(Auth::id());
        $request->validate([
            'name'=>'required|string',
            'phone'=>'required|numeric',
            'email'=>[
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password'=>'nullable|string'
        ]);

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->admin->update([
            'phone' => $request->phone
        ]);

        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->route('admin.edit')->with('success','Profil Anda Berhasil Diperbaharui !');
    }

    public function index(){
        return view('admin.dashboard.superadmin.akun-admin',['users'=>Admin::where('privileges','p')->get(),'faculties'=>Faculty::all()]);
    }

    public function store(Request $request){
        $request->validate([
            'name'              => 'required',
            'email'             => 'required|email|unique:users,email',
            'identity_number'   => 'required|unique:users,identity_number',
            'position'          => 'required',
            'phone'             => 'required|numeric',
            'major_id'          => 'required|exists:majors,id'
        ]);
        
        DB::transaction(function() use ($request){
            $user = new User;
            $user->storeAdmin($request);
        },2);
        
        return redirect()->route('admin.create')->with('success','Akun Pengurus berhasil ditambah !');
        
    }

    public function activate(Request $request,$id){
        $admin = Admin::findOrFail($id);
        if($admin->privileges != 's'){
            $admin->user->activate();
        }
        return redirect()->back();
    }

    public function destroy($id){
        $admin = Admin::findOrFail($id);
        if($admin->privileges != 's'){
            $admin->user->delete();
        }
        return redirect()->back()->with('success','Akun Berhasil dihapus !');
    }

    public function edit($id){
        $admin = Admin::findOrFail($id);
        $_admin = collect([
            'id'                => $admin->id,
            'name'              => $admin->user->name,
            'email'             => $admin->user->email,
            'identity_number'   => $admin->user->identity_number,
            'position'          => $admin->position,
            'phone'             => $admin->phone,
            'major_id'          => $admin->user->major_id    
        ]);

        return $_admin;
    }

    public function update(Request $request, $id){
        $admin = Admin::findOrFail($id);
        $request->validate([
            'name'              => 'required',
            'email'             => [
                'required',
                'email',
                Rule::unique('users')->ignore($admin->user->id)
            ],
            'identity_number'   => [
                'required',
                Rule::unique('users')->ignore($admin->user->id),
            ],
            'position'          => 'required',
            'phone'             => 'required|numeric',
            'major_id'          => 'required|exists:majors,id'
        ]);

        $admin->updateAdmin($request);

        return redirect()->back()->with('success','Data Berhasil diperbaharui !');
    }
}
