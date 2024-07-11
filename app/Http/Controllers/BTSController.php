<?php

namespace App\Http\Controllers;

use App\Http\Requests\BTSRequest;
use App\Models\Bts;
use App\Models\JenisBTS;
use App\Models\Pemilik;
use App\Models\Wilayah;
use App\Models\Pengguna;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class BTSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $bts = BTS::with(['createdBy', 'editedBy', 'jenisBts', 'pemilik', 'wilayah'])
            ->select('*')
            ->get();

        $formattedJenisBts = $bts->map(function ($bts) {
            return [
                'id' => $bts->id,
                'nama' => $bts->nama,
                'alamat' => $bts->alamat,
                'latitude' => $bts->latitude,
                'longitude' => $bts->longitude,
                'tinggi_tower' => $bts->tinggi_tower,
                'panjang_tanah' => $bts->panjang_tanah,
                'lebar_tanah' => $bts->lebar_tanah,
                'ada_genset' => $bts->ada_genset,
                'ada_tembok_batas' => $bts->ada_tembok_batas,
                'id_jenis_bts'=> optional($bts->jenisBts)->nama,
                'id_pemilik' => optional($bts->pemilik)->nama,
                'id_wilayah' => optional($bts->wilayah)->nama,
            ];
        });

        return Inertia::render('BTS/index', ['Bts' => $formattedJenisBts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pemilik = Pemilik::select('id', 'nama')->get();
        $jenisBts = JenisBTS::select('id', 'nama')->get();
        $wilayahLevel2 = Wilayah::where('level', 2)->get(['id', 'nama']);
        return Inertia::render('BTS/create', ['wilayahLevel2' => $wilayahLevel2, 'pemilik' => $pemilik, 'jenisBts' => $jenisBts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BTSRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        BTS::create($data);
        return redirect()->route('bts.index')->with('success', 'BTS berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bts = BTS::findOrFail($id);
        $formattedbts = [
            'id' => $bts->id,
            'nama' => $bts->nama,
            'alamat' => $bts->alamat,
            'latitude' => $bts->latitude,
            'longitude' => $bts->longitude,
            'tinggi_tower' => $bts->tinggi_tower,
            'panjang_tanah' => $bts->panjang_tanah,
            'lebar_tanah' => $bts->lebar_tanah,
            'ada_genset' => $bts->ada_genset,
            'ada_tembok_batas' => $bts->ada_tembok_batas,
            'id_jenis_bts'=> optional($bts->jenisBts)->id,
            'id_pemilik' => optional($bts->pemilik)->id,
            'id_wilayah' => optional($bts->wilayah)->id,
        ];

        $pemilik = Pemilik::select('id', 'nama')->get();
        $jenisBts = JenisBTS::select('id', 'nama')->get();
        $wilayahLevel2 = Wilayah::where('level', 2)->get(['id', 'nama']);
        $pengguna = Pengguna::select('nama')->where('id_bts',$id)->get();

        return Inertia::render('BTS/edit', [
            'databts'=>$formattedbts,
            'wilayahLevel2' => $wilayahLevel2,
            'pemilik' => $pemilik,
            'jenisBts' => $jenisBts,
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BTSRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        $bts = BTS::findOrFail($id);
        $data['edited_by'] = Auth::id();
        $data['edited_at'] = Carbon::now();
        $bts->update($data);
        return redirect()->route('bts.index')->with('success', 'BTS berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $wilayah = BTS::find($id);
        $wilayah->delete();
        return redirect()->route('bts.index')->with('success', 'BTS berhasil dihapus');
    }

    public function exportToPDF(): \Illuminate\Http\Response
    {
        $bts = BTS::all();
        $pdf = PDF::loadView('bts.pdf', ['bts' => $bts]);

        return $pdf->download('bts-data.pdf');
    }
}
