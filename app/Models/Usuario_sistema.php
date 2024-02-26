<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pessoa;
use App\Models\User;

class Usuario_sistema extends Pessoa
{
    use HasFactory;

    public function user(){
        return $this->morphOne(User::class, 'userable');
    }
}
