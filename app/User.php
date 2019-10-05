<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }


    protected $fillable = [
        'name', 'email', 'password',
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
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->activation_token = Str::random(10);
        });
    }
    public function statuses()
    {
        return $this->hasMany('App\Status');
        // return $this->hasMany(Status::class);
    }
    public function feed()
    {
        return $this->statuses()->orderBy('id', 'DESC');
    }
    //建立粉丝和关注者多对多的关系
    public function fans() //获取粉丝
    {
        return $this->belongsToMany('App\User', 'fans', 'user_id', 'fan_id');
    }
    public function followers() //获取关注者
    {
        return $this->belongsToMany('App\User', 'fans', 'fan_id', 'user_id');
    }
    //关注某个人
    public function friend($user_ids)
    {
        $user_ids = is_array($user_ids) ?? compact('user_ids');
        return $this->followers()->sync($user_ids, false); //sync默认为false
    }
    //取消关注
    public function unfriend($user_ids)
    {
        $user_ids = is_array($user_ids) ?? compact('user_ids');
        return $this->followers()->detach($user_ids);
    }
    //是否已关注过
    public function isFriend($usr_id)
    {
        return $this->followers()->get()->contains($usr_id);  //$this->followers()->get() 相当于 $this->followers
        // return $this->followers->contains($usr_id);
    }
}
