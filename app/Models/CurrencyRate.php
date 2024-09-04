<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurrencyRate extends Model
{
    use HasFactory;
    protected $fillable = ['rate', 'currency_id'];
    
    public function currency() : BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}