<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj'
    ];

    public function produtos(){
        return $this->hasMany(Produto::class);
    }

}
