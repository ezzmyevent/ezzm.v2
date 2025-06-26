<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class InterfaceUserRegistrations extends Model
{
    public $table = "interface_user_registrations";
    
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invitee_id',
        'user_interface_id',
        'category',
        'name',
        'email',
        'countryCode',
        'phone',
        'gender',
        'state',
        'city',
        'company',
        'festival_dates',
        'unique_code',
        'qrcode_path',
        'eticket_path',
    ];

    public function userInterfaces()
    {
        return $this->belongsTo(UserInterface::class, 'user_interface_id');
    }

    public function invitedBy()
    {
        return $this->belongsTo(Invitees::class, 'invitee_id');
    }

    public function unique_code()
    {
        $unique_code = DB::table('interface_registration_unique_codes')->where('is_used', 0)->first();
        DB::table('interface_registration_unique_codes')->where('id', $unique_code->id)->update(['is_used' => 1, 'modified' => Carbon::now()]);
        return $unique_code->unique_code;
        
    }
}
