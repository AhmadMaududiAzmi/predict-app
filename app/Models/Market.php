<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;

    protected $table = 'daftar_pasar';

    protected $fillable = [
        'id',
        'nm_pasar',
        'kota_kab'
    ];

    public function hargaKomoditas()
    {
        return $this->hasMany(PriceComodities::class. 'nm_pasar', 'nama_pasar');
    }
}
