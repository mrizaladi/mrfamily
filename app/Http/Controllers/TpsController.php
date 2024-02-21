<?php

namespace App\Http\Controllers;

use App\DataTables\TpsDataTable;
use App\Models\Tps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        if (Auth::user()->hasRole('superadmin')) {
            return $dataTable->render('datatables.base', $data);
        } else {
            return 'Anda tidak punya akses';
        }
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
            'tps' => 'required',
            'officer' => 'required',
            'total_voters' => 'required',
            'golkars' => 'required',
            'chec' => '',
            'proof' => 'file|mimes:jpg,png,jpeg,gif,svg,pdf,doc,docx|max:4096'
        ]);

        $tps = (string)$validatedData['tps'];

        $maxLength = 3;

        if (strlen($tps) < $maxLength) {
            $validatedData['tps'] = str_pad($tps, $maxLength, '0', STR_PAD_LEFT);
        } else {
            $validatedData['tps'] = $tps;
        }

        if ($request->hasFile('proof')) {
            $image = $request->file('proof');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('proof'), $imageName);

            $validatedData['proof'] = $imageName;
        }

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
            'total_voters' => 'required',
            'golkars' => 'required',
            'proof' => 'file|mimes:jpg,png,jpeg,gif,svg,pdf,doc,docx|max:4096'
        ]);

        $tps = (string)$validatedData['tps'];

        $maxLength = 3;

        if (strlen($tps) < $maxLength) {
            $validatedData['tps'] = str_pad($tps, $maxLength, '0', STR_PAD_LEFT);
        } else {
            $validatedData['tps'] = $tps;
        }

        if ($request->hasFile('proof')) {
            $image = $request->file('proof');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('proof'), $imageName);

            if ($tp->proof && file_exists(public_path('proof/' . $tp->proof))) {
                unlink(public_path('proof/' . $tp->proof));
            }

            $validatedData['proof'] = $imageName;

            $tp->update(['status' => true]);
        }

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
