<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'order_code', 'status', 'total_amount'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function calculateTotal()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }
}
