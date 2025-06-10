<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model {
    use HasFactory;

    protected $table = 'kontak';
    protected $fillable = ['icon', 'status', 'value', 'created_by', 'modified_by'];

    public function createdBy() {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function modifiedBy() {
        return $this->belongsTo(Admin::class, 'modified_by');
    }
}
