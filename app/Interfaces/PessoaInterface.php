<?php

namespace App\Interfaces;

/**
 * Interface PessoaInterface
 * @package App\Interfaces
 */
interface PessoaInterface
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $params
     * @return mixed
     */
    public function create($params);

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $params
     * @param $id
     * @return mixed
     */
    public function update($params, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
