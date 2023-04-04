<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){

        $user = User::all();
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = User::create($request->post());

        return response()->json([
            'respuesta' => $user
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request['name'];
        $user->password = $request['password'];
        $user->type = $request['type'];
        $user->save();
        
        return response()->json([
            'respuesta' => 'Se ha creado correctamente'
        ]);

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // delete the user
        $user->delete();
        return response()->json([
            'respuesta' => 'Se ha eliminado correctamente'
        ]);
    }

    public function buscarusuario($id)
    {
        $user = DB::table('users')
        ->where('username', $id)
        ->get();

        return response()->json($user);
    }

    public function userEdit(Request $request)
    {
        $id = $request['id'];
        $user = User::find($id);

        $user->name = $request['name'];
        $user->password = $request['password'];
        $user->type = $request['type'];
        $user->save();
        
        return response()->json([
            'respuesta' => 'Se ha creado correctamente'
        ]);
    }

    public function usuariosactivos($id)
    {
        $sql="SELECT * FROM users 
        WHERE username NOT in (SELECT users_id from proyecto__usuarios WHERE proyecto_id = $id);";
        $usuarios = DB::select(DB::raw($sql));
        

        return response()->json($usuarios);
    }


}
