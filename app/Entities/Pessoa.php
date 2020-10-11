<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find($id)
 * @method static where(string $string, $id)
 * @method static truncate()
 * @method static create(array $array)
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
        'num_doc',
        'data_nasc',
        'sexo',
        'telefone'
    ];

    /**
     * @return HasOne
     */
    public function usuario(): HasOne
    {
        return $this->hasOne('App\Entities\User','id', 'usuario_id');
    }
}
