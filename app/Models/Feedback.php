<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Feedback extends Model implements AuthenticatableContract
{
    public $table = "feedback";
    
    use HasFactory;
    use Authenticatable;
    public $fillable = [
        'name',
        'company_name',
        'designation',
        'mobile_no',
        'email',
        'feed_1',
        'feed_2',
        'feed_3',
        'feed_4',
        'feed_5',
        'feed_6',
        'feed_7',
        'feed_8',
    ];
}
