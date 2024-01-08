<?php

namespace App\Http\Controllers;

use App\DataTables\TpsDataTable;
use App\Models\Tps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TpsDataTable $dataTable)
    {
        $data['title'] = 'TPS';
        $data['route'] = 'tps.create';
        return $dataTable->render('datatables.base', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['regencies'] = DB::table('regencies')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['subdistricts'] = DB::table('subdistricts')->get();

        return view('tps.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'regency_id' => 'required',
            'district_id' => 'required',
            'subdistrict_id' => 'required',
            'village' => '',
            'tps' => 'required',
            'officer' => 'required',
            'total_voters' => 'required'
        ]);

        Tps::create($validatedData);

        return redirect()->route('tps.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['regencies'] = DB::table('regencies')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['subdistricts'] = DB::table('subdistricts')->get();
        $data['tp'] = Tps::find($id);

        return view('tps.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tp = Tps::find($id);

        $validatedData = $request->validate([
            'regency_id' => 'required',
            'district_id' => 'required',
            'subdistrict_id' => 'required',
            'tps' => 'required',
            'officer' => 'required',
            'total_voters' => 'required'
        ]);

        $tp->update($validatedData);

        return redirect()->route('tps.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tp = Tps::find($id);

        $tp->delete();
        return redirect()->route('tps.index')->with('info', 'Data berhasil dihapus');

    }
}
