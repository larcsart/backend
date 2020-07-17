<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;

class OrdersRepository
{
    private $modelOrder;

    public function __construct()
    {
        $this->modelOrder = new Order();
    }

    public function index()
    {
        $data = Order::with('products')->with('status')->get();

        return $data;
    }

    public function findById($id)
    {
        $data = Order::where('id', $id)
            ->with('products')
            ->with('status')
            ->first();

        return $data;
    }

    public function create($status)
    {
        $model = new Order();

        $model->status_id = $status->id;

        $model->save();

        return $model;
    }

    public function save($id, $products)
    {
        $order = Order::find($id);

        foreach ($products as $key => $product) {
            $order->products()->attach($product);
        }

        return Order::where('id', $id)
            ->with('status')
            ->with('products')
            ->first();
    }

    public function update($id, $status)
    {
        $model = Order::find($id);

        $model->status_id = $status->id;

        $model->save();

        return $model;
    }
}
