<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserType;
use Illuminate\Support\Facades\Auth;



use Illuminate\Support\Arr;


class UsuarioController extends Controller
{



    public function index(Request $request)
    {
        // Obtener el usuario autenticado
        $usuarioAutenticado = Auth::user();
    
        // Inicializar la variable para almacenar los usuarios
        $usuarios = null;
    
        // Verificar si el usuario es un admin
        if ($usuarioAutenticado->user_type === 'admin') {
            // Si es un admin, obtener todos los usuarios
            $usuarios = User::orderBy('name', 'asc');
        } else {
            // Si no es un admin, obtener solo su propio usuario
            $usuarios = User::where('id', $usuarioAutenticado->id);
        }
    
        $search = $request->input('search');
    
        // Aplicar filtro solo si se proporciona un término de búsqueda
        if ($search) {
            $usuarios = $usuarios->where('name', 'LIKE', "%$search%");
        }
    
        // Obtener los resultados finales
        $usuarios = $usuarios->paginate(10);
    
        return view('usuarios.index', ['usuarios' => $usuarios, 'usuarioAutenticado' => $usuarioAutenticado, 'search' => $search]);

    }
    


public function store(Request $request)
{

}



   

public function edit($id)
{
    // Obtener el usuario que se va a editar
    $usuarioEditar = User::find($id);

    // Obtener el usuario autenticado
    $usuarioAutenticado = Auth::user();

    // Verificar permisos
    if ($usuarioAutenticado->user_type !== 'admin' && $usuarioAutenticado->id !== $usuarioEditar->id) {
        abort(403, 'No tienes permisos para editar este usuario.');
    }

    // Obtener roles para migración
    $roles = UserType::forMigration();

    // Verificar si el usuario autenticado es un administrador
    $isAdmin = $usuarioAutenticado->user_type == UserType::Admin;

    return view('usuarios.editar', compact('usuarioEditar', 'roles', 'isAdmin'));
}


    
    


public function update(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required',
        'apellido' => 'required',
        'dni' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'rol' => '', // Elimina la regla de validación para el campo 'rol'
    ]);

    $input = $request->all();

    $user = User::find($id);
    $user->update(Arr::except($input, 'rol'));

    // Verifica si se proporciona un valor para 'rol' antes de actualizar
    if (isset($input['rol'])) {
        $user->user_type = $input['rol'];
    }

    $user->save();

    return redirect()->route('usuarios.index');
}





    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index');
    }


    public function show()
    {
        $usuarios = User::all();
        return view('usuarios.roles' , compact('usuarios'));
    }


     




}
