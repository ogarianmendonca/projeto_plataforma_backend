<?php

namespace App\Interfaces;

/**
 * Interface UserInterface
 * @package App\Interfaces
 */
interface UserInterface
{
    /**
     * @return mixed
     */
    public function getAllUsers();

    /**
     * @param $params
     * @return mixed
     */
    public function createUser($params);

    /**
     * @param $id
     * @return mixed
     */
    public function getUserForId($id);

    /**
     * @param $params
     * @param $id
     * @return mixed
     */
    public function updateUser($params, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteUser($id);
}
