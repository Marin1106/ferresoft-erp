<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR USUARIOS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::when($search, function ($query) use ($search) {

                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");

            })
            ->latest()
            ->paginate(10);

        return view(
            'users.index',
            compact(
                'users',
                'search'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CREAR
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('users.create');
    }

    /*
    |--------------------------------------------------------------------------
    | GUARDAR USUARIO
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:6',

            'role' => 'required|in:admin,vendedor,cliente',

            'status' => 'required|in:activo,inactivo',

        ]);

        User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make(
                $request->password
            ),

            'role' => $request->role,

            'status' => $request->status,

        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Usuario creado correctamente'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDITAR
    |--------------------------------------------------------------------------
    */

    public function edit(User $user)
    {
        return view(
            'users.edit',
            compact('user')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR USUARIO
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, User $user)
    {
        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' . $user->id,

            'role' => 'required|in:admin,vendedor,cliente',

            'status' => 'required|in:activo,inactivo',

            'password' => 'nullable|min:6',

        ]);

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR DATOS
        |--------------------------------------------------------------------------
        */

        $user->update([

            'name' => $request->name,

            'email' => $request->email,

            'role' => $request->role,

            'status' => $request->status,

        ]);

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR PASSWORD OPCIONAL
        |--------------------------------------------------------------------------
        */

        if ($request->filled('password')) {

            $user->update([

                'password' => Hash::make(
                    $request->password
                )

            ]);

        }

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Usuario actualizado correctamente'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | ACTIVAR / DESACTIVAR
    |--------------------------------------------------------------------------
    */

    public function toggle(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | EVITAR DESACTIVARTE A TI MISMO
        |--------------------------------------------------------------------------
        */

        if (auth()->id() == $user->id) {

            return back()->with(
                'error',
                'No puedes desactivarte a ti mismo'
            );

        }

        $user->status = $user->status === 'activo'
            ? 'inactivo'
            : 'activo';

        $user->save();

        return back()->with(
            'success',
            'Estado actualizado correctamente'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR USUARIO
    |--------------------------------------------------------------------------
    */

    public function destroy(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | EVITAR ELIMINARTE A TI MISMO
        |--------------------------------------------------------------------------
        */

        if (auth()->id() == $user->id) {

            return back()->with(
                'error',
                'No puedes eliminar tu propio usuario'
            );

        }

        $user->delete();

        return back()->with(
            'success',
            'Usuario eliminado correctamente'
        );
    }
}