<?php

namespace App\Http\Controllers;

<<<<<<< Updated upstream
use App\Http\Requests\PilihanKuesionerRequest;
=======
use App\Http\Requests\PilihanKuesionerReqeust;
>>>>>>> Stashed changes
use App\Models\Kuesioner;
use App\Models\Pilihan_Kuesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PilihanKuesionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_kuesioner)
    {
        return Inertia::render('PilihanKuesioner/create', ['id_kuesioner' => $id_kuesioner]);
    }

    /**
     * Store a newly created resource in storage.
     */
<<<<<<< Updated upstream
    public function store(PilihanKuesionerRequest $request)
=======
    public function store(PilihanKuesionerReqeust $request)
>>>>>>> Stashed changes
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        Pilihan_Kuesioner::create($data);
        return redirect('/data-kuesioner/'.$data['id_kuesioner'])->with('success', 'Pilihan Kuesioner berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pilihan_kuesioner = Pilihan_Kuesioner::findOrFail($id);
        $pilihan_kuesioner = [
            'id' => $pilihan_kuesioner->id,
            'pilihan_jawaban' => $pilihan_kuesioner->pilihan_jawaban,
        ];

        return Inertia::render('PilihanKuesioner/edit', ['pilihan_kuesioner' => $pilihan_kuesioner]);
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
<<<<<<< Updated upstream
    public function update(PilihanKuesionerRequest $request, $id_kuesioner, $id)
=======
    public function update(PilihanKuesionerReqeust $request, $id_kuesioner, $id)
>>>>>>> Stashed changes
    {
        $pilihan_kuesioner = Pilihan_Kuesioner::findOrFail($id);
        $data = $request->validated();
        $data['edited_by'] = Auth::id();
        $data['edited_at'] = Carbon::now();
        $pilihan_kuesioner->update($data);
        return redirect('/data-kuesioner/'.$id_kuesioner)->with('success', 'Pilihan Kuesioner berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_kuesioner, $id)
    {
        $pilihan_kuesioner = Pilihan_Kuesioner::find($id);
        $pilihan_kuesioner->delete();
        return redirect('/data-kuesioner/'.$id_kuesioner)->with('success', 'Pilihan Kuesioner berhasil dihapus');
    }
}
