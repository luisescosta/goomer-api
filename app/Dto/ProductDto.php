<?php


namespace App\Dto;


class ProductDto
{
    public int      $id;
    public string   $photo;
    public string   $name;
    public string   $category;
    public float    $price;
    public ?float   $promotional_price;
    public ?string  $promotional_description;
    public ?bool    $active_promotion;
    public string   $restaurant_id;
    public ?array   $hours_promotion;

    public function __construct(
        string $photo,
        string $name,
        string $category,
        float $price,
        ?float $promotional_price,
        ?string $promotional_description,
        ?bool $active_promotion,
        ?array $hours_promotion,
        int $restaurant_id
    ){
        $this->photo                    = $photo;
        $this->name                     = $name;
        $this->category                 = $category;
        $this->promotional_description  = $promotional_description;
        $this->price                    = $price;
        $this->promotional_price        = $promotional_price;
        $this->active_promotion         = $active_promotion ?? false;
        $this->hours_promotion          = $hours_promotion;
        $this->restaurant_id            = $restaurant_id;
    }

    public function getProduct(){
        return [
            'photo'                   => $this->photo,
            'name'                    => $this->name,
            'category'                => $this->category,
            'promotional_description' => $this->promotional_description,
            'price'                   => $this->price,
            'promotional_price'       => $this->promotional_price,
            'active_promotion'        => $this->active_promotion,
            'hours_promotion'         => json_encode($this->hours_promotion),
            'restaurant_id'           => $this->restaurant_id
        ];
    }

    public function addId(int $id){
        $this->id = $id;
    }
}
