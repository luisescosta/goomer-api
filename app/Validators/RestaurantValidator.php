<?php


namespace App\Validators;


use App\Rules\Hours;
use \Illuminate\Http\Request;

class RestaurantValidator
{
    static function create() {
        return  [
            'name'          => 'required|min:3|max:255',
            'photo'         => 'required|min:3|max:255',
            'street'        => 'required|min:3|max:255',
            'number'        => 'required|min:1|max:255',
            'neighborhood'  => 'required|min:3|max:255',
            'hours'         => ['array', new Hours],
        ];
    }


    static function update(){
        return [
            'id'            => 'required|numeric|exists:restaurants,id',
            'name'          => 'required|min:3|max:255',
            'photo'         => 'required|min:3|max:255',
            'street'        => 'required|min:3|max:255',
            'number'        => 'required|min:1|max:255',
            'neighborhood'  => 'required|min:3|max:255',
            'hours'         => ['array', new Hours],
        ];
    }


    static function messages(){
        return [
            'required'      => ':attribute é obrigatorio',
            'min'           => ':attribute requer no minimo :min caracteres',
            'max'           => ':attribute requer no maximo :max caracteres',
            'array'         => ':attribute não está no formato array'
        ];
    }

    static function getParams(Request $request)
    {
        $validator = [];
        $params = [
            'id',
            'name',
            'photo',
            'street',
            'number',
            'neighborhood',
            'hours'
        ];
        foreach ($params as $param) {
            !$request->{$param} ?: $validator[$param] = $request->{$param};
        }
        return $validator;
    }
}
