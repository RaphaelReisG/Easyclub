<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario_sistema;

class Administrador extends Usuario_sistema
{
    use HasFactory;

    public function orcamentos()
    {
        return $this->hasMany(Orcamento::class);
    }


}
