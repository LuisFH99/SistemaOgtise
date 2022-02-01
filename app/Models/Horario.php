<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = 'horario';
    protected $fillable = [
        'ini_entrada',
        'fin_entrada',
        'ini_salida',
        'fin_salida',
    ];
    public $timestamps = false;
}
