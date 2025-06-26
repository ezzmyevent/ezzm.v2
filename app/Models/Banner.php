<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use DB;

class Banner extends Model
{
    public $table = "banners";

    use HasFactory;
    use Authenticatable;
    public $fillable = [
        'event_id', 
        'name',
        'url',
    ];
}