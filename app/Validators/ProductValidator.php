<?php


namespace App\Validators;


use App\Rules\Hours;
use Illuminate\Http\Request;

class ProductValidator
{

    static function getParams(Request $request): array {
        $validator = [];
        $params = [
            'id',
            'photo',
            'name',
            'category',
            'promotional_description',
            'price',
            'promotional_price',
            'active_promotion',
            'hours_promotion',
            'restaurant_id'
        ];
        foreach ($params as $param){
            !$request->{$param} ?: $validator[$param] = $request->{$param};
        }
        return $validator;
    }

    static function update(): array {
        return [
            'id'                        => 'required|numeric|exists:products,id',
            'name'                      => 'required|min:3|max:255',
            'photo'                     => 'required|min:3|max:255',
            'category'                  => 'required|min:3|max:255',
            'price'                     => 'required|numeric',
            'promotional_price'         => 'numeric',
            'active_promotion'          => 'boolean',
            'promotional_description'   => 'min:3|max:255',
            'hours_promotion'           =>  ['array', new Hours],
            'restaurant_id'             => 'required|exists:restaurants,id',
        ];
    }

    static function create(): array {
        return [
        'name'                      => 'required|min:3|max:255',
        'photo'                     => 'required|min:3|max:255',
        'category'                  => 'required|min:3|max:255',
        'price'                     => 'required|numeric',
        'promotional_price'         => 'numeric',
        'active_promotion'          => 'boolean',
        'promotional_description'   => 'min:3|max:255',
        'hours_promotion'           => ['array', new Hours],
        'restaurant_id'             => 'required|exists:restaurants,id',
    ];
    }

    static function messages(): array {
        return [
            'required'     => ':attribute é obrigatorio',
            'numeric'      => ':attribute não é um numero',
            'min'          => ':attribute requer no minimo :min caracteres',
            'max'          => ':attribute requer no maximo :max caracteres',
            'exists'       => ':attribute não existe',
            'array'        => ':attribute não é um array',
            'boolean'      => ':attribute não é um boolean'
        ];
    }
}
