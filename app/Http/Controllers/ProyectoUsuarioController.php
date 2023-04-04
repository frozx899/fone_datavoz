<?php

namespace App\Http\Controllers;

use App\Models\Proyecto_Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProyectoUsuarioController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proyecto_Usuario  $proyecto_Usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto_Usuario $proyecto_Usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proyecto_Usuario  $proyecto_Usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyecto_Usuario $proyecto_Usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proyecto_Usuario  $proyecto_Usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto_Usuario $proyecto_Usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proyecto_Usuario  $proyecto_Usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto_Usuario $proyecto_Usuario)
    {
        //
    }

    public function cargarusuarios(Request $request)
    {

        $proyecto_usuario = Proyecto_Usuario::create($request->post());
        
        return response()->json([
            'respuesta' => 'Se ha creado correctamente'
        ]);
    }
    
    public function proyectoUsuarios($id)
    {
        $user = $id;

        $sql = "SELECT p.nombre,pu.users_id , p.estado , p.codigo
            FROM proyecto__usuarios pu 
            JOIN proyectos p
            ON(p.id = pu.proyecto_id)
            WHERE pu.users_id = '$user' and p.estado= 'Abierto'
            GROUP BY p.nombre,pu.users_id, p.estado,p.codigo; ";
        $results = DB::select(DB::raw($sql));
        return $results;

    }
}
