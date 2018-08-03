<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;
class FacultyController extends Controller
{
    public function index(){
        return view('admin.dashboard.superadmin.fakultas',['faculties'=>Faculty::all()]);
    }

    public function store(Request $request){
        $request->validate([
            'name'      => 'required|string',
            'code'      => 'required|string'
        ]);

        $faculty = new Faculty;
        $faculty->fill($request->all());
        $faculty->save();
        return redirect()->route('faculty.index');
    }

    public function department($id){
        return Faculty::findOrFail($id)->department;
    }

    public function show($id){
        return Faculty::findOrFail($id);
    }

    public function update(Request $request,$id){
        $faculty = Faculty::findOrFail($id);
        $request->validate([
            'name'      => 'required|string',
            'code'      => 'required|string'
        ]);

        $faculty->update($request->all());
        return redirect()->route('faculty.index');
    }

    public function destroy($id){
        Faculty::findOrFail($id)->delete();
        return redirect()->route('faculty.index');
    }

}
