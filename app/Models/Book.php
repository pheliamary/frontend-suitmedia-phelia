<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'tahun_terbit',
        'kategori',
        'stok',
        'penerbit',
        'cover'
    ];

    protected $casts = [
        'tahun_terbit' => 'integer',
        'stok' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the cover URL attribute
     */
    public function getCoverUrlAttribute()
    {
        if ($this->cover) {
            return asset('storage/covers/' . $this->cover);
        }
        return asset('images/default-cover.jpg');
    }

    /**
     * Get formatted created date
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d F Y H:i');
    }

    /**
     * Get formatted updated date
     */
    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at->format('d F Y H:i');
    }

    /**
     * Check if book is available
     */
    public function isAvailable()
    {
        return $this->stok > 0;
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return $this->stok > 0 ? 'status-available' : 'status-borrowed';
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        return $this->stok > 0 ? 'Tersedia' : 'Habis';
    }

    /**
     * Scope for available books
     */
    public function scopeAvailable($query)
    {
        return $query->where('stok', '>', 0);
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('judul', 'LIKE', "%{$term}%")
              ->orWhere('penulis', 'LIKE', "%{$term}%")
              ->orWhere('kategori', 'LIKE', "%{$term}%")
              ->orWhere('penerbit', 'LIKE', "%{$term}%");
        });
    }
}