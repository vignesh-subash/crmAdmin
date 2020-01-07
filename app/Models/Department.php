<?php
/**
 * Model generated using CrmAdmin
 * Help: http://crmadmin.com
 * CrmAdmin is open-sourced software licensed under the MIT license.
 * Developed by: Kipl IT Solutions
 * Developer Website: http://kipl.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

	protected $table = 'departments';

	protected $hidden = [

    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
}
