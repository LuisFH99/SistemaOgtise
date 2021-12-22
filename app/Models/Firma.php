<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    use HasFactory;
    protected $fillable = [
        'firma', 
        'token', 
        'estado', 
        'fk_idTipFirmas',
    ];
}
