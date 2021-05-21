<?php

namespace App\Services;

use App\Dto\ProductDto;
use App\Repositories\Interfaces\IProductRepository;
use App\Services\Interfaces\IProductService;
use App\Validators\ProductValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductService extends Service implements IProductService
{
    protected $repository;

    public function __construct(IProductRepository $repository)
    {
        $this->repository = $repository;
    }

    function store(Request $request) {

        $validator = $this->validator($request, ProductValidator::create());

        if($validator->fails()){
            return $validator->errors();
        }

        $product = new ProductDto(
            $request->photo,
            $request->name,
            $request->category,
            $request->price,
            $request->promotional_price,
            $request->promotional_description,
            $request->active_promotion,
            $request->hours_promotion,
            $request->restaurant_id,
        );

        return $this->repository->store($product);
    }

    function update(Request $request, $id){
        $validator = $this->validator($request, ProductValidator::update());

        if($validator->fails()){
            return $validator->errors();
        }

        $product = new ProductDto(
            $request->photo,
            $request->name,
            $request->category,
            $request->price,
            $request->promotional_price,
            $request->promotional_description,
            $request->active_promotion,
            $request->hours_promotion,
            $request->restaurant_id,
        );

        $product->addId($id);

        return $this->repository->update($product);
    }

    function validator($request, $rules) {
        return Validator::make(
            ProductValidator::getParams($request),
            $rules,
            ProductValidator::messages()
        );
    }

}
