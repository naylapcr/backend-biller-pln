<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatMeter extends Model
{
    protected $guarded = [];

    // Relasi balik ke tabel Biller
    public function biller()
    {
        return $this->belongsTo(Biller::class);
    }
}