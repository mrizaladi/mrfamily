<?php

namespace App\Http\Controllers;

use App\Models\Simpatisan;
use App\Models\Tps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        $cacheKeySimpatisan = 'simpatisan_data';
        $data['simpatisan'] = Cache::remember($cacheKeySimpatisan, now()->addMinutes(10), function () {
            return Simpatisan::select(
                'regencies.name as kota',
                DB::raw('COUNT(*) as total_pemilih'),
                DB::raw('COUNT(CASE WHEN simpatisans.regency_id IN (1, 2, 3, 4) AND user_id NOT IN (18, 19, 20, 21) AND nik IS NOT NULL THEN 1 END) as total_simpatisan')
            )
                ->join('regencies', 'regencies.id', '=', 'simpatisans.regency_id')
                ->whereIn('simpatisans.regency_id', [1, 2, 3, 4])
                ->groupBy('regencies.id', 'regencies.name')
                ->get();
        });

        $cacheKeyTps = 'tps_data';
        $data['tps'] = Cache::remember($cacheKeyTps, now()->addMinutes(5), function () {
            return Tps::select(
                'regencies.name as kabupaten',
                DB::raw('sum(total_voters) as total_voters'),
                DB::raw('sum(golkars) as total_golkars')
            )
                ->join('regencies', 'regencies.id', '=', 'tps.regency_id')
                ->whereIn('tps.regency_id', [1, 2, 3, 4])
                ->where('tps.isFastCount', false)
                ->groupBy('regencies.id', 'regencies.name')
                ->get();
        });

        $cacheKeyContributors = 'top_contributors';
        $data['contributors'] = Cache::remember($cacheKeyContributors, now()->addMinutes(10), function () {
            return DB::select("
                SELECT
                    users.name AS nama_user,
                    COUNT(*) AS total_input
                FROM
                    simpatisans
                JOIN
                    users ON users.id = simpatisans.user_id
                GROUP BY
                    users.id, users.name, simpatisans.user_id
                ORDER BY
                    total_input DESC
                LIMIT 10
            ");
        });

        return view('home', $data);
    }
}
