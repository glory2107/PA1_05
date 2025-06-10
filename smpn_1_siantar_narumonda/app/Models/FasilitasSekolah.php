<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasSekolah extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang akan digunakan
    protected $table = 'fasilitas_sekolah';

    // Menentukan kolom yang dapat diisi mass-assignment
    protected $fillable = [
        'title',
        'description',
        'image',
        'created_by',
        'modified_by',
    ];

    // Menentukan relasi antara FasilitasSekolah dan Admin (Created By)
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    // Menentukan relasi antara FasilitasSekolah dan Admin (Modified By)
    public function modifiedBy()
    {
        return $this->belongsTo(Admin::class, 'modified_by');
    }
}
