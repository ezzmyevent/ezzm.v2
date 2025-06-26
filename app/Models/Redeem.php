<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Redeem extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    public $fillable = [
        'user_id',
        'created_at',
        'updated_at',
    ];
}


