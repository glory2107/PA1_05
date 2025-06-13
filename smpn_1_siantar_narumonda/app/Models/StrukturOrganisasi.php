<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'struktur_organisasi';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = ['image', 'created_by', 'modified_by'];

    // Relasi dengan Admin untuk created_by
    public function createdBy() {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    // Relasi dengan Admin untuk modified_by
    public function modifiedBy() {
        return $this->belongsTo(Admin::class, 'modified_by');
    }
}
