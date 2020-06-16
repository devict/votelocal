<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function categoryOptions()
    {
        return [
            'location' => 'Location',
            'topic' => 'Topic',
        ];
    }
}
