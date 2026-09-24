<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'name',
        'email',
        'password',
        'role',
        'status',

    ];

    /*
    |--------------------------------------------------------------------------
    | HIDDEN
    |--------------------------------------------------------------------------
    */

    protected $hidden = [

        'password',
        'remember_token',

    ];

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'email_verified_at' => 'datetime',

        'password' => 'hashed',

    ];

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR ROLE BADGE
    |--------------------------------------------------------------------------
    */

    public function getRoleBadgeAttribute()
    {
        return match ($this->role) {

            'admin'     => 'Administrador',

            'vendedor'  => 'Vendedor',

            'contador'  => 'Contador',

            'operario'  => 'Operario',

            default     => 'Usuario',

        };
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR STATUS BADGE
    |--------------------------------------------------------------------------
    */

    public function getStatusBadgeAttribute()
    {
        return $this->status === 'activo'
            ? '🟢 Activo'
            : '🔴 Inactivo';
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDAR ADMIN
    |--------------------------------------------------------------------------
    */

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDAR VENDEDOR
    |--------------------------------------------------------------------------
    */

    public function isVendedor()
    {
        return $this->role === 'vendedor';
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDAR CONTADOR
    |--------------------------------------------------------------------------
    */

    public function isContador()
    {
        return $this->role === 'contador';
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDAR OPERARIO
    |--------------------------------------------------------------------------
    */

    public function isOperario()
    {
        return $this->role === 'operario';
    }
}