<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Uniquecode extends Model
{
   
    //use HasFactory;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    public $table = "online_registration_unique_codes";
    protected $fillable = [
        'unique_code',
        'is_used',
    ];

}
