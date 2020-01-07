<?php
/**
 * Migration generated using CrmAdmin
 * Help: http://crmadmin.com
 * CrmAdmin is open-sourced software licensed under the MIT license.
 * Developed by: Kipl IT Solutions
 * Developer Website: http://kipl.com
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ca_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 50);
			$table->string('section', 100)->default("");
            $table->string('value', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ca_configs');
    }
}
