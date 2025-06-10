<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'galeri';

    // Kolom yang dapat diisi
    protected $fillable = [
        'title',
        'description',
        'image',        // untuk cover
        'images',       // untuk banyak gambar (disimpan dalam format JSON)
        'tanggal',
        'created_by',
        'modified_by',
    ];

    // Konversi otomatis kolom 'images' ke array saat diakses
    protected $casts = [
        'images' => 'array',
    ];

    // Relasi ke Admin yang membuat galeri
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    // Relasi ke Admin yang mengedit galeri
    public function modifiedBy()
    {
        return $this->belongsTo(Admin::class, 'modified_by');
    }
}
