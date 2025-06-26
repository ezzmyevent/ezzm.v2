<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInterface extends Model
{
    use HasFactory;

    public $table = "user_interfaces";
    
    protected $fillable = [
        'sequence',
        'name',
        'category',
        'festival_dates',
        'is_image_required',
        'type',
        'status',
        'created',
        'modified'
    ];
}
