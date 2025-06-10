<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'name',
        'description',
        'image',
        'created_by',
        'modified_by',
    ];

    // Relasi ke admin pembuat
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    // Relasi ke admin pengubah
    public function modifiedBy()
    {
        return $this->belongsTo(Admin::class, 'modified_by');
    }
}
