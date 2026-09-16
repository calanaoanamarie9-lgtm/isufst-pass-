<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Boot the application and hard-stop if the test suite is pointed at
     * anything other than an in-memory SQLite database.
     *
     * RefreshDatabase runs migrate:fresh on the configured connection, so tests
     * against live PostgreSQL would DESTROY the database. This guard makes that
     * impossible (e.g. if bootstrap/cache/config.php was cached with pgsql).
     */
    public function createApplication(): \Illuminate\Foundation\Application
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();

        $connection = $app['config']->get('database.default');
        $database = $app['config']->get('database.connections.'.$connection.'.database');

        if ($connection !== 'sqlite' || $database !== ':memory:') {
            fwrite(STDERR, "\n[ABORT] Tests must run on sqlite :memory:, got {$connection}:{$database}.\n");
            fwrite(STDERR, "Run `php artisan config:clear` if a stale config cache is set.\n\n");
            exit(1);
        }

        return $app;
    }
}