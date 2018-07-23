<?php

namespace App\Repository\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AdminUser.
 *
 * @package namespace App\Repository\Models;
 */
class AdminUser extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','email','password','status','is_super','created_at','updated_at','user_id'];
    protected $appends  = ['user_id'];
    protected $hidden   = ['id'];

    /**
     *
     * */
    public static function boot() {
        self::creating(function ($user) {
            $user->password = md5($user->password);
        });
//        self::updated(function ($user) {
//            $user->password = md5($user->password);
//        });
        parent::boot(); // TODO: Change the autogenerated stub
    }

    /**
     *
     * */
    public function getUserIdAttribute($val){
        return $this->id;
    }
    /**
     * 判断用户是否具有某个角色
     * */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }
    /**
     * 判断用户是否具有某权限
     * */
    public function hasPermission($permission)
    {
        return $this->hasRole($permission->roles);
    }
    /**
     * 给用户分配角色
     * */
    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }


    /**
     *
     * */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
