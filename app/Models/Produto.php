<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cost_price',
        'sale_price', 
        'tipo_produto_id',
        'fornecedor_id'
    ];

    public function tipo_produto(){
        return $this->belongsTo(Tipo_Produto::class);
    }

    public function fornecedor(){
        return $this->belongsTo(Fornecedor::class);
    }

    public function planos(){
        return $this->belongsToMany(Plano::class)->withPivot(['qty_item', 'price_item']);
    }
}
