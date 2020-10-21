<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAuth extends Model
{
    use HasFactory;
    protected $table = 'emailauth';
    protected $dates = [
        'expiration_at'
    ];

    protected $fillable = [
        'id', 'authcode', 'email', 'password_tmp', 'sale_user_id', 'authpurpose', 'expiration_at'
    ];
}
