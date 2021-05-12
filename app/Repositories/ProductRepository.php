<?php


namespace App\Repositories;


use App\Models\Product;
use App\Repositories\Interfaces\IProductRepository;

class ProductRepository extends Repository implements IProductRepository
{
    function store(Array $array){
        return $this->model->create($array);
    }

    function update(Array $array, $id){
        $product = $this->model->find($id);
        $product->update($array);
        return $product;
    }

    function model(): string {
        return Product::class;
    }
}
