<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'logo',
        'title',
        'desc',
        'underconstruction',
        'is_backup_recovery',
        'confirmation_url'
    ];
}
