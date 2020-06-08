<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Subscriber extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'subscribed', 'locale', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function username()
    {
        return 'number';
    }

    public function messages()
    {
        return $this->hasMany('App\Message', 'subscriber_number', 'number');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function subscribe()
    {
        return $this->update(['subscribed' => true]);
    }

    public function unsubscribe()
    {
        return $this->update(['subscribed' => false]);
    }

    public static function scopeNewThisWeek($query)
    {
        return $query->where('created_at', '>', Carbon::now()->subDays(7));
    }
}
