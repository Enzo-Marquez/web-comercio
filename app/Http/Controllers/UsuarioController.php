<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Arr;


class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = User::paginate(5);
        return view('usuarios.index', compact('usuarios'));
    }


   

    public function edit($id)
    {
        $user = User::find($id);
        

        return view('usuarios.editar', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'apellido' => 'required',
            'dni' => 'required',
           
            'email' => 'required|email|unique:users,email,' . $id,
           
            
        ]);

        $input = $request->all();

        $user = User::find($id);
        $user->update($input);
        
        return redirect()->route('usuarios.index');
    }


    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index');
    }
}
