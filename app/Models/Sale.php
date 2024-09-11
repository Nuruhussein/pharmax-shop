<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
 protected $fillable = ['medicine_id', 'quantity', 'sale_price', 'sale_date'];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

}
