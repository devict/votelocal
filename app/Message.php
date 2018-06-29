<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * the attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'to', 'from', 'body', 'twilio_sid', 'incoming',
    ];
}
