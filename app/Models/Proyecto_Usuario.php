<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto_Usuario extends Model
{
    use HasFactory;

    protected $fillable =[
        'proyecto_id',
        'users_id',
    ];
}
