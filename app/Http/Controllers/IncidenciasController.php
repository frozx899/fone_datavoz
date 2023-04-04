<?php

namespace App\Http\Controllers;

use App\Models\Incidencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncidenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $incidencia = Incidencias::create($request->post());
        return response()->json([
            'respuesta' => 'Se ha registrado la incidencia'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidencias  $incidencias
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencias $incidencias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incidencias  $incidencias
     * @return \Illuminate\Http\Response
     */
    public function edit(Incidencias $incidencias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidencias  $incidencias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidencias $incidencias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidencias  $incidencias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidencias $incidencias)
    {
        //
    }

    public function incidenciaContacto($id)
    {
        $sql ="SELECT i.telefono as telefono,ni.nombre as nombre,i.created_at as fecha FROM incidencias i
                join nombre_incidencia ni
                on(i.incidencia = ni.id)
                WHERE i.idcontacto = $id;";
        $incidencia = DB::select(DB::raw($sql));

        return response()->json($incidencia);
    }
}
