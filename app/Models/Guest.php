<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use DB;

class Guest extends Model
{
    use HasFactory;
    use Authenticatable;
    public $fillable = [
        'user_type',
        'unique_code',
        'emp_code',
       'adult_1',
       'adult_2',
       'spouse',
       'guest1_name',
       'guest2_name',
       'guest3_name',
       'kid_1',
       'kid_2',
       'kid1_name',
       'kid2_name',

    ];
  

}
