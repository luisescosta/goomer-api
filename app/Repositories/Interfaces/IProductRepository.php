<?php

namespace App\Repositories\Interfaces;

use \App\Dto\ProductDto;

interface IProductRepository extends IRepository
{
    public function store(ProductDto $productDto);

    public function update(ProductDto $productDto);
}
