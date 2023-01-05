<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyecto = Proyecto::all();
        return response()->json($proyecto);
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
        $proyecto = Proyecto::create($request->post());
        return response()->json([
            'respuesta' => $proyecto
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function editEstado(Request $request)
    {       
        $id = $request['id'];
        $estado = $request['estado'];
        
        $proyecto = Proyecto::find($id);
        $proyecto->estado = $estado;
        $proyecto->save();

        return response()->json([
            'respuesta' => 'Se ha creado correctamente'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto)
    {
        //
    }

    public function codigoUsado($id)
    {
        $proyecto = DB::table('proyectos')
        ->where('codigo' , $id)
        ->get();
        
        if(($proyecto->count()) == 0 ){
            return response()->json(1);
        }
        else{
            return response()->json(2);
        }
        
    }

    public function proyectoActivos()
    {
        $proyecto = DB::table('proyectos')
        ->where('estado', 'Abierto')
        ->get();

        return response()->json($proyecto);
    }


}
