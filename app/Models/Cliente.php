<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario_sistema;

class Cliente extends Usuario_sistema
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'name'
    ];

    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }

    public function orcamentos(){
        return $this->hasMany(Orcamento::class);
    }
}
