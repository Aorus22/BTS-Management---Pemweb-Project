<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenggunaRequest;
use App\Models\BTS;
use App\Models\Pengguna;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $pengguna = Pengguna::with(['createdBy', 'editedBy'])
            ->select('id', 'nama', 'alamat', 'telepon', 'created_by', 'edited_by', 'created_at', 'updated_at')
            ->get();

        $formattedPemilik = $pengguna->map(function ($pengguna) {
            return [
                'id' => $pengguna->id,
                'nama' => $pengguna->nama,
                'alamat' => $pengguna->alamat,
                'telepon' => $pengguna->telepon,
                'created_by' => optional($pengguna->createdBy)->email,
                'edited_by' => optional($pengguna->editedBy)->email,
                'created_at' => $pengguna->created_at,
                'updated_at' => $pengguna->updated_at,
            ];
        });

        return Inertia::render('Pengguna/index', ['pengguna' => $formattedPemilik]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $bts = BTS::select('id', 'nama')->get();
        return Inertia::render('Pengguna/create', ['bts' => $bts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PenggunaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        Pengguna::create($data);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $pengguna = Pengguna::findOrFail($id);
        $bts = BTS::select('id', 'nama')->get();
        $formattedPemilik = [
            'id' => $pengguna->id,
            'nama' => $pengguna->nama,
            'alamat' => $pengguna->alamat,
            'telepon' => $pengguna->telepon
        ];

        return Inertia::render('Pengguna/edit', ['pengguna' => $formattedPemilik, 'bts' => $bts]);
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
    public function update(PenggunaRequest $request, $id): RedirectResponse
    {
        $pengguna = Pengguna::findOrFail($id);
        $data = $request->validated();
        $data['edited_by'] = Auth::id();
        $data['edited_at'] = Carbon::now();
        $pengguna->update($data);
        return redirect()->route('pengguna.index')->with('success', 'Pemilik berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $pengguna = Pengguna::find($id);
        $pengguna->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pemilik berhasil dihapus');
    }
}

