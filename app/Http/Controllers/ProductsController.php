<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Exception;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $productsService;

    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    public function index()
    {
        try {
            $products = $this->productsService->listProducts();

            return response()->json([
                'data' => $products,
                'status' => true
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'status' => false
            ], 400);
        }

        return response()->json(['error' => 'data not found'], 400);
    }

    public function create(Request $request)
    {
        $product = (object) $request->all();

        try {
            $savedProduct = $this->productsService->createProduct($product);

            return response()->json([
                'data' => $savedProduct,
                'status' => true
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'status' => false
            ], 400);
        }
    }
}
