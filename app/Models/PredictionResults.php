<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredictionResults extends Model
{
    use HasFactory;

    protected $table = 'hasil_prediksi';

    protected $fillable = [
        'id',
        'tanggal_awal',
        'tanggal_akhir',
        'id_komoditas',
        'id_pasar',
        'id_model',
        'data_json'
    ];
}
