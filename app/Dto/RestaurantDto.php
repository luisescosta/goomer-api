<?php


namespace App\Dto;


class RestaurantDto
{
    public int      $id;
    public string   $photo;
    public string   $name;
    public string   $street;
    public string   $number;
    public string   $neighborhood;
    public array   $hours;

    public function __construct(
        string $photo,
        string $name,
        string $street,
        string $number,
        string $neighborhood,
        array $hours
    ){
        $this->photo            = $photo;
        $this->name             = $name;
        $this->street           = $street;
        $this->number           = $number;
        $this->neighborhood     = $neighborhood;
        $this->hours            = $hours;
    }

    public function getRestaurant(){
        return [
            'photo'        => $this->photo,
            'name'         => $this->name,
            'street'       => $this->street,
            'number'       => $this->number,
            'neighborhood' => $this->neighborhood,
            'hours'        => json_encode($this->hours),
        ];
    }

    public function addId(int $id){
        $this->id = $id;
    }
}
