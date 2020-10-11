<?php


namespace App\Repositories;

use App\Entities\Role;
use App\Interfaces\RoleInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RoleRepository
 * @package App\Repositories
 */
class RoleRepository implements RoleInterface
{
    /**
     * @var Role
     */
    private $role;

    /**
     * RoleRepository constructor.
     *
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * @return Role[]|Collection|mixed
     * @throws Exception
     */
    public function getAll()
    {
        try {
            return Role::all();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
