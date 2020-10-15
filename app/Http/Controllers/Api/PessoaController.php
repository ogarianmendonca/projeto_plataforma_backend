<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\PessoaInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class PessoaController
 * @package App\Http\Controllers\Api
 */
class PessoaController extends Controller
{
    /**
     * @var PessoaInterface
     */
    private $pessoaRepository;

    /**
     * PessoaController constructor.
     *
     * @param PessoaInterface $pessoaRepository
     */
    public function __construct(PessoaInterface $pessoaRepository)
    {
        $this->pessoaRepository = $pessoaRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $pessoa = $this->pessoaRepository->getAll();
            return response()->json($pessoa);
        } catch (Exception $e) {
            return response()->json(['message' => 'Dados não encontrados!'], 404);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $pessoa = $this->pessoaRepository->create($request);
            return response()->json(['message' => 'Cadastrado com sucesso!', 'pessoa' => $pessoa]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar!'], 400);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            $pessoa = $this->pessoaRepository->getById($id);
            return response()->json($pessoa);
        } catch (Exception $e) {
            return response()->json(['message' => 'Dados não encontrados!'], 404);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $pessoa = $this->pessoaRepository->update($request, $id);
            return response()->json(['message' => 'Editado com sucesso!', 'pessoa' => $pessoa]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao editar!'], 400);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $pessoa = $this->pessoaRepository->delete($id);
            return response()->json(['message' => 'Excluído com sucesso!', 'pessoa' => $pessoa]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao excluir!'], 400);
        }
    }
}
