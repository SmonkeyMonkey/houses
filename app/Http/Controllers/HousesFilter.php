<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HousesFilter extends QueryFilter
{
    public function name($value){
        $this->builder->where('name','like',"%$value%");
    }
    public function bedrooms($value){
        $this->builder->where('bedrooms',$value);
    }
    public function bathrooms($value){
        $this->builder->where('bathrooms',$value);
    }
    public function storeys($value){
        $this->builder->where('storeys',$value);
    }
    public function garages($value){
        $this->builder->where('garages',$value);
    }
    public function filters(){
        return $this->request->all();
    }
}
