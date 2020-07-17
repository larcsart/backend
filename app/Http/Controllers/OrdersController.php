<?php

namespace App\Http\Controllers;

use App\Services\OrdersService;
use Exception;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $ordersService;

    public function __construct(OrdersService $ordersService)
    {
        $this->ordersService = $ordersService;
    }

    public function index()
    {
        try {
            $orders = $this->ordersService->listOrders();

            return response()->json([
                'data' => $orders,
                'status' => true
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'status' => false
            ], 400);
        }

        return response()->json(['error' => 'data not found'], 400);
    }

    public function find($id)
    {
        try {
            $orders = $this->ordersService->findOrderById($id);

            return response()->json([
                'data' => $orders,
                'status' => true
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'status' => false
            ], 400);
        }

        return response()->json(['error' => 'data not found'], 400);
    }

    public function create(Request $request)
    {
        $orders = (object) $request->all();

        try {
            $savedOrder = $this->ordersService->createOrder($orders);

            return response()->json([
                'data' => $savedOrder,
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
    }

    public function save(Request $request, $id)
    {
        $productsIds = (array) $request->all();

        try {
            $savedOrder = $this->ordersService->saveOrderProducts(
                $id,
                $productsIds
            );

            return response()->json([
                'data' => $savedOrder,
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
    }

    public function update($id)
    {
        try {
            $savedOrder = $this->ordersService->UpdateStatusOrder($id);

            return response()->json([
                'data' => $savedOrder,
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
    }
}
