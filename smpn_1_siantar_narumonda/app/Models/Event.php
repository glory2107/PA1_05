<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    use HasFactory;

    protected $table = 'event';
    protected $fillable = ['name', 'description', 'image', 'tanggal', 'created_by', 'modified_by'];

    public function createdBy() {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function modifiedBy() {
        return $this->belongsTo(Admin::class, 'modified_by');
    }
}
