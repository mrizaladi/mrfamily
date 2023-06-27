<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimpatisanController extends Controller
{
    public function store()
    {
        toastr()->success('Data berhasil disimpan');
        return view('simpatisan.index');
    }
}
