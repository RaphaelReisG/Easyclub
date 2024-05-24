<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoOrcamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function orcamentos(){
        return $this->hasMany(Orcamento::class);
    }
}
