<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function assertAdminOnly($method, $url)
    {
        $this->{$method}($url, [])
            ->assertRedirect(route('login'));
        $this->be(User::factory()->create())->{$method}($url)
            ->assertRedirect('/');
    }
}
