<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sewa()
    {
        return $this->hasMany(Sewa::class);
    }
    public function riwayat()
    {
        return $this->hasMany(Riwayat::class);
    }
}
