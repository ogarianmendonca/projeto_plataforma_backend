<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Exception;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $users = $this->userRepository->getAllUsers();
            return response()->json($users);
        } catch (Exception $e) {
            return response()->json(['message' => 'Dados não encontrados!']);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->userRepository->createUser($request);
            return response()->json(['message' => 'Usuário cadastrado!']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar!']);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $user = $this->userRepository->getUserForId($id);
            return response()->json(['user' => $user]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Usuário não encontrado']);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $user = $this->userRepository->updateUser($request, $id);
            return response()->json(['message' => 'Usuário editado!', 'user' => $user]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao editar!']);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            $user = $this->userRepository->deleteUser($id);
            return response()->json(['message' => 'Usuário excluído!', 'user' => $user]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao excluir!']);
        }
    }
}
