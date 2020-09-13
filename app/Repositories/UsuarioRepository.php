<?php

namespace App\Repositories;

use App\Entities\User;
use App\Interfaces\UsuarioInterface;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsuarioRepository
 * @package App\Repositories
 */
class UsuarioRepository implements UsuarioInterface
{
    /**
     * @var User
     */
    private $usuario;

    /**
     * UsuarioRepository constructor.
     *
     * @param User $usuario
     */
    public function __construct(User $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return Builder[]|Collection
     * @throws Exception
     */
    public function getAll()
    {
        try {
            return User::with(['roles', 'pessoa'])->get();
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $params
     * @return User|mixed
     * @throws Exception
     */
    public function create($params)
    {
        try {
            $newUser = new User();
            $newUser->name = $params->name;
            $newUser->email = $params->email;
            $newUser->status = true;
            $newUser->password = Hash::make($params->password);
            $newUser->save();
            $newUser->roles()->attach($params->roles);

            return $newUser;
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     * @throws Exception
     */
    public function getById($id)
    {
        try {
            return User::with(['roles', 'pessoa'])->find($id);
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $params
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     * @throws Exception
     */
    public function update($params, $id)
    {
        try {
            $user = User::find($id);
            $user->name = $params->name;
            $user->email = $params->email;
            $user->status = $params->status;
            if ($params->password){
                Hash::make($params->password);
            } else {
                unset($params->password);
            }
            $user->save();

            if ($params->roles) {
                $user->roles()->sync($params->roles);
            }

            return $user;
        } catch (Exception $e){
            throw new Exception($e->getMessage());
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
            $user = User::find($id);
            $user->delete();

            return $user;
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}
