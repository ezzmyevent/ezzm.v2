<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Cities extends Model
{
    use HasFactory;
    use Authenticatable;
    public $fillable = [
        'name', 
        'state_id'
    ];
}
