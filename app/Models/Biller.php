<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biller extends Model
{
    // Mengizinkan semua kolom diisi secara otomatis
    protected $guarded = []; 

    // Relasi 1 Biller punya banyak Catat Meter
    public function catatMeters()
    {
        return $this->hasMany(CatatMeter::class);
    }

    // Relasi 1 Biller punya banyak Koreksi
    public function koreksiRekenings()
    {
        return $this->hasMany(KoreksiRekening::class);
    }

    // Relasi 1 Biller punya banyak Invoice
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}