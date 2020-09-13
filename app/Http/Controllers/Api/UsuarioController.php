<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\UsuarioInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

/**
 * Class UsuarioController
 * @package App\Http\Controllers\Api
 */
class UsuarioController extends Controller
{

    /**
     * @var UsuarioInterface
     */
    private $usuarioRepository;

    /**
     * UsuarioController constructor.
     *
     * @param UsuarioInterface $usuarioRepository
     */
    public function __construct(UsuarioInterface $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $users = $this->usuarioRepository->getAll();
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
            $user = $this->usuarioRepository->create($request);
            return response()->json(['message' => 'Cadastrado com sucesso!', 'user' => $user]);
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
            $user = $this->usuarioRepository->getById($id);
            return response()->json(['user' => $user]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Dados não encontrados!']);
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
            $user = $this->usuarioRepository->update($request, $id);
            return response()->json(['message' => 'Editado com sucesso!', 'user' => $user]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao editar!']);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $user = $this->usuarioRepository->delete($id);
            return response()->json(['message' => 'Excluído com sucesso!', 'user' => $user]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao excluir!']);
        }
    }
}