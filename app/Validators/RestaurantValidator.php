<?php


namespace App\Validators;


use \Illuminate\Http\Request;

class RestaurantValidator
{
    static $create = [
        'name'          => 'required|min:3|max:255',
        'photo'         => 'required|min:3|max:255',
        'street'        => 'required|min:3|max:255',
        'number'        => 'required|min:1|max:255',
        'neighborhood'  => 'required|min:3|max:255',
        'hours'         => 'required|array'
    ];

    static $update =  [
        'id'            => 'required|numeric|exists:restaurants,id',
        'name'          => 'required|min:3|max:255',
        'photo'         => 'required|min:3|max:255',
        'street'        => 'required|min:3|max:255',
        'number'        => 'required|min:1|max:255',
        'neighborhood'  => 'required|min:3|max:255',
        'hours'         => 'required|array'
    ];

    static $messages = [
        'required'      => ':attribute é obrigatorio',
        'min'           => ':attribute requer no minimo :min caracteres',
        'max'           => ':attribute requer no maximo :max caracteres',
        'array'         => ':attribute não está no formato array'
    ];

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
