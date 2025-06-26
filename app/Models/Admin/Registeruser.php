<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Registeruser extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    public $fillable = [
        'role', 
        'name', 
        'phone',
        'country_code',
        'country',
        'state',
        'city',
        'gender',
        'email', 
        'festival_dates',
        'ticket_category',
        'password',
        'total_log',
        'quantity',
        'lastLogin',
        'user_token',
        'unique_code',
        'qrcode_path',
        'eticket_path',
        'remember_token',
        'current_log'
    ];

    public function userMember()
    {
        return $this->hasMany(UserMember::class, 'user_id');
    }

    public function setFestival_datesAttribute($value)
    {
        $this->attributes['festival_dates'] = json_encode($value);
    }

    public function getFestival_datesAttribute($value)
    {
        return $this->attributes['festival_dates'] = json_decode($value);
    }


    function getRecord($uid)
    {
        return User::where('id', '!=' ,$uid)->where('current_log', 1)->get();        
    }
}
