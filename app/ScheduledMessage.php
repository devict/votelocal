<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use LinkFinder;

class ScheduledMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'body_en', 'body_es', 'send_at', 'sent', 'target_sms', 'target_twitter',
    ];

    protected $dates = [
        'send_at',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function locationTags()
    {
        return $this->tags()->where('category', 'location');
    }

    public function topicTags()
    {
        return $this->tags()->where('category', 'topic');
    }

    public function hasTag($tag)
    {
        return $this->tags()->where('tag_id', $tag->id)->exists();
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

    public function sanitizeBody()
    {
        $this->body_en = gsmSanitize($this->body_en);
        $this->body_es = gsmSanitize($this->body_es);
        $this->save();
    }
}

function gsmSanitize($in)
{
    return str_replace(['—', '-', '–'], '-', $in);
}
