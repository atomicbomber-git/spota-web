<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard.index');
    }

    public function dosen()
    {
        return view('dosen.dashboard.index');
    }

    public function mahasiswa()
    {
        return view('mahasiswa.dashboard.index');
    }
}
