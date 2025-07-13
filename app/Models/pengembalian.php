<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengembalian; // Dari 'pengembalian' ke 'Pengembalian' (PascalCase)


class pengembalian extends Model
{
    protected $table = 'pengembalians'; // nama tabel di database
    protected $fillable = [
        'kode_pengembalian',
        'nama_pengembalian',
        'judul_buku',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status'
    ];
}