<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahSekolah extends Model
{
    use HasFactory;

    // Nama tabel yang sesuai dengan migration
    protected $table = 'sejarah_sekolah';

    // Kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = [
        'title',
        'image',
        'description',
        'created_by',
        'modified_by',
    ];

    // Relasi dengan admin untuk created_by
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    // Relasi dengan admin untuk modified_by
    public function modifiedBy()
    {
        return $this->belongsTo(Admin::class, 'modified_by');
    }
}
