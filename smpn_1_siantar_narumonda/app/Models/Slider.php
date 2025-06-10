<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'image',
        'created_by',
        'modified_by',
    ];

    // Casting kolom 'image' dari JSON ke array otomatis
    protected $casts = [
        'image' => 'array',
    ];

    // Relasi ke Admin yang membuat slider
    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    // Relasi ke Admin yang terakhir mengubah slider
    public function modifier()
    {
        return $this->belongsTo(Admin::class, 'modified_by');
    }
}
