<?php

namespace App\Http\Controllers;

use App\Http\Requests\KnowledgeFormRequest;
use App\Repository\KnowledgeRepository;
use Exception;
use Illuminate\Http\JsonResponse;

class KnowledgeController extends Controller
{
    protected KnowledgeRepository $knowledgeRepository;
    public function __construct(KnowledgeRepository $knowledgeRepository)
    {
        $this->knowledgeRepository = $knowledgeRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json($this->knowledgeRepository->all());
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            return response()->json($this->knowledgeRepository->find($id));
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * @param KnowledgeFormRequest $request
     * @return JsonResponse
     */
    public function store(KnowledgeFormRequest $request): JsonResponse
    {
        try {
            return response()->json($this->knowledgeRepository->create($request->toArray()));
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * @param KnowledgeFormRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(KnowledgeFormRequest $request, $id): JsonResponse
    {
        try {
            return response()->json($this->knowledgeRepository->update($id, $request->toArray()));
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            if ($this->knowledgeRepository->delete($id)) {
                return response()->json(['message' => 'excluído com sucesso!']);
            } else {
                return response()->json(['message' => 'Não foi possível excluir!']);
            }
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Handle exceptions and return a JSON response
     *
     * @param Exception $e
     * @return JsonResponse
     */
    private function handleException(Exception $e): JsonResponse
    {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
