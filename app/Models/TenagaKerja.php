<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenagaKerja extends Model {
    use HasFactory;

    protected $table = 'tenaga_kerja';
    protected $fillable = ['name', 'jabatan', 'image', 'created_by', 'modified_by'];

    public function createdBy() {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function modifiedBy() {
        return $this->belongsTo(Admin::class, 'modified_by');
    }
}