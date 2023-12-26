<?php

namespace App\Http\Controllers;

use App\Models\Simpatisan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['totalSimpatisanKendal'] = Simpatisan::where('regency_id', 1)->whereNotIn('user_id', [18,19,20,21])->whereNotNull('nik')->count();
        $data['totalSimpatisanKabSemarang'] = Simpatisan::where('regency_id', 2)->whereNotIn('user_id', [18,19,20,21])->whereNotNull('nik')->count();
        $data['totalSimpatisanSalatiga'] = Simpatisan::where('regency_id', 3)->whereNotIn('user_id', [18,19,20,21])->whereNotNull('nik')->count();
        $data['totalSimpatisanKotaSemarang'] = Simpatisan::where('regency_id', 4)->whereNotIn('user_id', [18,19,20,21])->whereNotNull('nik')->count();

        $data['totalPemilihKendal'] = Simpatisan::where('regency_id', 1)->count();
        $data['totalPemilihKabSemarang'] = Simpatisan::where('regency_id', 2)->count();
        $data['totalPemilihSalatiga'] = Simpatisan::where('regency_id', 3)->count();
        $data['totalPemilihKotaSemarang'] = Simpatisan::where('regency_id', 4)->count();
        return view('home', $data);
    }
}
