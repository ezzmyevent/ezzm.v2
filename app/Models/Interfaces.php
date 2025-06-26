<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interfaces extends Model
{
    public $table = "user_interfaces";

    use HasFactory;

    public $fillable = [
        'sequence', 
        'name', 
        'category',
        'festival_dates',
        'status',
        'created',
        'modified'
    ];
}
