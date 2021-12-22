<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetAdjunto extends Model
{
    use HasFactory;
    protected $fillable = [
        'estado',
        'fk_idAdjuntos',
        'fk_idSolicitudes',
    ];
}
