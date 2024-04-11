<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function produtos(){
        return $this->belongsToMany(Produto::class)->withPivot(['qty_item', 'price_item']);
    }

    public function empresas(){
        return $this->belongsToMany(Empresa::class);
    }
}
