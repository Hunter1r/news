<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone','description'];

    public function getOrders() {
        return Order::all();
    }

    public function getOrderById($id) {
       return Order::where('id', '=', $id)->get();
    }
}