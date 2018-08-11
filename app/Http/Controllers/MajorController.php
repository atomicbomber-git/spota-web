<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Department;
use App\Faculty;
use App\Major;
use App\Configuration;

class MajorController extends Controller
{
    public function index(){
        return view('admin.dashboard.superadmin.prodi',['faculties'=>Faculty::all(), 'departments'=>Department::all(), 'majors'=>Major::all()]);
    }

    public function store(Request $request){
        $request->validate([
            'department_id'    => 'nullable|exists:departments,id',
            'faculty_id'       => 'required|exists:faculties,id',
            'name'             => 'required'
        ]);
        
        $major = new Major;
        DB::transaction(function() use ($request,$major){
            $major->fill($request->all());
            $major->save();

            $major->configuration()->save(new Configuration(['major_id'=>$major->id, 'current_semester' => '']));

        },2);

        return redirect()->route('major.index')->with('success','Data berhasil ditambahkan .');
    }

    public function show($id){
        return Major::findOrFail($id);
    }

    public function update(Request $request,$id){
        $department = Major::findOrFail($id);
        $request->validate([
            'faculty_id'    => 'required|exists:faculties,id',
            'name'          => 'required'
        ]);
        $department->update($request->all());
        return redirect()->route('major.index')->with('success','Data Berhasil diperbaharui .');
    }

    public function destroy($id){
        Major::findOrFail($id)->delete();
        return redirect()->route('major.index')->with('success','Data Berhasil dihapus .');
    }

}
