<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    protected $fillable = [
        'name', 'email', 'password','avatar_path','confirmation_token', 'confirmed'
    ];
     

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'confirmed'=>'boolean'
    ];

    public function threads()
    {
        return $this->hasMany(Thread::class)->latest();
    }

    public function lastReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function read($thread)
    {
        cache()->forever($this->visitedThreadCacheKey($thread), Carbon::now());

    }


    public function visitedThreadCacheKey($thread)
    {
        return sprintf("users.%s.visits.%s", $this->id, $thread->id);

    }

    public function getAvatarPathAttribute($avatar)
    {
        return asset($avatar ? '/storage/'.$avatar : '/storage/avatars/default.jpg');
       // return asset($this->avatar_path ? '/storage/'.$this->avatar_path : '/storage/avatars/default.jpg');
        // if(!$this->avatar_path)
        // {
        //     return 'avatars/default.jpg';
        // }
        // return $this->avatar_path;
    }

    //umesto roles table metod ukoliko postoji samo nekoliko administrator

    public function isAdmin()
    {
        return in_array($this->name,['marijana']);
    }
}
