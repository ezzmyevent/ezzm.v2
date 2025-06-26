<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use DB;

class Coupon extends Model
{
    use HasFactory;
    use Authenticatable;
    public $fillable = [
        'name',
        'ticket_id',
        'description',
        'code',
        'coupon_type',
        'amount',
        'starting_at',
        'ending_at',
        'status',
        'created_at',
        'update_at'
    ];


    function getCountry()
    {
        $countries = DB::table('countries')->get();
        return $countries;
    }

}
