<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactoController extends Controller
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
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacto $contacto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->fill($request->post())->save();
        return response()->json([
            'encuesta'=> $contacto
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {
        //
    }

    public function importCSVContactos(Request $request)
    {
        try{
            //Rescata el archivo y lo pasa a array
            $file = $request['file'];
            $customerArr = $this->csvToArray($file);     
            $id_proyecto = $request['id_proyecto'];
            //Carga los datos a la base de datos
             for ($i = 0; $i < count($customerArr); $i ++){
                 $contacto = Contacto::create([
                    'codigo' => $id_proyecto,
                     'rut' => $customerArr[$i]['rut'],
                     'tipo' => $customerArr[$i]['tipo'],
                     'programa' => $customerArr[$i]['programa'],
                     'nombre' => $customerArr[$i]['nombre'],
                     'sexo' => $customerArr[$i]['sexo'],
                     'pais' => $customerArr[$i]['pais'],
                     'telefono1' => $customerArr[$i]['telefono1'],
                     'telefono2' => $customerArr[$i]['telefono2'],
                     'telefono3' => $customerArr[$i]['telefono3'],
                     'telefono4' => $customerArr[$i]['telefono4'],
                     'telefono5' => $customerArr[$i]['telefono5'],
                     'estado' => 'Activo'

                 ]);}
                return response()->json(['success' => $id_proyecto]);
            }
        catch (\Exception $e) {
                $customerArr = $e->getMessage();
                
                return response()->json([
                    $customerArr, 'Error! Comprobar Archivo.'
                ]);
            }
            
        
        }
    

    
    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;
        $header = null;
        $data = array();
        $this->replaceDelimiters($filename);
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                $row = array_map("utf8_encode", $row);
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
    
        //Funciones para importar la información de los archivos CSV
    public function replaceDelimiters($file)
    {
        // Delimiters to be replaced: pipe, semicolon, caret, tabs
        $delimiters = array('|', ';', '^', "\t");
        $delimiter = ',';
        $str = file_get_contents($file);
        $str = str_replace($delimiters, $delimiter, $str);
        file_put_contents($file, $str);
    }

    public function obtenerContacto ($id)
    {
        $sql = "SELECT * FROM contactos
            ORDER BY RAND()
            LIMIT 1";

        $result = DB::select(DB::raw($sql ));
        return $result ;
    }





}
