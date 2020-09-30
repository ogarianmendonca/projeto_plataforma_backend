<?php

namespace App\Interfaces;

/**
 * Interface UsuarioInterface
 * @package App\Interfaces
 */
interface UsuarioInterface
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

    /**
     * @param $params
     * @return mixed
     */
    public function upload($params);
}
