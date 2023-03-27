<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable =[
        'codigo',
        'rut',
        'tipo',
        'programa',
        'nombre',
        'sexo',
        'pais',
        'telefono1',
        'telefono2',
        'telefono3',
        'telefono4',
        'telefono5',
        'incidencia1',
        'incidencia2',
        'incidencia3',
        'incidencia4',
        'incidencia5',
        'estado',
        'ultimo_contacto',
    ];


    
}
