<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'category', 'subscriber_default', 'message_default',
    ];

    public static function categoryOptions()
    {
        return [
            'location' => 'Location',
            'topic' => 'Topic',
        ];
    }

    public static function scopeLocations($query)
    {
        return $query->where('category', 'location');
    }

    public static function scopeTopics($query)
    {
        return $query->where('category', 'topic');
    }

    public static function scopeSubscriberDefaults($query)
    {
        return $query->where('subscriber_default', true);
    }

    public static function scopeMessageDefaults($query)
    {
        return $query->where('message_default', true);
    }

    public static function validateRequiredTags($ids)
    {
        // Validates at least one tag is selected per category.
        if (!$ids) return false;
        $cats = self::select('category')->distinct()->whereIn('id', $ids)->get();
        return $cats->count() == count(self::categoryOptions());
    }
}
