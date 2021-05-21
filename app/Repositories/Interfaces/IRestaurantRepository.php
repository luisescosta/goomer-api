<?php

namespace App\Repositories\Interfaces;

use App\Dto\RestaurantDto;

interface IRestaurantRepository extends IRepository
{
    public function store(RestaurantDto $productDto);

    public function update(RestaurantDto $productDto);
}
