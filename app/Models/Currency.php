<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code'];

    public function rates() : HasMany
    {
        return $this->hasMany(CurrencyRate::class);
    }
}
