<?php

// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Enums\UserType; // Asegúrate de importar la enumeración

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'apellido' => ['required', 'string','max:255'],
            'dni' => ['required', 'string','max:255','unique:users'],
            'telefono' => ['required', 'string','max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // Cambia el tipo de usuario predeterminado a 'admin' temporalmente
        $userType = UserType::User;

        $user = User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'apellido' => $data['apellido'],
            'dni' => $data['dni'],
            'password' => Hash::make($data['password']),
            'telefono' => $data['telefono'],
            'user_type' => $userType,
        ]);

        return $user;
    }
}
