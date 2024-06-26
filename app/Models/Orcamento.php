<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'data_inicio_analise',  // indica quando a analise iniciou
        //'data_previsao',        // indica uma previsão de fim de prazo de cotação
        'data_encerramento',    // data de quando se obteve a resposta final 
        'orcamento_status',     // aprovado ou Recusado
        'response_observation', 
        'cliente_id',
        'administrador_id',
        //'tipo_orcamento_id'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function administrador(){
        return $this->belongsTo(Administrador::class);
    }

    public function itemOrcamentos(){
        return $this->hasMany(ItemOrcamento::class);
    }
}
