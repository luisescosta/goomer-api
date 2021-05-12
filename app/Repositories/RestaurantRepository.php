<?php


namespace App\Repositories;


use App\Models\Restaurant;
use App\Repositories\Interfaces\IRestaurantRepository;

class RestaurantRepository extends Repository implements IRestaurantRepository
{

    function all()
    {
        return $this->model->with('products')->get();
    }

    function store(Array $array){
        return $this->model->create($array);
    }

    function update(Array $array, $id){
        $restaurant = $this->model->find($id);
        $restaurant->update($array);

        return $restaurant;
    }

    function model(): string {
        return Restaurant::class;
    }
}
