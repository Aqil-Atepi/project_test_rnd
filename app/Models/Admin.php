<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'kode_admin';
    public $timestamps = false;

    protected $fillable = ['username', 'password'];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed', // auto-bcrypt on create/update
        ];
    }

    // Your table has no remember_token column
    public function getRememberTokenName()
    {
        return '';
    }
}