<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'subscribed', 'locale',
    ];

    public function messages()
    {
        return $this->hasMany('App\Message', 'subscriber_number', 'number');
    }
}
