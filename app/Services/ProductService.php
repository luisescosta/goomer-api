<?php

namespace App\Services;

use App\Repositories\Interfaces\IProductRepository;
use App\Services\Interfaces\IProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductService extends Service implements IProductService
{
    protected $repository;

    public function __construct(IProductRepository $repository)
    {
        $this->repository = $repository;
    }


    function store(Request $request){

        $validator = $this->validator($request);

        if($validator->fails()){
            return $validator->errors();
        }

        $product = $request->only(
            ['photo', 'name', 'description', 'price', 'promotional_price', 'restaurant_id']
        );

        return $this->repository->store($product);
    }

    function update(Request $request, $id){
        $validator = $this->validator($request);

        if($validator->fails()){
            return $validator->errors();
        }

        $product = $request->only(
            ['photo', 'name', 'description', 'price', 'promotional_price', 'restaurant_id']
        );

        return $this->repository->update($product, $id);
    }

    function validator($request) {

        $validator = Validator::make($request->all(),
            [
                'name'          => 'required|min:3|max:255',
                'photo'         => 'required|min:3|max:255',
                'price'         => 'required',
                'description'   => 'required',
                'restaurant_id' => 'required|exists:restaurants,id',
            ],
            [
                "required"      => ":attribute é obrigatorio",
                "min"           => ":attribute requer no minimo :min caracteres",
                "max"           => ":attribute requer no maximo :max caracteres",
                "exists"        => ":attribute não existe",
            ]
        );

        return $validator;
    }

}
