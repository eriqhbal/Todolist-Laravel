<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertFalse;

class UserServiceProviderTest extends TestCase
{
    private UserService $userService;

    public function setUp(): void {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample() {
        self::assertTrue(true);
    }

    public function testCorrectPassword() {
        self::assertTrue($this->userService->login("Zuleriqhbal", "rahasia"));
    }

    public function testNotFoundUser() {
        self::assertFalse($this->userService->login("hendri", "rahasia"));
    }

    public function testWrongPassword() {
        self::assertFalse($this->userService->login("Zuleriqhbal", "kecolong"));
    }
}
