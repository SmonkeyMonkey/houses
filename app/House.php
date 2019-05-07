<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable= ['name','price','bedrooms','bathrooms','storeys','garages'];
    public $timestamps = false;
    public function scopeFilter($builder,$filters){
        return $filters->apply($builder);
    }
}
