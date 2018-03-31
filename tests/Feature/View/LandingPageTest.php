<?php

namespace Tests\Feature\View;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LandingPageTest extends TestCase
{

    function testRedirectToLogin()
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    function testHasLogin()
    {
        $response = $this->get('/login');
        $response->assertSee('<div class="panel panel-default">');
        $response->assertSee('<div class="panel-heading">Login</div>');
        $response->assertSee('<form class="form-horizontal" method="POST" action="' . route('login') . '">');
        $response->assertSee('<label for="password" class="col-md-4 control-label">Password</label>');
        $response->assertSee('<input id="password" type="password" class="form-control" name="password" required>');
        $response->assertSee('<div class="checkbox">');
        $response->assertSee('<input type="checkbox" name="remember" > Remember Me');
        $response->assertSee('<button type="submit" class="btn btn-primary">');
        $response->assertSee('<a class="btn btn-link" href="' . route('password.request') . '">');
    }
}
