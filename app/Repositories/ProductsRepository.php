<?php

namespace App\Repositories;

use App\Models\Product;

class ProductsRepository
{
    private $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new Product();
    }

    public function index()
    {
        $dados = $this->modelProduct->all();

        return $dados;
    }

    public function findByName($name)
    {
        return Product::where('name', $name);
    }

    public function create($product)
    {
        $model = new Product();

        $model->name = $product->name;
        $model->price = $product->price;
        $model->weight = $product->weight;

        $model->save();

        return $model;
    }
}
