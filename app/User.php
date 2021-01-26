<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const TABLE_NAME = 'user';

    const ATTR_ID              = 'id';
    const ATTR_NAME            = 'name';
    const ATTR_PHONE           = 'phone';
    const ATTR_PHONE_VERIFY_AT = 'phone_verified_at';
    const ATTR_EMAIL           = 'email';
    const ATTR_EMAIL_VERIFY_AT = 'email_verify_at';
    const ATTR_IMAGE           = 'image';
    const ATTR_ROLE            = 'role';
    const ATTR_PASSWORD        = 'password';
    const ATTR_ADDRESS         = 'address';
    const ATTR_REMEMBER_TOKEN  = 'remember_token';
    const ATTR_CREATED_AT      = 'created_at';
    const ATTR_UPDATED_AT      = 'updated_at';

    const ROLE_ADMIN    = 2;
    const ROLE_DELIVERY = 1;
    const ROLE_USER     = 0;

    protected $table = self::TABLE_NAME;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $guarded = [
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];
}
