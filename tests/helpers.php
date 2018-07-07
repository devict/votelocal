<?php

if (! function_exists('create')) {
    function create($class, $attributes = [], $times = null)
    {
        return factory($class, $times)->create($attributes);
    }
}

if (! function_exists('make')) {
    function make($class, $attributes = [], $times = null)
    {
        return factory($class, $times)->make($attributes);
    }
}
