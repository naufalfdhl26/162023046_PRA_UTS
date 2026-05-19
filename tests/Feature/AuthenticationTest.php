<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_page_returns_ok()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    /** @test */
    public function google_redirect_route_redirects()
    {
        $response = $this->get(route('google.redirect'));
        $response->assertStatus(302);
    }

    /** @test */
    public function register_page_returns_ok()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }
}
