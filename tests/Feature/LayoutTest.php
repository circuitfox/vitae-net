<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LayoutTest extends TestCase
{
    use DatabaseMigrations;

    public function testHasMetaTags()
    {
        $response = $this->get('/');
        $response->assertSee('<meta charset="UTF-8">');
        $response->assertSee('<meta http-equiv="X-UA-Compatible" content="IE=edge">');
        $response->assertSee('<meta name="viewport" content="width=device-width, initial-scale=1">');
        $response->assertSee('<meta name="csrf-token" content="' . csrf_token() . '">');
    }

    public function testHasAssets()
    {
        $response = $this->get('/');
        $response->assertSee('<link rel="stylesheet" href="' . asset("css/app.css") . '">');
        $response->assertSee('<script src="' . asset("js/app.js") . '">');
    }

    public function testCommonNavbar()
    {
        $response = $this->get('/');
        $response_nologin = $this->get('/login');
        $response->assertSee('<nav class="navbar navbar-default">');
        $response_nologin->assertSee('<nav class="navbar navbar-default">');
        $response->assertSee('<a class="navbar-brand" href="' . url('/') . '">Medscanner</a>');
        $response_nologin->assertSee('<a class="navbar-brand" href="' . url('/') . '">Medscanner</a>');
    }

    public function testHasLogin()
    {
        $response = $this->get('/');
        $response->assertSee(
            '<form class="navbar-form navbar-right" id="login-form" action="' .
            route('login') .
            '" method="POST">'
        );
    }

    public function testHasLoginAuthed()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertDontSee(
            '<form class="navbar-form navbar-right" id="login-form" action="' .
            route('login') .
            '" method="POST">'
        );
        $response->assertSee('<a href="/admin">' . $user->name . '</a>');
    }

    public function testHasNoLogin()
    {
        $response = $this->get('/login');
        $response->assertDontSee(
            '<form class="navbar-form navbar-right" id="login-form" action="' .
            route('login') .
            '" method="POST">'
        );
    }
}
