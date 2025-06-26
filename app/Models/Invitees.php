<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitees extends Model
{
    public $table = "invitees";

    protected $parentColumn = 'parent_id';
    
    protected $fillable = [
        'user_id',
        'parent_id',
        'user_interface_id',
        'interface_category',
        'qty',
        'remaining_qty',
        'name',
        'email',
        'countryCode',
        'phone',
        'status',
        'access_token',
        'created_at',
        'updated_at'
    ];

    public function parent()
    {
        return $this->belongsTo(Invitees::class, $this->parentColumn);
    }
    
    public function children()
    {
        return $this->hasMany(Invitees::class, $this->parentColumn);
    }

    public function interfaceUser()
    {
        return $this->hasMany(InterfaceUserRegistrations::class, 'user_id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function access_token()
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $access_token = substr(str_shuffle($str_result), 0, 20);
        $exist = Invitees::where('access_token', $access_token)->count();
        if($exist == 0) {
            return $access_token;    
        }
        Invitees::access_token();
    }
}
