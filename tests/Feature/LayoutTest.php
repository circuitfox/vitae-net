<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LayoutTest extends TestCase
{
    use RefreshDatabase;

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
        $response->assertSee('<a class="navbar-brand" href="' . url('/') . '">Vitae NET</a>');
        $response_nologin->assertSee('<a class="navbar-brand" href="' . url('/') . '">Vitae NET</a>');
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
        $response->assertSee('<a class="navbar-link" href="' . url('/users/' . $user->id . '/edit') . '">Settings</a>');
        $response->assertSee('<a class="navbar-link" href="' . url('/home') . '">' . $this->faker_escape($user->name) . '</a>');
        $response->assertSee('<a class="navbar-link" href="' . url('/logout') . '">Logout</a>');
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

    public function testHasLinksAuthed()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertSee('<li><a href="' . url('/patients') . '">Patients</a></li>');
        $response->assertSee('<li><a href="' . url('/orders') . '">Orders</a></li>');
        $response->assertSee('<li><a href="' . url('/labs') . '">Labs</a></li>');
        $response->assertSee('<li><a href="' . url('/medications') . '">Medications</a></li>');
        $response->assertSee('<li><a href="' . url('/medication') . '">Scan Medication</a></li>');
    }

    public function testHasLinks()
    {
        $response = $this->get('/');
        $response->assertDontSee('<li><a href="' . url('/patients') . '">Patients</a></li>');
        $response->assertDontSee('<li><a href="' . url('/orders') . '">Orders</a></li>');
        $response->assertDontSee('<li><a href="' . url('/labs') . '">Labs</a></li>');
        $response->assertDontSee('<li><a href="' . url('/medications') . '">Medications</a></li>');
        $response->assertSee('<li><a href="' . url('/medication') . '">Scan Medication</a></li>');
    }
}
