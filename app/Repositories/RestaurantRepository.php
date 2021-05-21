<?php


namespace App\Repositories;


use App\Dto\RestaurantDto;
use App\Models\Restaurant;
use App\Repositories\Interfaces\IRestaurantRepository;

class RestaurantRepository extends Repository implements IRestaurantRepository
{

    function all()
    {
        $restaurants = $this->model->with('products')->get();
        $restaurants->map(function($restaurant) {
            !$restaurant->hours ?: $restaurant->hours = json_decode($restaurant->hours);
            $restaurant->products->map(function ($product) {
                !$product->hours_promotion ?: $product->hours_promotion = json_decode($product->hours_promotion);
            });
        });
        return $restaurants;
    }

    function show($id){
        try {
            $restaurant = $this->model->find($id);
            !$restaurant->hours ?: $restaurant->hours = json_decode($restaurant->hours);
            return $restaurant;
        } catch (\Exception $exception){
            return new \Exception ('Não foi possivel recuperar registro');
        }
    }

    function store(RestaurantDto $restaurantDto){
        try {
            $restaurant = $this->model->create($restaurantDto->getRestaurant());
            !$restaurant->hours ?: $restaurant->hours = json_decode($restaurant->hours);
            return $restaurant;
        } catch (\Exception $exception){
            return new \Exception ('Não foi possivel cadastrar registro');
        }
    }



    function update(RestaurantDto $restaurantDto){
        try {
            $restaurant = $this->model->find($restaurantDto->id);

            if(!$restaurant){
                return new \Exception ('ID não é valido');
            }

            $restaurant->update($restaurantDto->getRestaurant());
            !$restaurant->hours ?: $restaurant->hours = json_decode($restaurant->hours);
            return $restaurant;
        } catch (\Exception $exception){
            return new \Exception ('Não foi possivel atualizar registro');
        }
    }

    function model(): string {
        return Restaurant::class;
    }
}
