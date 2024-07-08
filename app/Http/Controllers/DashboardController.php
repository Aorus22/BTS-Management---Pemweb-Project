<?php

namespace App\Http\Controllers;

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


        return Inertia::render('Dashboard', [
            'totalJenisBTS' => $totalJenisBTS,
            'totalPemilikBTS' => $totalPemilikBTS,
            'totalWilayahBTS' => $totalWilayahBTS,
            'totalMonitoring' => $totalMonitoring
        ]);
    }
}
