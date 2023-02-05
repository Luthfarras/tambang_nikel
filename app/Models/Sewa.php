<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function riwayat()
    {
        return $this->hasMany(Riwayat::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
