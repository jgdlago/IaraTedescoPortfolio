<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Repository\ContactRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected ContactRepository $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json($this->contactRepository->all());
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
            return response()->json($this->contactRepository->find($id));
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * @param ContactFormRequest $request
     * @return JsonResponse
     */
    public function store(ContactFormRequest $request): JsonResponse
    {
        try {
            return response()->json($this->contactRepository->create($request->toArray()));
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * @param ContactFormRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(ContactFormRequest $request, $id): JsonResponse
    {
        try {
            return response()->json($this->contactRepository->update($id, $request->toArray()));
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
            if ($this->contactRepository->delete($id)) {
                return response()->json(['message' => 'Contato excluído com sucesso!']);
            } else {
                return response()->json(['message' => 'Não foi possível excluir o contato']);
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
