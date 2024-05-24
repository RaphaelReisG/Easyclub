<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj',
        'time_sla'
    ];

    public function clientes(){
        return $this->hasMany(Cliente::class);
    }

    public function planos(){
        return $this->belongsToMany(Plano::class);
    }
}
