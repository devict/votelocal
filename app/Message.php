<?php

namespace App;

use App\Filters\MessageFilters;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    const INCOMING = 'incoming';
    const OUTGOING = 'outgoing';

    /**
     * SMS trigger words.
     *
     * @var array
     */
    protected $triggers = [
        'subscribe'   => ['subscribe', 'start'],
        'unsubscribe' => ['unsubscribe', 'stop']
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'to',
        'from',
        'body',
        'twilio_sid',
        'subscriber_number',
        'incoming',
        'scheduled_message_id',
    ];

    public function subscriber()
    {
        return $this->belongsTo('App\Subscriber', 'subscriber_number', 'number');
    }

    /*
     * Check if message matches a trigger word.
     */
    public function hasTrigger($key)
    {
        if (! array_key_exists($key, $this->triggers)) {
            return false;
        }

        return in_array($this->normalizedBody(), $this->triggers[$key]);
    }

    /*
     * Clean up the message text.
     */
    public function normalizedBody()
    {
        return strtolower(trim($this->body));
    }

    /**
     * Apply filters.
     */
    public function scopeFilter($query, MessageFilters $filters)
    {
        return $filters->apply($query);
    }
}
