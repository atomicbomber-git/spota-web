<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class PreoutlineController extends Controller
{
    public function create(){
        return view('mahasiswa.dashboard.praoutline');
    }

    public function store(Request $request){
        return dd($request);
        $request->validate([
            'description'       => 'required|string',
            'suggestor'         => [
                'nullable',
                'numeric',
                Rule::exists('lecturers')->where(function ($query){
                    $query->where('major_id',Auth::user()->major_id());
                })
            ],
            'supervisor1'       => 'required|string',
            'supervisor2'       => 'required|string',
            'supervisor3'       => 'required|string',
            'supervisor4'       => 'required|string',
            'counselor'         => [
                'required',
                Rule::exists('lecturers','name')->where(function ($query){
                    $query->where('major_id',Auth::user()->major_id());
                })
            ],
            'expertise_id'      => [
                'required',
                'numeric',
                Rule::exists('expertises','id')->where(function ($query){
                    $query->where('major_id',Auth::user()->major_id());
                })
            ]
        ]);
    }
}
