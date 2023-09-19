<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $guarded = ['id'];
    protected $dates = ['expired_date']; // Tambahkan kolom tanggal ke model

    public function incrementUsage($incrementBy = 1)
    {
        $this->usage += $incrementBy;
        return $this->save();
    }
}
