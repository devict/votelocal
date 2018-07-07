<?php

namespace App;

use App\Filters\MessageFilters;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    const INCOMING = 'incoming';
    const OUTGOING = 'outgoing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'to', 'from', 'body', 'twilio_sid', 'subscriber_number', 'incoming',
    ];

    public function subscriber()
    {
        return $this->belongsTo('App\Subscriber', 'subscriber_number', 'number');
    }

    /**
     * Apply filters.
     */
    public function scopeFilter($query, MessageFilters $filters)
    {
        return $filters->apply($query);
    }
}
