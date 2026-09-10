<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * One-time-use migration runner.
 *
 * Visit /migrate?key=YOUR_MIGRATE_KEY to apply pending migrations.
 * Set MIGRATE_KEY in your .env (and as a Render environment variable)
 * to something long and secret. Safe to leave in place since migrate()
 * skips any migration that has already been applied.
 */
class MigrateController extends Controller {

    public function run()
    {
        $expected = getenv('MIGRATE_KEY');
        $provided = $_GET['key'] ?? '';

        if (empty($expected) || !hash_equals($expected, $provided)) {
            http_response_code(403);
            echo 'Forbidden.';
            return;
        }

        echo '<pre>';
        $migration = $this->call->library('migration');
        $migration->migrate();
        echo '</pre>';
    }
}
