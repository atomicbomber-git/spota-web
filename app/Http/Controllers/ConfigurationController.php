<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Configuration;
use App\Major;

class ConfigurationController extends Controller
{
    public function index(){
        $configuration = Major::find(Auth::user()->major_id)->configuration;
        $major_leaders = DB::table('users')->join('lecturers','users.id','=','lecturers.user_id')->where('users.major_id',Auth::user()->major_id)->where('lecturers.privileges','K')->select('users.*','lecturers.privileges')->get();
        $lecturers = DB::table('users')->join('lecturers','users.id','=','lecturers.user_id')->where('users.major_id',Auth::user()->major_id)->select('users.name','lecturers.privileges','lecturers.id as lecturer_id')->get();
        return view('admin.dashboard.admin.konfigurasi',['configuration'=>$configuration, 'major_leaders'=>$major_leaders, 'lecturers' => $lecturers]);
    }

    public function update(Request $request){
        $request->validate([
            'current_semester'      => 'required|string',
            'semesters_year'        => 'required|string',
            'approved_count'        => 'required|integer|between:1,10'
        ]);

        $configuration = Major::find(Auth::user()->major_id)->configuration;
        $configuration->update($request->all());
        return redirect()->route('configuration.index')->with('success','Pengaturan berhasil diperbaharui .');
    }


}
