<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketBooking extends Model
{
    public $table = "ticket_bookings";
    use HasFactory;

    public $fillable = [
        'order_id',
        'ticket_id',
        'user_id',
        'is_master',
        'age_group',
        'name',
        'email',
        'country_code',
        'mobile',
        'country',
        'festival_dates',
        'state',
        'ticket_price',
        'status',
        'created_at',
        'updated_at',
    ];

    public function tickets()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'unique_order_id', 'order_id');
    }
}
