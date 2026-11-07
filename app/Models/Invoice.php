<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function biller()
    {
        return $this->belongsTo(Biller::class);
    }

    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }
}