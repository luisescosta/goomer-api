<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'photo',
        'name',
        'category',
        'price',
        'promotional_price',
        'promotional_description',
        'active_promotion',
        'restaurant_id',
        'hours_promotion'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
