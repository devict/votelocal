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
}
