<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function Currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
}
