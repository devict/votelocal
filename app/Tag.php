<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    protected $fillable = [
        'name', 'category', 'default'
    ];

    public static function categoryOptions()
    {
        return [
            'location' => 'Location',
            'topic' => 'Topic',
        ];
    }
}
