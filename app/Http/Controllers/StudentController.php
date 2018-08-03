<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Student;


class StudentController extends Controller
{
    public function index(Request $request){
        // return Auth::user()->major_id;
        $students = DB::table('users')
            ->join('students',function($join){
                $join->on('users.id','=','students.user_id')
                    ->where('users.major_id','=',Auth::user()->major_id);
            })->select('users.*','students.id as student_id','students.batch')
            ->orderBy('users.created_at','desc')
            ->paginate(30);

        if(!empty($request->search)){
            $students = DB::table('users')
                ->join('students',function($join) use ($request){
                    $join->on('users.id','=','students.user_id')
                        ->where('users.major_id','=',Auth::user()->major_id)
                        ->where(function($query) use ($request){
                            $query->where('users.name','like','%'.$request->search.'%')
                            ->orWhere('users.identity_number','like','%'.$request->search.'%');
                        });
                })->select('users.*','students.id as student_id','students.batch')
                ->orderBy('users.created_at','desc')
                ->paginate(30);
        }


        return view('admin.dashboard.admin.mahasiswa',['students' => $students] );
    }

    public function store(Request $request){
        $request->validate([
            'name'              => 'required',
            'email'             => 'required|unique:users,email',
            'identity_number'   => 'required|unique:users,identity_number',
            'password'          => 'required|string|between:6,12',
            'batch'             => 'required|integer|between:2004,'.date('Y'),
            'picture'           => 'nullable|image|mimes:jpg,jpeg,png|max:1024'
        ]);

        $student = new User;
        $student->storeStudent($request);
        return redirect()->back()->with('success','Akun Berhasil ditambahkan !');
    }

    public function show($id){
        $student = Student::findOrFail($id);
        $this->authorize('manage-student',$student);
        return view('admin.dashboard.admin.profil-mahasiswa',['student'=>$student]);
    }

    public function update(Request $request,$id){
        $student = Student::findOrFail($id);
        $request->validate([
            'name'              => 'required',
            'email'             => [
                'required',
                Rule::unique('users')->ignore($student->user->id)
            ],
            'password'          => 'nullable|string|between:6,12',
            'batch'             => 'required|integer|between:2004,'.date('Y'),
            'picture'           => 'nullable|image|mimes:jpg,jpeg,png|max:1024'
        ]);
        $student->updateStudent($request);
        return redirect()->route('student.index')->with('success','Akun berhasil diperbaharui');

    }

    public function destroy($id){
        $student = Student::findOrFail($id);
        $this->authorize('manage-student',$student);
        Storage::disk('public')->delete('student/'.$student->user->major_id.'/'.$student->picture);
        $student->user->delete();
        return redirect()->route('student.index')->with('success','Akun berhasil dihapus !');

    }

    public function activate($id){
        $student = Student::findOrFail($id);
        $this->authorize('manage-student',$student);
        $student->user->activate();
        return redirect()->back();
    }


 
}
