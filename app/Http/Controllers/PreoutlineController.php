<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use App\Preoutline;


class PreoutlineController extends Controller
{
    public function create(){
        return view('mahasiswa.dashboard.praoutline');
    }

    public function store(Request $request){
        $request->validate([
            'description'       => 'required|string',
            'suggestor'         => [
                'nullable',
                'numeric',
                Rule::exists('lecturers')->where(function ($query){
                    $query->where('major_id',Auth::user()->major_id());
                })
            ],
            'supervisors'       => 'required|array',
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
            ],
            'file'              => 'required|file|mimes:pdf'
        ]);


        $preoutline = new Preoutline;
        $preoutline->storePreoutline($request);
    }
}
