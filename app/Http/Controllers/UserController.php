<?php

namespace App\Http\Controllers;

use App\User;
use http\Env\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAll()
    {
        return response()->json(User::all());
    }

    public function set(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'cedula' => 'required|unique:users,cedula',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'required|unique:users,telefono',
        ]);

        try{
            User::create($request->all());
            return response()->json(['status' => true]);
        }catch (\Exception $e){
            return response()->json('Ha ocurrido un error al intentar crear el usuario '.$e->getMessage(),500);
        }
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'cedula' => 'required|unique:users,cedula,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'telefono' => 'required|unique:users,telefono,'.$id,
        ]);

        try{
            User::find($id)->update($request->all());
            return response()->json(['status' => true]);
        }catch (\Exception $e){
            return response()->json('Ha ocurrido un error al intentar crear el usuario '.$e->getMessage(),500);
        }
    }

    public function get($id)
    {
        $user = User::find($id);
        return $user ? response()->json($user) : null;
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user)
            return response()->json('Usuario no encontrado',404);

        $user->delete();

        return response()->json('Usuario eliminado');
    }
}
