<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find($id)
 */
class Pessoa extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id',
        'endereco',
        'bairro',
        'cidade',
        'numero',
        'uf',
        'cep',
        'pais',
        'complemento',
        'tipo_doc',
        'doc_principal',
        'data_nasc',
        'sexo',
        'telefone'
    ];

    /**
     * @return HasOne
     */
    public function usuario()
    {
        return $this->hasOne('App\Entities\User','id', 'usuario_id');
    }
}
