<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ScheduledMessage extends Model
{
    protected $fillable = [
        'body', 'send_at', 'sent',
    ];

    public function getSendAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public static function scopeReadyToSend($query)
    {
        return $query->where('sent', false)->where('send_at', '<=', Carbon::now());
    }
}
