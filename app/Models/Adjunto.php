<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{
    use HasFactory;
    protected $fillable = [
        'docs',
        'estado',
        'fk_idSolicitudes',
    ];
    protected $table = 'adjuntos';
}
