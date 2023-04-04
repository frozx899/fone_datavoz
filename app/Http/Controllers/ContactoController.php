<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                $estado1 = 0;
                $estado2 = 0;
                $estado3 = 0;
                $estado4 = 0;
                $estado5 = 0;
                $estadoEnc = 0;
                if($customerArr[$i]['telefono1'] != '')
                    {
                        $estado1 = 1;
                    }
                if($customerArr[$i]['telefono2'] != '')
                {
                    $estado2 = 1;
                }
                if($customerArr[$i]['telefono3'] != '')
                {
                    $estado3 = 1;
                }
                if($customerArr[$i]['telefono4'] != '')
                {
                    $estado4 = 1;
                }
                if($customerArr[$i]['telefono5'] != '')
                {
                    $estado5 = 1;
                }

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
                     'estado' => 'Activo',
                     'estadotelefono1' => $estado1,
                     'estadotelefono2' => $estado2,
                     'estadotelefono3' => $estado3,
                     'estadotelefono4' => $estado4,
                     'estadotelefono5' => $estado5,
                     'link' => $customerArr[$i]['link'],
                     'estado_encuesta' => $estadoEnc
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
        WHERE (EXTRACT(DAY FROM updated_at) = day(NOW()) and hour(TIME(updated_at))-3 <= hour(NOW())-3 and codigo = '$id') or (EXTRACT(DAY FROM updated_at) < day(NOW()) and codigo = '$id')
        ORDER BY RAND()
        LIMIT 1;";

        $result = DB::select(DB::raw($sql ));
        return $result ;
    }

    public function incidenciaContacto1(Request $request)
    {
        $id = $request['id'];
        $incidencia = $request['incidencia1'];
        $estado = $request['estadotelefono1'];
        $estadoContacto = $request['estado'];
        $current = new Carbon();

        $contacto = Contacto::find($id);
        $contacto->incidencia1 = $incidencia;
        $contacto->estadotelefono1 = $estado;
        $contacto->estado = $estadoContacto;
        $contacto->ultimo_contacto =$current;
        $contacto->save();

        return response()->json([
            'respuesta' => 'Incidencia guardada correctamente'
        ]);
    }

    public function incidenciaContacto2(Request $request)
    {
        $id = $request['id'];
        $incidencia = $request['incidencia2'];
        $estado = $request['estadotelefono2'];
        $estadoContacto = $request['estado'];
        $current = new Carbon();

        $contacto = Contacto::find($id);
        $contacto->incidencia2 = $incidencia;
        $contacto->estadotelefono2 = $estado;
        $contacto->estado = $estadoContacto;
        $contacto->ultimo_contacto =$current;
        $contacto->save();

        return response()->json([
            'respuesta' => 'Incidencia guardada correctamente'
        ]);
    }

    public function incidenciaContacto3(Request $request)
    {
        $id = $request['id'];
        $incidencia = $request['incidencia3'];
        $estado = $request['estadotelefono3'];
        $estadoContacto = $request['estado'];
        $current = new Carbon();

        $contacto = Contacto::find($id);
        $contacto->incidencia3 = $incidencia;
        $contacto->estadotelefono3 = $estado;
        $contacto->estado = $estadoContacto;
        $contacto->ultimo_contacto =$current;
        $contacto->save();

        return response()->json([
            'respuesta' => 'Incidencia guardada correctamente'
        ]);
    }

    public function incidenciaContacto4(Request $request)
    {
        $id = $request['id'];
        $incidencia = $request['incidencia4'];
        $estado = $request['estadotelefono4'];
        $estadoContacto = $request['estado'];
        $current = new Carbon();

        $contacto = Contacto::find($id);
        $contacto->incidencia4 = $incidencia;
        $contacto->estadotelefono4 = $estado;
        $contacto->estado = $estadoContacto;
        $contacto->ultimo_contacto =$current;
        $contacto->save();

        return response()->json([
            'respuesta' => 'Incidencia guardada correctamente'
        ]);
    }

    public function incidenciaContacto5(Request $request)
    {
        $id = $request['id'];
        $incidencia = $request['incidencia5'];
        $estado = $request['estadotelefono5'];
        $estadoContacto = $request['estado'];
        $current = new Carbon();

        $contacto = Contacto::find($id);
        $contacto->incidencia5 = $incidencia;
        $contacto->estadotelefono5 = $estado;
        $contacto->estado = $estadoContacto;
        $contacto->ultimo_contacto =$current;
        $contacto->save();

        return response()->json([
            'respuesta' => 'Incidencia guardada correctamente'
        ]);
    }

    public function inicioEncuesta(Request $request)
    {
        $id = $request['id'];
        $inicio = $request['estado_encuesta'];

        $contacto = Contacto::find($id);
        $contacto->estado_encuesta = $inicio;
        $contacto->save();

        return response()->json([
            'respuesta' => 'Incidencia guardada correctamente'
        ]);
    }

    public function finEncuesta(Request $request)
    {
        $id = $request['id'];
        $estado = $request['estado'];
        $current = new Carbon();

        $contacto = Contacto::find($id);
        $contacto->estado = $estado;
        $contacto->ultimo_contacto =$current;
        $contacto->save();

        return response()->json([
            'respuesta' => 'Incidencia guardada correctamente'
        ]);
    }



}
