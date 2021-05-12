<?php

namespace App\Services;

use App\Repositories\Interfaces\IRestaurantRepository;
use App\Services\Interfaces\IRestaurantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RestaurantService extends Service implements IRestaurantService
{
    protected $repository;

    public function __construct(IRestaurantRepository $repository)
    {
        $this->repository = $repository;
    }

    function store(Request $request){

        $validator = $this->validator($request);

        if($validator->fails()){
            return $validator->errors();
        }

        $restaurant = $request->only(['photo', 'name', 'street', 'number', 'neighborhood', 'hours']);

        $restaurant['hours'] = json_encode($request->hours);
        return $this->repository->store($restaurant);
    }

    function update(Request $request, $id){
        $validator = $this->validator($request);

        if($validator->fails()){
            return $validator->errors();
        }

        $restaurant = $request->only(['photo', 'name', 'street', 'number', 'neighborhood', 'hours']);

        return $this->repository->update($restaurant, $id);
    }

    function validator($request) {

        $validator = Validator::make($request->all(),
            [
                'name'          => 'required|min:3|max:255',
                'photo'         => 'required|min:3|max:255',
                'street'        => 'required|min:3|max:255',
                'number'        => 'required|min:3|max:255',
                'neighborhood'  => 'required|min:3|max:255',
                'hours'         => 'required|array'
            ],
            [
                'required'      => ':attribute é obrigatorio',
                'min'           => ':attribute requer no minimo :min caracteres',
                'max'           => ':attribute requer no maximo :max caracteres',
                'array'          => ':attribute não está no formato array'
            ]
        );

        return $validator;
    }

}
