<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'image',
    ];

    protected $dates = ['deleted_at'];

    public function setting()
    {
        return $this->belongsTo(Setting::class, 'settings_id');
    }
}
