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
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Auth;

class SimpatisanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SimpatisanDataTable $dataTable)
    {
        $data['title'] = 'Simpatisan';
        // return $dataTable->render('datatables.base', $data);//OLD
        // return view('datatables.base', $data);//OLD
        $data['regency'] = Regency::orderBy('name')->get();//NEW WITH FILTER
        return view('simpatisan.index', $data);//NEW WITH FILTER
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
            'age' => 'required',            
            'rt' => 'required',            
            'rw' => 'required',            
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

    public function getDataSimpatisan(Request $request){
        // return $request->all();
        if ($request->ajax())
          {   
            $regency = $request->regency;
            $district = $request->district;
            $subdistrict = $request->subdistrict;
            $data = Simpatisan::whereNotNull('nik');
            if (Auth::user()->hasRole('user')) {
                $data->where('regency_id', '=', Auth::user()->regency_id)->where('district_id','=', Auth::user()->district_id)->where('subdistrict_id', '=', Auth::user()->subdistrict_id)->whereNotNull('nik');
            }elseif(Auth::user()->hasRole('admin')) {
                $data->where('regency_id', '=', Auth::user()->regency_id)->whereNotNull('nik');
            }elseif(Auth::user()->hasRole('superadmin') && Auth::user()->name != 'Superadmin'){
                $data->where('regency_id', '=', Auth::user()->regency_id)->whereNotNull('nik');
            }elseif(Auth::user()->hasRole('superadmin')) {
                $data->whereNotNull('nik');
            }

            $data->when($regency, function($query)use($regency){$query->where('regency_id', $regency);});
            $data->when($district, function($query)use($district){$query->where('district_id', $district);});
            $data->when($subdistrict, function($query)use($subdistrict){$query->where('subdistrict_id', $subdistrict);});

                     
             return Datatables::of($data)
                  ->editColumn('status', function ($row) {
                    $allowedEx = ['jpeg','jpg','png','ico','jfif','webp'];
                    $fileExtension = pathinfo($row->ktp, PATHINFO_EXTENSION);
                    if (in_array(strtolower($fileExtension), $allowedEx) || $row->status == true){
                        $temp = '<a readonly class="disable badge bg-success text-nowrap text-decoration-none" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                        </svg> Valid</a>';
                        return $temp;
                    }
                    else{
                        if(!$row->nik){
                            $temp = '<a readonly class="disable badge bg-secondary text-nowrap text-decoration-none" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                          </svg> Incomplete data</a>';
                            return $row->status == false?$temp:'';
                        }
                        else{
                            $temp = '<a readonly class="disable badge bg-success text-nowrap text-decoration-none" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg> Valid</a>';
                            return $row->status == false?$temp:'';
                        }
                    }
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
                    $actions .= '<a href="' . route('simpatisan.edit', $row->id) . '" class="btn btn-outline-success btn-icon ms-1">';
                    $actions .= '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">';
                    $actions .= '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>';
                    $actions .= '<path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>';
                    $actions .= '<path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>';
                    $actions .= '<path d="M16 5l3 3"></path>';
                    $actions .= '</svg>';
                    $actions .= '</a>';
                    $actions .= '</form>';
                    $actions .= '</div>';
    
                    return $actions;
                })
                ->editColumn('regency_id', function ($row) {
                    return $row->regency?->name;
                })
                ->editColumn('district_id', function ($row) {
                    return $row->district?->name;
                })
                ->editColumn('subdistrict_id', function ($row) {
                    return $row->subdistrict?->name;
                })
                ->editColumn('user_id', function ($row) {
                    return $row->user?->name;
                })
                ->editColumn('created_at', function ($row) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d F y H:i');
                    return $formatedDate;
                })
                ->rawColumns(['action','status'])
                ->make(true);
          }
        }
}
