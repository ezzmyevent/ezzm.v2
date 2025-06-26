<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    public $fillable = [
        'user_type',
        'category',
        'name',
        'email',
        'phone',
        'company',
        'designation',
        'unique_code',
        'qrcode_path',
        'eticket_path',
        'status',
        'email_send',
        'emp_code',
        'lead_name',
        'otp', // Add this line
        'otp_status', // Add this line
       'otp_expires_at', // Add this line
       'event_status',
       'attendees',
       'guest1_name',
       'guest2_name',
       'guest3_name',
       'kid1_name',
       'kid2_name',
       'kid_1',
       'kid_2',
       'adult_1',
       'adult_2',
       'spouse',
      'is_printed',
       'attendees',
       'is_printed_adult_1',
       'is_printed_adult_2',
       'is_printed_adult_3',
       'is_printed_kid_2',
       'is_printed_kid_1'
    ];

    function getUserCount($phone)
    {
        $user_data = User::where('phone',$phone)->where('status', 1)->get();
        $user_count = count($user_data);
        return $user_count;
    }

    function getUserRecord($phone)
    {
        return User::where('phone', $phone)->where('status', 1)->first();        
    }
}
