<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use DB;

class Country extends Model
{
    use HasFactory;
    use Authenticatable;
    public $fillable = [
        'sortname', 
        'name',
        'phonecode'
    ];


    function getCountry()
    {
        $countries = DB::table('countries')->get();
        return $countries;
    }

}
