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
        $regency = Regency::orderBy('name')->get();
        return view('simpatisan.form', compact('regency'));
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
            'name' => 'required',
            'nik' => '',
            'phone' => '',
            'sex' => 'required',
            'ktp' => 'file|mimes:jpg,png,jpeg,gif,svg,pdf,doc,docx|max:4096'
        ]);

        if (!$request->nik && !$request->hasFile('ktp')) {
            return back()->with('error', 'KTP dan NIK tidak boleh kosong');
        }

        if ($request->hasFile('ktp')) {
            $image = $request->file('ktp');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('ktp'), $imageName);
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
            'name' => 'required',
            'sex' => 'required',
            'phone' => '',
            'nik' => '',            
            'ktp' => 'file|mimes:jpg,png,jpeg,gif,svg,pdf|max:4096'
        ]);

        if (!$request->nik && !$request->hasFile('ktp')) {
            return back()->with('error', 'KTP dan NIK tidak boleh kosong');
        }

        if ($request->hasFile('ktp')) {
            $image = $request->file('ktp');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('ktp'), $imageName);

            if ($sim->ktp && file_exists(public_path('ktp/' . $sim->ktp))) {
                unlink(public_path('ktp/' . $sim->ktp));
            }

            $validatedData['ktp'] = $imageName;

            $sim->update(['status' => true]);
        }
        $validatedData['user_id'] = auth()->user()->id;

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

    public function approve(Request $request)
    {
        try{
            $sim = Simpatisan::find($request->id);
            if($sim){
                Simpatisan::find($request->id)->update([
                    'status' => true
                ]);
                $data = [
                    'status' => 200,
                    'output' => 'Simpatisan data has ben Approved!'
                ];
            }else{
                $data = [
                    'status' => 400,
                    'output' => 'Simpatisan data not found!'
                ];
            }
        }catch (\Throwable $th) {
            DB::rollBack();
            $message = $th->getMessage();
            $data = [
                'status' => 500,
                'output' => $message
            ];
        }
        return Response::json($data);
    }

    public function getDistrict(Request $request)
    {  
       if($request->search){
            $search = strtolower(trim($request->search));
            $data = District::where('regency_id',$request->regency)
                            ->where(db::raw("lower(name)"),'like',"%$search%")
                            ->orderBy('name','ASC')
                            ->get();
       }else{
            $data = District::where('regency_id',$request->regency)
                            ->orderBy('name','ASC')
                            ->get();
       }
       return response()->json($data,200);
    }

    public function getSubDistrict(Request $request)
    {
       if($request->search){
            $search = strtolower(trim($request->search));
            $data = Subdistrict::where('district_id',$request->district)
                                ->where(db::raw("lower(name)"),'like',"%$search%")
                                ->orderBy('name','ASC')
                                ->get();
       }else{
            $data = Subdistrict::where('district_id',$request->district)
                                ->orderBy('name','ASC')
                                ->get();
       }
       return response()->json($data,200);
    }

    public function getSimpatisan(Request $request)
    {
       if($request->search){
            $search = strtolower(trim($request->search));
            $data = Simpatisan::where('regency_id',$request->regency)
                                ->where('district_id',$request->district)
                                ->where('subdistrict_id',$request->subdistrict)
                                ->where(db::raw("lower(name)"),'like',"%$search%")
                                ->orderBy('name','ASC')
                                ->get();
       }else{
            $data = Simpatisan::where('regency_id',$request->regency)
                                ->where('district_id',$request->district)
                                ->where('subdistrict_id',$request->subdistrict)
                                ->orderBy('name','ASC')
                                ->get();
       }
       return response()->json($data,200);
    }
}
