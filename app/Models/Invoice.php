<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['sale_id', 'total_amount', 'invoice_date'];
    use HasFactory;
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
