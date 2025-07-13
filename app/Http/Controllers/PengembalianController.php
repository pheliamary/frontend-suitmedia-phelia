<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
    
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengembalian = pengembalian::all();
        return view('ideas', ['pengembalian' => $pengembalian]);
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
          'kode_pengembalian' => 'required|unique:pengembalians,kode_pengembalian',
    'nama_pengembalian' => 'required',
    'judul_buku' => 'required',
    'tanggal_pinjam' => 'required|date',
    'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);
        $validated ['status'] = 'tepatwaktu';

        Pengembalian::create($validated);

        return redirect()->route('ideas.index')->with('success', 'Data pengembalian berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(pengembalian $pengembalian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengembalian $pengembalian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Pengembalian $kembali)
{
    $validated = $request->validate([
        'kode_pengembalian' => [
            'required',
            Rule::unique('pengembalians', 'kode_pengembalian')->ignore($kembali->id),
        ],
        'nama_pengembalian' => 'required',
        'judul_buku' => 'required',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        'status' => 'required|in:tepatwaktu,terlambat',
    ]);

    $kembali->update($validated);

    return response()->json(['success' => 'Data berhasil diperbarui.']);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $pengembalian = Pengembalian::findOrFail($id);
    $pengembalian->delete();

    return response()->json(['success' => 'Data berhasil dihapus']);
}

}