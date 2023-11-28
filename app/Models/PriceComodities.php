<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceComodities extends Model
{
    use HasFactory;

    protected $table = 'daftar_harga';

    protected $fillable = [
        'id',
        'tanggal',
        'pasar_id',
        'komoditas_id',
        'harga_current'
    ];

    public function pasar()
    {
        return $this->belongsTo(Market::class, 'nm_pasar', 'nama_pasar');
    }
}
