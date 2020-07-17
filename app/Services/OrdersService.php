<?php

namespace App\Services;

use App\Repositories\OrdersRepository;
use App\Models\Status;
use App\Models\Product;
use Exception;

class OrdersService
{
    private $ordersRepository;

    public function __construct()
    {
        $this->ordersRepository = new OrdersRepository();
    }

    public function listOrders()
    {
        $orders = $this->ordersRepository->index();

        if ($orders->count() == 0) {
            throw new Exception('Orders not found');
        }

        return $orders;
    }

    public function findOrderById($id)
    {
        $order = $this->ordersRepository->findById($id);

        return $order;
    }

    public function createOrder($orderData)
    {
        $status = Status::find($orderData->status_id);

        if ($status->count() == 0) {
            throw new Exception('Status not found');
        }

        $order = $this->ordersRepository->create($status);

        return $order;
    }

    public function saveOrderProducts($id, $productsId)
    {
        $products = Product::findMany($productsId);

        $order = $this->ordersRepository->save($id, $products);

        return $order;
    }

    public function UpdateStatusOrder($id)
    {
        $status = Status::find(2);

        if ($status->count() == 0) {
            throw new Exception('Status not found');
        }

        $order = $this->ordersRepository->update($id, $status);

        return $order;
    }
}
