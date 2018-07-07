<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /*
     * Signs in a user or creates a new one and signs it in.
     *
     * @param mixed $attributes User attributes or user model
     */
    protected function signIn($attributes = [])
    {
        $namespace = config('auth.providers.users.model');

        if ($attributes instanceof $namespace) {
            $this->actingAs($attributes);

            return $this;
        }

        $this->actingAs(create($namespace, $attributes));

        return $this;
    }

    protected function assertAdminOnly($method, $url)
    {
        $this->{$method}($url, [])
            ->assertRedirect(route('login'));
        $this->signIn()->{$method}($url)
            ->assertRedirect('/');
    }
}
