<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['photo', 'name', 'street', 'number', 'neighborhood', 'hours'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
