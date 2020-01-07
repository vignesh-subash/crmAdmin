<?php
/**
 * Code generated using CrmAdmin
 * Help: http://crmadmin.com
 * CrmAdmin is open-sourced software licensed under the MIT license.
 * Developed by: KiplIT Solutions
 * Developer Website: http://dwijitsolutions.com
 */

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
