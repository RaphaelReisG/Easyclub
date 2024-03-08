<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function produtos(){
        return $this->hasMany(Produto::class);
    }
}
