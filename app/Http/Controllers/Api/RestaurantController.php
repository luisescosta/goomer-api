<?php

namespace App\Http\Controllers\Api;

use App\Services\Interfaces\IRestaurantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;


class RestaurantController extends BaseController
{
    protected $service;

    public function __construct(IRestaurantService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request): JsonResponse {

        $restaurant = $this->service->store($request);

        if($restaurant instanceof MessageBag){
            return new JsonResponse([
                "error"     => $restaurant,
                "message"   => "Erro de validação"], 400, []
            );
        }
        if ($restaurant instanceof \Exception){
            return new JsonResponse([
                "error"     => $restaurant->getMessage(),
                "message"   => "Erro Interno"], 400, []
            );
        }
        return new JsonResponse([
            "message" => "Cadastro realizado com sucesso",
            "data" => $restaurant], 201, []
        );
    }

    public function update(Request $request, $id): JsonResponse {

        $restaurant = $this->service->update($request, $id);

        if($restaurant instanceof MessageBag){
            return new JsonResponse([
                "error"     => $restaurant,
                "message"   => "Erro de validação"], 400, []
            );
        }
        if ($restaurant instanceof \Exception){
            return new JsonResponse([
                "error"     => $restaurant->getMessage(),
                "message"   => "Erro Interno"], 400, []
            );
        }
        return new JsonResponse([
            "message" => "Cadastro realizado com sucesso",
            "data" => $restaurant], 201, []
        );
    }
}
