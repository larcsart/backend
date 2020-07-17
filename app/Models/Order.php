<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Status;

class Order extends Model
{
    protected $table      = 'orders';
    protected $primaryKey = 'id';

    public $fillable = [
        'status',
    ];

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'orders_products',
            'orders_id',
            'products_id'
        );
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
