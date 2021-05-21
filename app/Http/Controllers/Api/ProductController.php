<?php

namespace App\Http\Controllers\Api;

use App\Services\Interfaces\IProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;


class ProductController extends BaseController
{
    protected $service;

    public function __construct(IProductService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request): JsonResponse {

        $product = $this->service->store($request);

        if($product instanceof MessageBag){
            return new JsonResponse([
                "error"     => $product,
                "message"   => "Erro de validação"], 400, []
            );
        }
        if ($product instanceof \Exception){
            return new JsonResponse([
                "error"     => $product->getMessage(),
                "message"   => "Erro Interno"], 400, []
            );
        }
        return new JsonResponse([
            "message" => "Cadastro realizado com sucesso",
            "data" => $product], 201, []
        );
    }

    public function update(Request $request, $id): JsonResponse {

        $product = $this->service->update($request, $id);

        if($product instanceof MessageBag){
            return new JsonResponse([
                "error"     => $product,
                "message"   => "Erro de validação"], 400, []
            );
        }
        if ($product instanceof \Exception){
            return new JsonResponse([
                "error"     => $product->getMessage(),
                "message"   => "Erro Interno"], 400, []
            );
        }
        return new JsonResponse([
            "message" => "Cadastro atualiado com sucesso",
            "data" => $product], 201, []
        );
    }
}
