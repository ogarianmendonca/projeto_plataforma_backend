<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\RoleInterface;
use Illuminate\Http\JsonResponse;
use Exception;

/**
 * Class RoleController
 * @package App\Http\Controllers\Api
 */
class RoleController extends Controller
{

    /**
     * @var RoleInterface
     */
    private $roleRepository;

    /**
     * RoleController constructor.
     *
     * @param RoleInterface $roleRepository
     */
    public function __construct(RoleInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $roles = $this->roleRepository->getAll();
            return response()->json($roles);
        } catch (Exception $e) {
            return response()->json(['message' => 'Dados não encontrados!']);
        }
    }
}
