<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'category', 'default'
    ];

    public function subscribers()
    {
        return $this->morphByMany('App\Subscriber', 'taggable');
    }

    public function scheduledMessages()
    {
        return $this->morphedByMany('App\ScheduledMessage', 'taggable');
    }
}
