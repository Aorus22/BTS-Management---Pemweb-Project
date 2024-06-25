<?php

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use App\Models\Pilihan_Kuesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class KuesionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
//        $kuesioner = Kuesioner::with(['createdBy', 'editedBy'])->get();

        $kuesioner = Kuesioner::with(['createdBy', 'editedBy'])
            ->select('id', 'pertanyaan', 'created_by', 'edited_by', 'created_at', 'updated_at')
            ->get();

        $kuesioner = $kuesioner->map(function ($kuesioner) {
            return [
                'id' => $kuesioner->id,
                'pertanyaan' => $kuesioner->pertanyaan,
                'created_by' => optional($kuesioner->createdBy)->email,
                'edited_by' => optional($kuesioner->editedBy)->email,
                'created_at' => $kuesioner->created_at,
                'updated_at' => $kuesioner->updated_at,
            ];
        });

        return Inertia::render('Kuesioner/index', ['kuesioner' => $kuesioner]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Kuesioner/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = Auth::id();

        Kuesioner::create($data);
        return redirect()->route('data-kuesioner.index')->with('success', 'Kuesioner berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): \Inertia\Response
    {
        // Mengambil data kuesioner berdasarkan ID
        $kuesioner = Kuesioner::findOrFail($id);
        $formattedKuesioner = [
            'id' => $kuesioner->id,
            'pertanyaan' => $kuesioner->pertanyaan,
        ];

        $pilihanKuesioner = Pilihan_Kuesioner::with(['createdBy', 'editedBy'])
            ->where('id_kuesioner', $id)
            ->select('id', 'id_kuesioner', 'pilihan_jawaban', 'created_by', 'edited_by', 'created_at', 'updated_at')
            ->get();

        $formattedPilihanKuesioner = $pilihanKuesioner->map(function ($pilihan) {
            return [
                'id' => $pilihan->id,
                'id_kuesioner' => $pilihan->id_kuesioner,
                'pilihan_jawaban' => $pilihan->pilihan_jawaban,
                'created_by' => optional($pilihan->createdBy)->email,
                'edited_by' => optional($pilihan->editedBy)->email,
                'created_at' => $pilihan->created_at,
                'updated_at' => $pilihan->updated_at,
            ];
        });

        return Inertia::render('Kuesioner/edit', [
            'kuesioner' => $formattedKuesioner,
            'pilihan_kuesioner' => $formattedPilihanKuesioner,
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
    public function update(Request $request, Kuesioner $kuesioner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $kuesioner = Kuesioner::find($id);
        $kuesioner->delete();
        return redirect()->route('data-kuesioner.index')->with('success', 'Kuesioner berhasil dihapus');
    }
}
