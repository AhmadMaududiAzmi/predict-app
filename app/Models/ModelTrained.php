<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTrained extends Model
{
    use HasFactory;

    protected $table = 'daftar_model';

    protected $fillable = [
        'id',
        'komoditas_id',
        'pasar_id',
        'tanggal_awal',
        'tanggal_akhir',
        'model'
    ];
}
