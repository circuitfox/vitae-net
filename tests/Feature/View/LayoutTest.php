<?php

namespace Tests\Feature\View;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LayoutTest extends TestCase
{
    use RefreshDatabase;

    public function testHasMetaTags()
    {
        $response = $this->get('/login');
        $response->assertSee('<meta charset="UTF-8">');
        $response->assertSee('<meta http-equiv="X-UA-Compatible" content="IE=edge">');
        $response->assertSee('<meta name="viewport" content="width=device-width, initial-scale=1">');
        $response->assertSee('<meta name="csrf-token" content="' . csrf_token() . '">');
    }

    public function testHasAssets()
    {
        $response = $this->get('/login');
        $response->assertSee('<link rel="stylesheet" href="' . asset("css/app.css") . '">');
        $response->assertSee('<script src="' . asset("js/app.js") . '">');
    }

    public function testCommonNavbar()
    {
        $response = $this->get('/medication');
        $response_nologin = $this->get('/login');
        $response->assertSee('<nav class="navbar navbar-default">');
        $response_nologin->assertSee('<nav class="navbar navbar-default">');
        $response->assertSee('<img src="' . asset("images/logo.png") . '" alt="Vitae NET logo" height="45" />');
        $response_nologin->assertSee('<img src="' . asset("images/logo.png") . '" alt="Vitae NET logo" height="45" />');
    }

    public function testHasLogin()
    {
        $response = $this->get('/medication');
        $response->assertSee(
            '<form class="navbar-form navbar-right" id="login-form" action="' .
            route('login') .
            '" method="POST">'
        );
    }

    public function testHasLoginAuthed()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get('/patients');
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

    public function testHasLinksAsAdmin()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/patients');
        $response->assertSee('<li><a href="' . url('/patients') . '">Patients</a></li>');
        $response->assertSee('<li><a href="' . url('/orders') . '">Orders</a></li>');
        $response->assertSee('<li><a href="' . url('/labs') . '">Labs</a></li>');
        $response->assertSee('<li><a href="' . url('/medications') . '">Medications</a></li>');
        $response->assertSee('<li><a href="' . url('/medication') . '">Scan Medication</a></li>');
    }

    public function testHasLinksAsStudent()
    {
        $user = factory(\App\User::class)->states('student')->create();
        $response = $this->actingAs($user)->get('/patients');
        $response->assertSee('<li><a href="' . url('/patients') . '">Patients</a></li>');
        $response->assertDontSee('<li><a href="' . url('/orders') . '">Orders</a></li>');
        $response->assertDontSee('<li><a href="' . url('/labs') . '">Labs</a></li>');
        $response->assertDontSee('<li><a href="' . url('/medications') . '">Medications</a></li>');
        $response->assertSee('<li><a href="' . url('/medication') . '">Scan Medication</a></li>');
    }

    public function testHasLinks()
    {
        $response = $this->get('/login');
        $response->assertDontSee('<li><a href="' . url('/patients') . '">Patients</a></li>');
        $response->assertDontSee('<li><a href="' . url('/orders') . '">Orders</a></li>');
        $response->assertDontSee('<li><a href="' . url('/labs') . '">Labs</a></li>');
        $response->assertDontSee('<li><a href="' . url('/medications') . '">Medications</a></li>');
        $response->assertSee('<li><a href="' . url('/medication') . '">Scan Medication</a></li>');
    }
}
