<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Address\Entities\Address;
use Modules\Cart\Entities\Cart;
use Modules\Comment\Entities\Comment;
use Modules\Favorite\Entities\Favorite;
use Modules\History\Entities\History;
use Modules\Order\Entities\Order;
use Modules\Role\Entities\Role;


class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;
    const USER_LEVEL = [
        'label' => 'کاربر عادی',
        'value' => 'user'
    ];
    const ADMIN_LEVEL = [
        'label' => 'مدیر',
        'value' => 'admin'
    ];
    const LEVELS = [self::USER_LEVEL, self::ADMIN_LEVEL];

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'password',
        'level',
        'status',
        'mobile_verified_at',
        'email_verified_at',
        'last_visit',
    ];
    protected $hidden = [
        'password',
        'level'
    ];

    //region Relations :

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    //endregion Relations;
}
