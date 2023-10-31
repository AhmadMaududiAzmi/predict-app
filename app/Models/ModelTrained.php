<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTrained extends Model
{
    use HasFactory;

    protected $table = 'model_trained';

    protected $fillable = [
        'id',
        'model',
        'keterangan'
    ];
}
