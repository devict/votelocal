<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ScheduledMessage extends Model
{
    protected $fillable = [
        'body', 'send_at', 'sent',
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
}
