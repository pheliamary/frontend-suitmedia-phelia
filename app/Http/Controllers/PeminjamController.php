<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $peminjam = Peminjam::all();
        return view('peminjam', ['peminjam' => $peminjam]);
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'kode_peminjam' => 'required|unique:peminjams',
            'nama_peminjam' => 'required',
            'judul_buku' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        
        // Set default status
        $validated['status'] = 'pinjam';
        
        Peminjam::create($validated);

        return redirect()->route('peminjam.index')->with('success', 'Data peminjam berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(peminjam $peminjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(peminjam $peminjam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_peminjam' => 'required|unique:peminjams,kode_peminjam,'.$id,
            'nama_peminjam' => 'required',
            'judul_buku' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        $peminjam = Peminjam::findOrFail($id);
        $peminjam->update($validated);

        return response()->json(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->delete();

        return response()->json(['success' => 'Data berhasil dihapus']);
    }

    
}