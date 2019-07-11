<?php

namespace App\Modules\User\Entities;

use App\Ship\Abstraction\AbstractEntity;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends AbstractEntity implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
    use HasApiTokens, Notifiable;

    static public $is_supper_admin = 1;
    static public $is_gym = 2;
    static public $is_user = 3;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type'
    ];

    /**
     * Encrypt password before creating
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * @param string $type
     * @return int
     */

    public static function getUserType(string $type) :int
    {
        if($type == 'user') {
            return self::$is_user;
        }

        if($type == 'gym') {
            return self::$is_gym;
        }

        if($type == 'supper_admin') {
            return self::$is_supper_admin;
        }
    }

    public static function getAdmin()
    {
        return self::find(1);
    }
}
