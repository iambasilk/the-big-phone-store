<?php

namespace src\Models;

use src\Models\Product;

class UniqueCombination
{
    public $make;
    public $model;
    public $colour;
    public $capacity;
    public $network;
    public $grade;
    public $condition;
    public $count;

    public function __construct(Product $product)
    {
        $this->make = $product->make;
        $this->model = $product->model;
        $this->colour = $product->colour;
        $this->capacity = $product->capacity;
        $this->network = $product->network;
        $this->grade = $product->grade;
        $this->condition = $product->condition;
        $this->count = 0;
    }
}
