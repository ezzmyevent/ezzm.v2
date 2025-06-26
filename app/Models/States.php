<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use DB;

class States extends Model
{
    use HasFactory;
    use Authenticatable;
    public $fillable = [
        'name', 
        'country_id'
    ];


    function getState()
    {
       // $states = DB::table('states')->get();
        $states = DB::table('states')->where('country_id', 101)->get();
        return $states;
    }

}
