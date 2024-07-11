<?php

namespace App\Http\Controllers;

use App\Http\Requests\WilayahRequest;
use App\Models\JenisBTS;
use App\Models\Wilayah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        $wilayah = Wilayah::with(['parent', 'createdBy', 'editedBy'])
            ->select('id', 'nama', 'id_parent', 'level', 'created_by', 'edited_by', 'created_at', 'updated_at')
            ->get();

        $formattedWilayahs = $wilayah->map(function ($wilayah) {
            return [
                'id' => $wilayah->id,
                'nama' => $wilayah->nama,
                'nama_parent' => optional($wilayah->parent)->nama,
                'level' => $wilayah->level,
                'created_by' => optional($wilayah->createdBy)->email,
                'edited_by' => optional($wilayah->editedBy)->email,
                'created_at' => $wilayah->created_at,
                'updated_at' => $wilayah->updated_at,
            ];
        });

        return Inertia::render('Wilayah/index', ['wilayah' => $formattedWilayahs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wilayahLevel1 = Wilayah::where('level', 1)->get(['id', 'nama']);
        return Inertia::render('Wilayah/create', ['wilayahLevel1' => $wilayahLevel1]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WilayahRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        Wilayah::create($data);
        return redirect()->route('wilayah.index')->with('success', 'Jenis BTS berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $wilayah = Wilayah::findOrFail($id);
        $formattedwilayah = [
            'id' => $wilayah->id,
            'nama' => $wilayah->nama,
            'id_parent' => optional($wilayah->parent)->id,
            'level' => $wilayah->level
        ];

        $wilayahLevel1 = Wilayah::where('level', 1)->get(['id', 'nama']);
        return Inertia::render('Wilayah/edit', ['wilayah' => $formattedwilayah, 'wilayahLevel1' => $wilayahLevel1]);
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
    public function update(WilayahRequest $request, $id): RedirectResponse
    {
        $wilayah = Wilayah::findOrFail($id);
        $data = $request->validated();
        $data['edited_by'] = Auth::id();
        $data['edited_at'] = Carbon::now();
        $wilayah->update($data);
        return redirect()->route('wilayah.index')->with('success', 'Wilayah berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $wilayah = Wilayah::find($id);
        $wilayah->delete();
        return redirect()->route('wilayah.index')->with('success', 'Wilayah berhasil dihapus');
    }
}
