<?php

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use App\Models\Pilihan_Kuesioner;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = Auth::id();

        Pilihan_Kuesioner::create($data);
        return redirect('/data-kuesioner/'.$data['id_kuesioner'])->with('success', 'Pilihan Kuesioner berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
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
