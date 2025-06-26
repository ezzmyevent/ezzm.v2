<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $table = "tickets";
    use HasFactory;
    public $fillable = [
        'event_id', 
        'name', 
        'category',
        'slug',
        'description',
        'price',
        'ages_6_and_below',
        'ages_7_to_11',
        'ages_12_to_17',
        'min_qty',
        'max_qty',
        'day_qty',
        'status',
        'created_at',
        'updated_at'
    ];

    function getTicketRecord($id)
    {
        return Ticket::where('id', $id)->where('status', 1)->first();        
    }
}
