<?php

namespace App\Repositories;

use App\Entities\Pessoa;
use App\Interfaces\PessoaInterface;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PessoaRepository
 * @package App\Repositories
 */
class PessoaRepository implements PessoaInterface
{
    /**
     * @var Pessoa
     */
    private $pessoa;

    /**
     * PessoaRepository constructor.
     *
     * @param Pessoa $pessoa
     */
    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    /**
     * @return Builder[]|Collection|mixed
     * @throws Exception
     */
    public function getAll()
    {
        try {
            return Pessoa::with(['usuario'])->get();
        } catch (Exception $e){
            throw new Exception();
        }
    }

    /**
     * @param $params
     * @return Pessoa|mixed
     * @throws Exception
     */
    public function create($params)
    {
        try {
            $novaPessoa = new Pessoa();
            $novaPessoa->usuario_id = $params->usuario_id;
            $novaPessoa->endereco = $params->endereco;
            $novaPessoa->bairro = $params->bairro;
            $novaPessoa->cidade = $params->cidade;
            $novaPessoa->numero = $params->numero;
            $novaPessoa->uf = $params->uf;
            $novaPessoa->cep = $params->cep;
            $novaPessoa->pais = $params->pais;
            $novaPessoa->complemento = $params->complemento;
            $novaPessoa->tipo_doc = $params->tipo_doc;
            $novaPessoa->num_doc = $params->num_doc;
            $novaPessoa->data_nasc = $params->data_nasc;
            $novaPessoa->sexo = $params->sexo;
            $novaPessoa->telefone = $params->telefone;
            $novaPessoa->save();

            return $novaPessoa;
        } catch (Exception $e){
            throw new Exception();
        }
    }

    /**
     * @param $id
     * @return Builder|Builder[]|Collection|Model|mixed|null
     * @throws Exception
     */
    public function getById($id)
    {
        try {
            return Pessoa::with(['usuario'])->find($id);
        } catch (Exception $e){
            throw new Exception();
        }
    }

    /**
     * @param $params
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function update($params, $id)
    {
        try {
            $pessoa = $this->pessoa->find($id);
            $pessoa->update($params->all());

            return $pessoa;
        } catch (Exception $e){
            throw new Exception();
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function delete($id)
    {
        try {
            $pessoa = Pessoa::find($id);
            $pessoa->delete();

            return $pessoa;
        } catch (Exception $e){
            throw new Exception();
        }
    }
}
