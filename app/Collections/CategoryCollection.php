<?php

use Illuminate\Database\Eloquent\Collection;

class CategoryCollection extends Collection
{
    public function onlyPrice()
    {
        return $this->map(function ($product) {
            return ['price' => $product->price];
        });
    }
}
