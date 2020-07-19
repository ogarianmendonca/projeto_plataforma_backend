<?php

namespace App\Repositories;

use App\Entities\User;
use App\Interfaces\UserInterface;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements UserInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Builder[]|Collection
     * @throws Exception
     */
    public function getAllUsers()
    {
        try {
            return User::with('roles')->get();
        } catch (Exception $e){
            throw new Exception();
        }
    }

    /**
     * @param $params
     * @return bool
     * @throws Exception
     */
    public function createUser($params)
    {
        try {
            $newUser = new User();
            $newUser->name = $params->name;
            $newUser->email = $params->email;
            $newUser->status = true;
            $newUser->password = Hash::make($params->password);
            $newUser->save();
            $newUser->roles()->attach($params->roles);

            return true;
        } catch (Exception $e){
            throw new Exception();
        }
    }

    /**
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     * @throws Exception
     */
    public function getUserForId($id)
    {
        try {
            return User::with('roles')->find($id);
        } catch (Exception $e){
            throw new Exception();
        }
    }

    /**
     * @param $params
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     * @throws Exception
     */
    public function updateUser($params, $id)
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

            $user->roles()->sync($params->roles);

            return $user;
        } catch (Exception $e){
            throw new Exception();
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function deleteUser($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return $user;
        } catch (Exception $e){
            throw new Exception();
        }
    }
}
