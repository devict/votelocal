<?php

namespace App;

use LinkFinder;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

class ScheduledMessage extends Model
{
    protected $fillable = [
        'body_en', 'body_es', 'send_at', 'sent',
    ];

    protected $dates = [
        'send_at',
    ];

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public static function scopeReadyToSend($query)
    {
        return $query->where('sent', false)->where('send_at', '<=', Carbon::now());
    }

    public static function scopeSent($query)
    {
        return $query->where('sent', true);
    }

    public function getHtmlAttribute()
    {
        $key = 'body_'.App::getLocale();
        if (! array_key_exists($key, $this->attributes)) {
            $key = 'body_en';
        }

        return (new LinkFinder)->process($this->attributes[$key]);
    }
}
