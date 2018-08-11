<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Lecturer;


class LecturerController extends Controller
{
    public function index(){
        return view('admin.dashboard.admin.dosen',['lecturers'=>User::where('major_id',Auth::user()->major_id)->select('id','name','email','identity_number','status')->where('type','D')->get()]);
    }

    public function store(Request $request){
        $request->validate([
            'name'              => 'required|string',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|string|between:6,12',
            'identity_number'   => 'required|string|unique:users,identity_number',
            'position'          => 'required|string',
            'phone'             => 'required|numeric',
            'picture'           => 'nullable|image|max:1024|mimes:jpg,jpeg,png',
            'privileges'        => [
                'required',Rule::in(['K','D'])
            ]
        ]);

        $lecturer = new User;
        $lecturer->storeLecturer($request);
        return redirect()->back()->with('success','Akun Dosen Berhasil ditambah !');
    }

    public function edit($id){
        $lecturer = Lecturer::findOrFail($id);
        $this->authorize('manage-lecturer',$lecturer);
        return view('admin.dashboard.admin.profil-dosen',['lecturer'=>$lecturer]);
    }

    public function activate($id){
        $lecturer = Lecturer::findOrFail($id);
        $this->authorize('manage-lecturer',$lecturer);
        $lecturer->user->activate();
        return redirect()->route('lecturer.index');
    }

    public function update(Request $request,$id){
        $lecturer = Lecturer::findOrFail($id);
        $this->authorize('manage-lecturer',$lecturer);
        $request->validate([
            'name'              => 'required|string',
            'email'             => [
                'required',
                Rule::unique('users')->ignore($lecturer->user->id)
            ],
            'password'          => 'nullable|string|between:6,12',
            'identity_number'   => [
                'required',
                'string',
                Rule::unique('users')->ignore($lecturer->user->id)
            ],
            'position'          => 'required|string',
            'phone'             => 'required|numeric',
            'picture'           => 'nullable|image|max:1024|mimes:jpg,jpeg,png',
        ]);
        $lecturer->updateLecturer($request);
        return redirect()->back()->with('success','Akun berhasil diubah .');
    }

    public function destroy($id){
        $lecturer = Lecturer::findOrFail($id);
        $this->authorize('manage-lecturer',$lecturer);
        Storage::disk('public')->delete('lecturers/'.$lecturer->user->major_id.'/'.$lecturer->picture);
        $lecturer->user->delete();
        return redirect()->route('lecturer.index');
    }

    public function updateMajorLeader(Request $request){
        $request->validate([
            'major_leaders'     => 'required|array'
        ]);

        $_major_leaders = DB::table('users')
            ->join('lecturers','lecturers.user_id','=','users.id')
            ->where('users.major_id',Auth::user()->major_id)
            ->select('lecturers.id')->get();

        $compare = function() use ($request,$_major_leaders){
            $arr_major_leaders = $_major_leaders->pluck('id')->toArray();
            $test = array_intersect($arr_major_leaders,$request->major_leaders);
            $bool_request = count($request->major_leaders) == count($test);
            return $bool_request;
        };

        if(!$compare()){
            return redirect()->route('configuration.index')->with('errors',collect(['Lecturer(s) not found']));
        }
        $lecturers = DB::table('users')
        ->join('lecturers','lecturers.user_id','=','users.id')
        ->where('users.major_id',Auth::user()->major_id)->where('lecturers.privileges','K')->update(['privileges'=>'D']);
        
        foreach($request->major_leaders as $major_leader){
            $lecturer = Lecturer::find($major_leader);
            $lecturer->privileges = 'K';
            $lecturer->save();
            unset($lecturer);
        }

        return redirect()->route('configuration.index')->with('success','Akun kaprodi berhasil diperbaharui.');
        
    }

}
