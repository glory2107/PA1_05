<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KataSambutan extends Model
{
    use HasFactory;

    protected $table = 'kata_sambutan';  // Nama tabel yang sesuai dengan migration

    protected $fillable = [
        'title',
        'image',
        'description',
        'created_by',
        'modified_by',
    ];

    // Relasi dengan tabel admin untuk created_by
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    // Relasi dengan tabel admi
    // n untuk modified_by
    public function modifiedBy()
    {
        return $this->belongsTo(Admin::class, 'modified_by');
    }
}
