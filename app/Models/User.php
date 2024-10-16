<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['username', 'password'];

    public function medicaments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Medicament::class);
    }
}
