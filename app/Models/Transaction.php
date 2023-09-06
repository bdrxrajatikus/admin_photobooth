<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_date',
        'phone_number',
        'price',
        'promo_code_id',
        'final_price',
        'status',
    ];

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }
}
