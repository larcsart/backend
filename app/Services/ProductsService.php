<?php

namespace App\Services;

use App\Repositories\ProductsRepository;
use Exception;

class ProductsService
{
    private $productsRepository;

    public function __construct()
    {
        $this->productsRepository = new ProductsRepository();
    }

    public function listProducts()
    {
        $products = $this->productsRepository->index();

        if ($products->count() == 0) {
            throw new Exception('Products not found');
        }

        return $products;
    }

    public function createProduct($productData)
    {
        $productData->name = str_replace(',','.',$productData->name);
        $productData->price = str_replace(',','.',$productData->price);
        $productData->weight = str_replace(',','.',$productData->weight);

        $productExist = $this->productsRepository->findByName(
            $productData->name
        );

        if ($productExist->count()) {
            throw new Exception('Product exist');
        }

        $product = $this->productsRepository->create($productData);

        return $product;
    }
}
