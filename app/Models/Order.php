<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = "orders";
    use HasFactory;

    public $fillable = [
        'transection_id', 
        'payment_option', 
        'payment_data',
        'user_id',
        'coupon_id',
        'discount_by_coupon',
        'ticket_qty',
        'taxes',
        'total', 
        'tickets_sold',
        'due',
        'description',
        'unique_order_id',
        'status',
        'date_only',
        'time_only',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'created_at',
        'updated_at',
    ];
}
