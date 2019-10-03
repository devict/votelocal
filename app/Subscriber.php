<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'subscribed', 'locale',
    ];

    public function messages()
    {
        return $this->hasMany('App\Message', 'subscriber_number', 'number');
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
