<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setting;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $guarded = ['id'];
    protected $dates = ['expired_date']; // Tambahkan kolom tanggal ke model

    public function setting()
    {
        return $this->belongsTo(Setting::class, 'settings_id');
    }
}
