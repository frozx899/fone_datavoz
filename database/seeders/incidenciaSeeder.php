<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class incidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'1',
                'nombre' => 'Encuesta Parcial',
            ],
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'2',
                'nombre' => 'Interrupcion',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'3',
                'nombre' => 'Encuestado nunca disponible',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'4',
                'nombre' => 'Mala calidad de audio de la llamada',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'5',
                'nombre' => 'Ubicación/ actividad que no permite realizar una entrevista',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'6',
                'nombre' => 'Teléfono fuera de servicio',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'7',
                'nombre' => 'No contactado/Ocupado',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'8',
                'nombre' => 'Teléfono siempre ocupado',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'9',
                'nombre' => 'Contestador telefónico',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'10',
                'nombre' => 'Rechazo del entrevistado',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'11',
                'nombre' => 'Muerte',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'12',
                'nombre' => 'Incapacidad física y / o mental del entrevistado',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'13',
                'nombre' => 'Barrera de idioma',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'14',
                'nombre' => 'Otros casos de no disponibilidad',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'15',
                'nombre' => 'Empresa u oficina',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'16',
                'nombre' => 'Institucion o unidad residencial',
            ]
        );
        DB::table('nombre_incidencia')->insert(
            [
                'id' =>'17',
                'nombre' => 'Persona no perteneciente al hogar',
            ]
        );
    }
}
