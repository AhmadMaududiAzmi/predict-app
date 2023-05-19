<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListComodities extends Model
{
    use HasFactory;

    protected $table = 'daftar_komoditas';

    protected $fillable = [
        'id',
        'kategori',
        'nama_komoditas',
        'satuan'
    ];
}
