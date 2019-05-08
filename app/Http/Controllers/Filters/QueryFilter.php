<?php

namespace App\Http\Controllers\Filters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class QueryFilter
{
    protected $builder;
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function apply($builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) { // если нашем классе (this) существует метод filter
                $this->$filter($value); // таким образом название метода динамическое
            }
        }
        return $this->builder;
    }
}
