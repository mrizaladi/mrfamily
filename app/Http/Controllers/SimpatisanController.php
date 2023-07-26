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
use DataTables;
use Carbon\Carbon;

class SimpatisanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(SimpatisanDataTable $dataTable)
    // {
    //     $data['title'] = 'Simpatisan';
    //     return $dataTable->render('datatables.base', $data);
    // }

    public function index(){
        return view('simpatisan.index');
    }

    public function getSimpatisan(Request $request){
    if ($request->ajax())
      {   
         $data = Simpatisan::whereNotNull('nik');
                 
         return Datatables::of($data)
              ->addIndexColumn()
              ->editColumn('regency_id', function($data)
              {
                 return $data->regency?->name;
              })
              ->editColumn('district_id', function($data)
              {
                 return $data->district?->name;
              })
              ->editColumn('subdistrict_id', function($data)
              {
                 return $data->subdistrict?->name;
              })
              ->editColumn('user_id', function($data)
              {
                 return $data->user?->name;
              })
              ->editColumn('created_at', function($data)
              { 
                return $data->created_at?date('Y-m-d H:i:s',strtotime($data->created_at)):'';
              })
              ->addColumn('action', function ($row) {
                $actions = '<div class="d-flex justify-content-around">';
                $actions .= '<a href="' . route('simpatisan.show', $row->id) . '" class="btn btn-outline-primary btn-icon">';
                $actions .= '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">';
                $actions .= '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>';
                $actions .= '<path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>';
                $actions .= '<path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>';   
                $actions .= '</svg>';
                $actions .= '</a>';
                $actions .= '<a href="' . route('simpatisan.edit', $row->id) . '" class="btn btn-outline-success btn-icon">';
                $actions .= '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">';
                $actions .= '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>';
                $actions .= '<path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>';
                $actions .= '<path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>';
                $actions .= '<path d="M16 5l3 3"></path>';
                $actions .= '</svg>';
                $actions .= '</a>';
                $actions .= '<form action="' . route('simpatisan.destroy', $row->id) . '" method="POST">';
                $actions .= csrf_field();
                $actions .= method_field('DELETE');
                $actions .= '<button type="submit" class="btn btn-outline-danger btn-icon" onclick="return confirm(\'Apakah Anda yakin ingin menghapus item ini?\')">';
                $actions .= '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">';
                $actions .= '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>';
                $actions .= '<path d="M4 7l16 0"></path>';
                $actions .= '<path d="M10 11l0 6"></path>';
                $actions .= '<path d="M14 11l0 6"></path>';
                $actions .= '<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>';
                $actions .= '<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>';
                $actions .= '</svg>';
                $actions .= '</button>';
                $actions .= '</form>';
                $actions .= '</div>';

                return $actions;
                })
              ->make(true);
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
            'ktp' => 'required|file|mimes:jpg,png,jpeg,gif,svg,pdf|max:4096'
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
