<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM CREAR USUARIO
    |--------------------------------------------------------------------------
    | Solo ADMIN puede acceder
    |--------------------------------------------------------------------------
    */

    public function create(): View
    {
        abort_if(
            auth()->user()->role !== 'admin',
            403
        );

        return view('auth.register');
    }

    /*
    |--------------------------------------------------------------------------
    | CREAR USUARIO
    |--------------------------------------------------------------------------
    |
    | El administrador crea empleados desde el panel
    |
    */

    public function store(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDAR
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ],

            'role' => [
                'required',
                'in:admin,empleado'
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | CREAR USUARIO
        |--------------------------------------------------------------------------
        */

        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make(
                $request->password
            ),

            'role' => $request->role,

            'status' => 'activo',

        ]);

        /*
        |--------------------------------------------------------------------------
        | EVENTO
        |--------------------------------------------------------------------------
        */

        event(new Registered($user));

        /*
        |--------------------------------------------------------------------------
        | NO HACER LOGIN AUTOMÁTICO
        |--------------------------------------------------------------------------
        |
        | Porque el ADMIN sigue logueado
        |
        */

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Usuario creado correctamente'
            );
    }
}