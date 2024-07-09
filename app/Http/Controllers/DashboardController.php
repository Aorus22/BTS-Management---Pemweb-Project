<?php

namespace App\Http\Controllers;

use App\Models\BTS;
use App\Models\JenisBTS;
use App\Models\Monitoring;
use App\Models\Pemilik;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $totalJenisBTS = JenisBTS::count();
        $totalWilayahBTS = Wilayah::count();
        $totalPemilikBTS = Pemilik::count();
        $totalMonitoring = Monitoring::count();

        $btsPerJenis = BTS::selectRaw('jenis_bts.nama as jenis_bts, COUNT(bts.id) as jumlah_bts')
        ->join('jenis_bts', 'bts.id_jenis_bts', '=', 'jenis_bts.id')
        ->groupBy('jenis_bts.nama')
        ->get();

        $btsPerWilayah = BTS::selectRaw('wilayah.nama as nama_wilayah, COUNT(bts.id) as jumlah_bts')
            ->join('wilayah', 'bts.id_wilayah', '=', 'wilayah.id')
            ->where('wilayah.level', 2)
            ->groupBy('wilayah.nama')
            ->get();

        $btsPerPemilik = BTS::selectRaw('pemilik.nama as nama_pemilik, COUNT(bts.id) as jumlah_bts')
            ->join('pemilik', 'bts.id_pemilik', '=', 'pemilik.id')
            ->groupBy('pemilik.nama')
            ->get();

        $btsData = BTS::select('latitude', 'longitude', 'nama')->get();

        $lokasiTower = $btsData->map(function ($item) {
            return [
                'lat' => $item->latitude,
                'lng' => $item->longitude,
                'name' => $item->nama,
            ];
        });


        return Inertia::render('Dashboard', [
            'totalJenisBTS' => $totalJenisBTS,
            'totalPemilikBTS' => $totalPemilikBTS,
            'totalWilayahBTS' => $totalWilayahBTS,
            'totalMonitoring' => $totalMonitoring,
            'btsPerJenis' => $btsPerJenis,
            'btsPerWilayah' => $btsPerWilayah,
            'btsPerPemilik' => $btsPerPemilik,
            'lokasiTower' => $lokasiTower
        ]);
    }
}
