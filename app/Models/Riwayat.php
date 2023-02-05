<?php

namespace App\Models;

use App\Models\Kendaraan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Riwayat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class);
    }
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
