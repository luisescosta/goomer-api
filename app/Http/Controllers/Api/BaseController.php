<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\IService;
use Illuminate\Http\JsonResponse;

abstract class BaseController extends Controller
{

    protected $service;

    public function __construct(IService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $limit = app('request')->query('limit');
        $items = $limit ? $this->service->paginate($limit) : $this->service->all();

        if($items instanceof \Exception){
            return new JsonResponse(["error" => $items->getMessage()], 200, []);
        }
        return new JsonResponse(["data" => $items], 200, []);
    }


    public function show($id): JsonResponse
    {
        $item = $this->service->show($id);

        if($item instanceof \Exception){
            return new JsonResponse(["error" => $item->getMessage()], 200, []);
        }
        return new JsonResponse(["data" => $item], 200, []);
    }

    public function destroy($id): JsonResponse {
        $item = $this->service->destroy($id);
        if($item instanceof \Exception){
            return new JsonResponse(["error" => $item->getMessage()], 400, []);
        }
        return new JsonResponse(["data" => "dado removido com sucesso!"], 200, []);
    }
}
