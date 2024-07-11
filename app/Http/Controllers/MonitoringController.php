<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonitoringRequest;
use App\Models\BTS;
use App\Models\JawabanKuesioner;
use App\Models\Kuesioner;
use App\Models\Monitoring;
use App\Models\Pilihan_Kuesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        $monitoring = Monitoring::with(['createdBy', 'editedBy', 'bts'])
            ->select('id', 'tahun', 'id_bts', 'tanggal_kunjungan', 'created_by', 'edited_by', 'created_at', 'updated_at')
            ->get();

        $monitoring = $monitoring->map(function ($monitoring) {
            return [
                'id' => $monitoring->id,
                'tahun' => $monitoring->tahun,
                'id_bts' => optional($monitoring->bts)->nama,
                'created_by' => optional($monitoring->createdBy)->email,
                'edited_by' => optional($monitoring->editedBy)->email,
                'created_at' => $monitoring->created_at,
                'updated_at' => $monitoring->updated_at,
            ];
        });

        return Inertia::render('Monitoring/index', ['monitoring' => $monitoring]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Inertia\Response
    {
        $bts = BTS::select('id', 'nama')->get();
        $kuesioner = Kuesioner::select('id', 'pertanyaan')->get();
        $pilihankuesioner = Pilihan_Kuesioner::with(['kuesioner'])
            ->select('id', 'id_kuesioner', 'pilihan_jawaban')
            ->get();
        $pilihankuesioner = $pilihankuesioner->map(function ($pilihankuesioner) {
            return [
                'id' => $pilihankuesioner->id,
                'id_kuesioner' => $pilihankuesioner->kuesioner->id,
                'pilihan_jawaban' => $pilihankuesioner->pilihan_jawaban,
            ];
        });

        return Inertia::render('Monitoring/create', ['bts' => $bts, 'kuesioner' => $kuesioner, 'pilihankuesioner' => $pilihankuesioner]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MonitoringRequest $request)
    {
        $user = Auth::id();
        $data = $request->validated();

        $monitoring = Monitoring::create([
            'id_bts'=> $data['id_bts'],
            'tahun'=> $data['tahun'],
            'tanggal_kunjungan'=> $data['tanggal_kunjungan'],
            'created_by'=> $user
        ]);

        $monitoringId = $monitoring->id;

        $jawabanData = $request->get('jawaban');
        foreach ($jawabanData as $id_kuesioner => $id_pilihan_kuesioner) {
            JawabanKuesioner::create([
                'id_monitoring' => $monitoringId,
                'id_kuesioner' => $id_kuesioner,
                'id_pilihan_kuesioner' => $id_pilihan_kuesioner,
                'created_by' => $user
            ]);
        }

        return redirect()->route('monitoring.index')->with('success', 'Monitoring berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $monitoring = Monitoring::findOrFail($id);
        $formattedmonitoring = [
            'id' => $monitoring->id,
            'tahun' => $monitoring->tahun,
            'tanggal_kunjungan' => $monitoring->tanggal_kunjungan,
            'id_bts' => optional($monitoring->bts)->nama,
        ];

        $jawaban = JawabanKuesioner::with(['kuesioner', 'pilihanjawaban'])
            ->where('id_monitoring', $id)
            ->select('id', 'id_kuesioner', 'id_pilihan_kuesioner')
            ->get();

        $jawaban = $jawaban->map(function($jawaban){
           return [
               'id' => $jawaban->id,
               'id_kuesioner' => optional($jawaban->kuesioner)->pertanyaan,
               'id_pilihan_kuesioner' => optional($jawaban->pilihanjawaban)->pilihan_jawaban,
           ];
        });

        return Inertia::render('Monitoring/show', [
            'monitoring' => $formattedmonitoring,
            'jawaban' => $jawaban
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kuesioner $kuesioner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $kuesioner = Kuesioner::findOrFail($id);
            $data = $request->all();
            $data['edited_by'] = Auth::id();
            $data['edited_at'] = Carbon::now();
            $kuesioner->update($data);
            return redirect()->route('data-kuesioner.index')->with('success', 'Kuesioner berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('data-kuesioner.edit', $id)->with('error', 'Terjadi kesalahan saat mengupdate kuesioner: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $monitoring = Monitoring::find($id);
        $monitoring->delete();
        return redirect()->route('monitoring.index')->with('success', 'Monitoring berhasil dihapus');
    }
}
