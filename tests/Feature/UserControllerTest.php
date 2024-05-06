<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testRouteLogin() {
      $this->get('/login')
           ->assertSeeText('Login');
    }

    public function testSuccessLogin() {
      $this->post('/login', [
         'user' => 'Zuleriqhbal',
         'password' => 'rahasia'
      ])->assertRedirect('/')
        ->assertSessionHas('user', 'Zuleriqhbal');
    }

    public function testLoginPageForMember() {
      $this->withSession([
        'user' => 'Zuleriqhbal'
      ])->get('/login')
        ->assertRedirect('/');
    }

    public function testLoginForUserAlreadyLogin() {
      $this->withSession([
        'user' => 'Zuleriqhbal'
      ])->post('/login', [
        'user' => 'Zuleriqhbal',
        'password' => "rahasia"
      ])
        ->assertRedirect('/');
    }

    public function testfailedLogin() {
      $this->post('/login', [
         'user' => 'hendri',
         'password' => 'rahasia'
      ])->assertSeeText('user or password is wrong!');
    }

    public function testIfEmpty() {
      $this->post('/login')
           ->assertSeeText("username or password cannot be empty");
    }

    public function testLogout() {
      $this->withSession([
        'user' => 'Zuleriqhbal'
      ])->post('/logout')
        ->assertRedirect('/')
        ->assertSessionMissing('user');
    }

    public function testGuestLogout() {
      $this->post('/logout')
           ->assertRedirect('/login');
    }
}
