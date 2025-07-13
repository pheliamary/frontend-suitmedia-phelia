<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjam; // Dari 'peminjam' ke 'Peminjam' (PascalCase)

class peminjam extends Model
{
     protected $table = 'peminjams'; // nama tabel di database

    protected $fillable = [
        'kode_peminjam',
        'nama_peminjam',
        'judul_buku',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status'
    ];
}