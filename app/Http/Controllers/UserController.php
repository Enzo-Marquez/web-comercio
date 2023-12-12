<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    // index para mostrar todos los turnos
    // store para guardar un turno
    // update para actualizar un turno
    // destroy para eliminar un turno
    // show para mostrar un turno
    // edit para mostrar el formulario de edicion


    public function store(Request $request){

        $request->validate([
            'usu_dni' => 'required|min:5',
            'usu_nom' => 'required',
            'usu_ape' => 'required',
            'usu_contra' => 'required',
            'email' => 'required',
        ]);

        $user = new user;
        $user->usu_dni= $request->usu_dni;
        $user->usu_nom = $request->usu_nom;
        $user->usu_ape = $request->usu_ape;
        $user->usu_contra = $request->usu_contra;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('users')->with('success', 'Usuario Registrado Correctamente');
    }
    public function index(){
        $users = user::all();
        return view('users.index', ['users' => $users]);
    }

    public function show($id){
        $user = user::find($id);
        return view('users.show', ['user' => $user]);
    }

    public function update(Request $request, $id){
        $user = user::find($id);
        $user->usu_dni= $request->usu_dni;
        $user->usu_nom = $request->usu_nom;
        $user->usu_ape = $request->usu_ape;
        $user->usu_contra = $request->usu_contra;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('users')->with('success', 'Usuario Actualizado!');
    }

    public function destroy($id){
        $user = user::find($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'Usuario Eliminado!');
    }
}