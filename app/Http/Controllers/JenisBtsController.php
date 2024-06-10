<?php

namespace App\Http\Controllers;

use App\Models\JenisBTS;
use App\Http\Requests\Storejenis_btsRequest;
use App\Http\Requests\Updatejenis_btsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class JenisBtsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $jenisBts = JenisBTS::with(['createdBy', 'editedBy'])
            ->select('id', 'nama', 'created_by', 'edited_by', 'created_at', 'updated_at')
            ->get();

        $formattedJenisBts = $jenisBts->map(function ($jenisBts) {
            return [
                'id' => $jenisBts->id,
                'nama' => $jenisBts->nama,
                'created_by' => optional($jenisBts->createdBy)->email,
                'edited_by' => optional($jenisBts->editedBy)->email,
                'created_at' => $jenisBts->created_at,
                'updated_at' => $jenisBts->updated_at,
            ];
        });

        return Inertia::render('JenisBTS/index', ['jenisBts' => $formattedJenisBts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('JenisBTS/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $data['created_by'] = Auth::id();

        JenisBTS::create($data);

        return redirect()->route('jenis-bts.index')->with('success', 'Jenis BTS berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $jenis_bts = JenisBTS::findOrFail($id);
        $formattedJenisBts = [
            'id' => $jenis_bts->id,
            'nama' => $jenis_bts->nama,
        ];

        return Inertia::render('JenisBTS/edit', ['jenisBts' => $formattedJenisBts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $jenis_bts = JenisBTS::findOrFail($id);
        $data = $request->all();
        $data['edited_by'] = Auth::id();
        $data['edited_at'] = Carbon::now();
        $jenis_bts->update($data);
        return redirect()->route('jenis-bts.index')->with('success', 'Jenis BTS berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $jenisBts = JenisBTS::find($id);
        $jenisBts->delete();
        return redirect()->route('jenis-bts.index')->with('success', 'Jenis BTS berhasil dihapus');
    }
}
