<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    protected $table = 'tabelbuku';

    protected $fillable = [
      'Title',
      'Kategori',
      'Author',
      'Year',
      'Stock',
      'Status'
    ];
}
