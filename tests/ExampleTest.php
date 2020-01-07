<?php
/**
 * Code generated using CrmAdmin
 * Help: http://crmadmin.com
 * CrmAdmin is open-sourced software licensed under the MIT license.
 * Developed by: KiplIT Solutions
 * Developer Website: http://dwijitsolutions.com
 */

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
	use DatabaseMigrations;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
		$this->artisan('db:seed');

        $this->visit('/')
             ->see('CrmAdmin');
    }
}
