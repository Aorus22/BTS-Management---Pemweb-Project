<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use App\Models\PenggunaRouter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class PenggunaRouterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $pengguna_router = PenggunaRouter::with(['createdBy', 'editedBy'])
            ->select('id', 'nama', 'alamat', 'telepon', 'created_by', 'edited_by', 'created_at', 'updated_at')
            ->get();

        $formattedPemilik = $pengguna_router->map(function ($pengguna_router) {
            return [
                'id' => $pengguna_router->id,
                'nama' => $pengguna_router->nama,
                'alamat' => $pengguna_router->alamat,
                'telepon' => $pengguna_router->telepon,
                'created_by' => optional($pengguna_router->createdBy)->email,
                'edited_by' => optional($pengguna_router->editedBy)->email,
                'created_at' => $pengguna_router->created_at,
                'updated_at' => $pengguna_router->updated_at,
            ];
        });

        return Inertia::render('PenggunaRouter/index', ['pengguna_router' => $formattedPemilik]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('PenggunaRouter/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $data['created_by'] = Auth::id();

        PenggunaRouter::create($data);

        return redirect()->route('pengguna-router.index')->with('success', 'Pengguna Router berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $pengguna_router = PenggunaRouter::findOrFail($id);
        $formattedPemilik = [
            'id' => $pengguna_router->id,
            'nama' => $pengguna_router->nama,
            'alamat' => $pengguna_router->alamat,
            'telepon' => $pengguna_router->telepon
        ];

        return Inertia::render('PenggunaRouter/edit', ['pengguna_router' => $formattedPemilik]);
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
        $pengguna_router = PenggunaRouter::findOrFail($id);
        $data = $request->all();
        $data['edited_by'] = Auth::id();
        $data['edited_at'] = Carbon::now();
        $pengguna_router->update($data);
        return redirect()->route('pengguna-router.index')->with('success', 'Pemilik berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $pengguna_router = PenggunaRouter::find($id);
        $pengguna_router->delete();
        return redirect()->route('pengguna-router.index')->with('success', 'Pemilik berhasil dihapus');
    }
}

