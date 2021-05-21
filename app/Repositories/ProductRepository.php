<?php


namespace App\Repositories;


use App\Models\Product;
use \App\Dto\ProductDto;
use App\Repositories\Interfaces\IProductRepository;

class ProductRepository extends Repository implements IProductRepository
{
    function all()
    {
        $products = $this->model->all();
        $products->map(function($product) {
            !$product->hours_promotion ?: $product->hours_promotion = json_decode($product->hours_promotion);
        });
        return $products;
    }

    function show($id){
        try {
            $product = $this->model->find($id);
            !$product->hours_promotion ?: $product->hours_promotion = json_decode($product->hours_promotion);
            return $product;
        } catch (\Exception $exception){
            return new \Exception ('Não foi possivel recuperar registro');
        }
    }

    function store(ProductDto $productDto){
        try {
            $product = $this->model->create($productDto->getProduct());
            !$product->hours_promotion ?: $product->hours_promotion = json_decode($product->hours_promotion);
            return $product;
        } catch (\Exception $exception){
            return new \Exception ('Não foi possivel cadastrar registro');
        }
    }

    function update(ProductDto $productDto){
        try {
            $product = $this->model->find($productDto->id);
            $product->update($productDto->getProduct());
            !$product->hours_promotion ?: $product->hours_promotion = json_decode($product->hours_promotion);
            return $product;
        } catch (\Exception $exception){
            return new \Exception ('Não foi possivel ataulizar registro');
        }
    }

    function model(): string {
        return Product::class;
    }
}
