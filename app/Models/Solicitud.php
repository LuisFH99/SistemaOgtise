<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class Solicitud extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'fech_solicitud',
        'hor_solicitud',
        'fech_inicio',
        'fech_fin',
        'fech_retorno',
        'justificacion',
        'num_dias',
        'reemplazo',
        'firm_reemplazo',
        'url_doc',
        'observacion',
        'codigo',
        'estado',
        'fk_idFirmas',
        'fk_idMotivoSolicitudes',
        'fk_idEstadoSolicitudes',
        'fk_idDocentes'
    ];

    protected $table = 'solicitudes';
}
