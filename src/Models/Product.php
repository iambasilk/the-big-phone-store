<?php

namespace src\Models;

class Product
{
    public $make;
    public $model;
    public $colour;
    public $capacity;
    public $network;
    public $grade;
    public $condition;
    public $count;

    public function __construct($data)
    {
        $this->make = $data[0] ?? null;
        $this->model = $data[1] ?? null;
        $this->colour = $data[2] ?? null;
        $this->capacity = $data[3] ?? null;
        $this->network = $data[4] ?? null;
        $this->grade = $data[5] ?? null;
        $this->condition = $data[6] ?? null;
        $this->count =  isset($data[7]) ? (int) $data[7] : 1;

        $this->validate();
    }

    private function validate()
    {
        if (
            empty($this->make) || empty($this->model)
        ) {
            var_dump($this);
            throw new \Exception("Required fields are missing.");
        }
    }

    public static function display($product)
    {
        echo "Product:\n";
        echo "  Make: {$product->make}\n";
        echo "  Model: {$product->model}\n";
        echo "  Colour: {$product->colour}\n";
        echo "  Capacity: {$product->capacity}\n";
        echo "  Network: {$product->network}\n";
        echo "  Grade: {$product->grade}\n";
        echo "  Condition: {$product->condition}\n";
    }
}
