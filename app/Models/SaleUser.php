<?php

namespace App\Models;

use App\Models\Tenant\UserRole;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleUser extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;
    const USER_INACTIVE = 0;
    const USER_ACTIVE = 1;
    const ROLE_ADMIN = 1;
    const ROLE_MODERATOR = 2;
    const ROLE_MEMBER = 3;
    const ROLE_GUEST = 4;
    const USER_INAUTH = 0;
    const USER_AUTH = 1;

    protected $table = 'sale_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email', 'password', 'is_active', 'expired_at', 'role_id', 'is_auth', 'profile_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function getAuthPassword()
    {
        return Hash::make($this->password);
    }

    /**
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
    public function getUSERID()
    {
        return $this->id;
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Companies::class, 't_sale_company', 'sale_user_id', 'company_id');
    }

}
