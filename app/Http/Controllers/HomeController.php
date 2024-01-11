<?php

namespace App\Http\Controllers;

use App\Models\Simpatisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data['simpatisan'] = Simpatisan::select(
            'regencies.name as kota',
            DB::raw('COUNT(*) as total_pemilih'),
            DB::raw('COUNT(CASE WHEN simpatisans.regency_id IN (1, 2, 3, 4) AND user_id NOT IN (18, 19, 20, 21) AND nik IS NOT NULL THEN 1 END) as total_simpatisan')
            )
            ->join('regencies', 'regencies.id', '=', 'simpatisans.regency_id')
            ->whereIn('simpatisans.regency_id', [1, 2, 3, 4])
            ->groupBy('regencies.id', 'regencies.name')
            ->get();
        return view('home', $data);
    }
}
