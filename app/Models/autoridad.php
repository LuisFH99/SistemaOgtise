<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class autoridad extends Model
{
    use HasFactory;
    protected $table = 'autoridades';
    protected $fillable = [
        'fk_idDocentes',
        'fk_idCargos',
    ];
}
