<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KoreksiRekening extends Model
{
    protected $guarded = [];

    public function biller()
    {
        return $this->belongsTo(Biller::class);
    }
}