<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceComodities extends Model
{
    use HasFactory;

    protected $table = 'harga_komoditas';

    protected $fillable = [
        'id',
        'tanggal',
        'nm_pasar',
        'nm_komoditas',
        'id_komuditas',
        'harga_current'
    ];

    public function pasar()
    {
        return $this->belongsTo(Market::class, 'nm_pasar', 'nama_pasar');
    }
}
