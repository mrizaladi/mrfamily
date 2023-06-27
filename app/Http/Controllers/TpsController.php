<?php

namespace App\Http\Controllers;

class TpsController extends Controller
{
    public function store() 
    {
        toastr()->success('Data berhasil disimpan!');
        return view('tps.index');
    }

    public function destroy()
    {
        toastr()->warning('Data berhasil dihapus!');
        return view('tps.index');
    }

    public function edit()
    {
        return view('tps.edit');
    }

    public function update()
    {
        toastr()->info('Data berhasil diupdate!');
        return view('tps.index');
    }

    public function import()
    {
        return view('tps.import');
    }
}
