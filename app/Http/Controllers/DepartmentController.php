<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Faculty;

class DepartmentController extends Controller
{
    public function index(){
        return view('admin.dashboard.superadmin.jurusan',['faculties'=>Faculty::all(), 'departments'=>Department::all()]);
    }

    public function store(Request $request){
        $request->validate([
            'faculty_id'    => 'required|exists:faculties,id',
            'name'          => 'required'
        ]);

        $department = new Department;
        $department->fill($request->all());
        $department->save();
        return redirect()->route('department.index');
    }

    public function show($id){
        return Department::findOrFail($id);
    }

    public function update(Request $request,$id){
        $department = Department::findOrFail($id);
        $request->validate([
            'faculty_id'    => 'required|exists:faculties,id',
            'name'          => 'required'
        ]);
        $department->update($request->all());
        return redirect()->route('department.index');
    }

    public function destroy($id){
        Department::findOrFail($id)->delete();
        return redirect()->route('department.index');
    }
}
