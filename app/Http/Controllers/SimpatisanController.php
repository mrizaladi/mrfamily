<?php

namespace App\Http\Controllers;

use App\DataTables\SimpatisanDataTable;
use App\Models\District;
use App\Models\Regency;
use App\Models\Subdistrict;
use App\Models\Simpatisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class SimpatisanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SimpatisanDataTable $dataTable)
    {
        $data['title'] = 'Simpatisan';
        return $dataTable->render('datatables.base', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function form()
    {
        $data['dpt'] = Simpatisan::with(['regency', 'district', 'subdistrict'])->limit(100)->get();
        return view('simpatisan.form', $data);
    }

    public function handleSelect(Request $request)
    {
        $sim = $request->dpt;
        if($sim){
            return redirect()->route('simpatisan.edit', ['simpatisan' => $sim]);
        }else{
            return redirect()->route('simpatisan.create');
        }
    }

    public function create()
    {
        $data['regencies'] = DB::table('regencies')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['subdistricts'] = DB::table('subdistricts')->get();

        return view('simpatisan.create', $data);
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
            'nik' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'sex' => 'required',
            'ktp' => 'required|file|mimes:jpg,png,jpeg,gif,svg,pdf,doc,docx|max:4096'
        ]);

        if ($request->hasFile('ktp')) {
            $image = $request->file('ktp');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('fotoktp', $imageName);

            $validatedData['ktp'] = $imageName;
        }

        $validatedData['user_id'] = auth()->user()->id;

        Simpatisan::create($validatedData);
        
        return redirect()->route('simpatisan.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $simpatisan = Simpatisan::find($id);

        return view('simpatisan.show', ['simpatisan'=> $simpatisan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['regencies'] = DB::table('regencies')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['subdistricts'] = DB::table('subdistricts')->get();
        $data['sim'] = Simpatisan::find($id);

        return view('simpatisan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sim = Simpatisan::find($id);

        $validatedData = $request->validate([
            'regency_id' => 'required',
            'district_id' => 'required',
            'subdistrict_id' => 'required',
            'nik' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'sex' => 'required',
            'ktp' => 'file|mimes:jpg,png,jpeg,gif,svg,pdf|max:4096'
        ]);

        $sim->update($validatedData);

        return redirect()->route('simpatisan.index')->with('success', 'Data berhasil diupdate.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sim = Simpatisan::find($id);

        $sim->delete();
        return redirect()->route('simpatisan.index')->with('info', 'Data berhasil dihapus');
    }

    public function district($id)
    {
        $district = District::where('regency_id', $id)->get();
        return Response::json($district);
    }

    public function subdistrict($id)
    {
        $subdistricts = Subdistrict::where('district_id', $id)->get();
        return Response::json($subdistricts);
    }

}
