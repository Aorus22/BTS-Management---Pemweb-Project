<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $pemilik = Pemilik::with(['createdBy', 'editedBy'])
            ->select('id', 'nama', 'alamat', 'telepon', 'created_by', 'edited_by', 'created_at', 'updated_at')
            ->get();

        $formattedPemilik = $pemilik->map(function ($pemilik) {
            return [
                'id' => $pemilik->id,
                'nama' => $pemilik->nama,
                'alamat' => $pemilik->alamat,
                'telepon' => $pemilik->telepon,
                'created_by' => optional($pemilik->createdBy)->email,
                'edited_by' => optional($pemilik->editedBy)->email,
                'created_at' => $pemilik->created_at,
                'updated_at' => $pemilik->updated_at,
            ];
        });

        return Inertia::render('Pemilik/index', ['pemilik' => $formattedPemilik]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Pemilik/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $data['created_by'] = Auth::id();

        Pemilik::create($data);

        return redirect()->route('pemilik.index')->with('success', 'Pemilik berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $pemilik = Pemilik::findOrFail($id);
        $formattedPemilik = [
            'id' => $pemilik->id,
            'nama' => $pemilik->nama,
            'alamat' => $pemilik->alamat,
            'telepon' => $pemilik->telepon
        ];

        return Inertia::render('Pemilik/edit', ['pemilik' => $formattedPemilik]);
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
    public function update(Request $request, $id): RedirectResponse
    {
        $pemilik = Pemilik::findOrFail($id);
        $data = $request->all();
        $data['edited_by'] = Auth::id();
        $data['edited_at'] = Carbon::now();
        $pemilik->update($data);
        return redirect()->route('pemilik.index')->with('success', 'Pemilik berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $pemilik = Pemilik::find($id);
        $pemilik->delete();
        return redirect()->route('pemilik.index')->with('success', 'Pemilik berhasil dihapus');
    }
}
