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
        return $this->belongsTo(Subscriber::class, 'subscriber_number', 'number');
    }

    /*
     * Get the locale of the message if it's body is a trigger word.
     */
    public function getLocaleFromTrigger($key)
    {
        foreach (config('voteict.locales') as $locale) {
            if ($this->hasTrigger($key, $locale)) {
                return $locale;
            }
        }

        return null;
    }

    /*
     * Check if message matches a trigger word.
     */
    public function hasTrigger($key, $locale = null)
    {
        $triggers = [];

        if ($locale) {
            $triggers = app('translator')->get('triggers.'.$key, [], $locale);
        } else {
            // Collect triggers for all locales.
            foreach (config('voteict.locales') as $locale) {
                $ts = app('translator')->get('triggers.'.$key, [], $locale);
                foreach ($ts as $t) {
                    $triggers[] = $t;
                }
            }
        }

        return in_array($this->normalizedBody(), $triggers);
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
