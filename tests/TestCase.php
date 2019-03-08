<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->makeDependencies();

    }

    private function makeDependencies()
    {
        $this->artisan('config:clear');
        $this->artisan('migrate:fresh --env=testing');
        $this->artisan('passport:install --env=testing');
        $this->artisan('db:seed --env=testing');
    }

}
