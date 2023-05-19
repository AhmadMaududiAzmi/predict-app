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
        'nama_pasar',
        'kota_kabupaten',
        'id_pasar',
        'keterangan'
    ];
}
