<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Expertise;

class ExpertiseController extends Controller
{
    public function index(){
        return view('admin.dashboard.admin.kelompok-keahlian',['expertises'=>Expertise::where('major_id',Auth::user()->major_id)->get()]);
    }

    public function store(Request $request){
        $request->validate([
            'name'  =>  'required|string'
        ]);

        $expertise = new Expertise;
        $expertise->name        =   $request->name;
        $expertise->major_id    = Auth::user()->major_id;
        $expertise->save();
        return redirect()->route('expertise.index')->with('success','Data berhasil ditambah .');
    }

    public function edit($id){
        return Expertise::findOrFail($id);
    }

    public function update(Request $request,$id){
        $expertise = Expertise::findOrFail($id);
        $expertise->name        = $request->name;
        $expertise->save();
        return redirect()->route('expertise.index')->with('success','Data berhasil diperbaharui .');
    }

    public function destroy($id){
        $expertise = Expertise::findOrFail($id);
        $expertise->delete();
        return redirect()->route('expertise.index')->with('success','Data berhasil dihapus .');
    }
}
