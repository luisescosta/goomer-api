<?php

namespace App\Services;

use App\Dto\RestaurantDto;
use App\Repositories\Interfaces\IRestaurantRepository;
use App\Services\Interfaces\IRestaurantService;
use App\Validators\RestaurantValidator;
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

        $validator = $this->validator($request, RestaurantValidator::create());

        if($validator->fails()){
            return $validator->errors();
        }

        $restaurant = new RestaurantDto(
            $request->photo,
            $request->name,
            $request->street,
            $request->number,
            $request->neighborhood,
            $request->hours
        );
        return $this->repository->store($restaurant);
    }

    function update(Request $request, $id){
        $validator = $this->validator($request, RestaurantValidator::update());

        if($validator->fails()){
            return $validator->errors();
        }

        $restaurant = new RestaurantDto(
            $request->photo,
            $request->name,
            $request->street,
            $request->number,
            $request->neighborhood,
            $request->hours
        );
        $restaurant->addId($id);

        return $this->repository->update($restaurant);
    }

    function validator($request, $rules) {
        $validator = Validator::make(
            RestaurantValidator::getParams($request),
            $rules,
            RestaurantValidator::messages()
        );

        return $validator;
    }

}
