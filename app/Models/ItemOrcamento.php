<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOrcamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'product_code', 
        'manufacturer_name',
        'orcamento_id',
        'tipo_orcamento_id'
    ];

    public function orcamento(){
        return $this->belongsTo(Orcamento::class);
    }

    public function tipo_orcamento(){
        return $this->belongsTo(TipoOrcamento::class);
    }
}
