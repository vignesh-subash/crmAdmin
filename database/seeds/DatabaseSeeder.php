<?php

use Illuminate\Database\Seeder;

use Kipl\Crmadmin\Models\Module;
use Kipl\Crmadmin\Models\ModuleFields;
use Kipl\Crmadmin\Models\ModuleFieldTypes;
use Kipl\Crmadmin\Models\Menu;
use Kipl\Crmadmin\Models\CAConfigs;

use App\Role;
use App\Permission;
use App\Models\Department;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		/* ================ LaraAdmin Seeder Code ================ */

		// Generating Module Menus
		$modules = Module::all();
		$teamMenu = Menu::create([
			"name" => "Team",
			"url" => "#",
			"icon" => "fa-group",
			"type" => 'custom',
			"parent" => 0,
			"hierarchy" => 1
		]);
		foreach ($modules as $module) {
			$parent = 0;
			if($module->name != "Backups") {
				if(in_array($module->name, ["Users", "Departments", "Employees", "Roles", "Permissions"])) {
					$parent = $teamMenu->id;
				}
				Menu::create([
					"name" => $module->name,
					"url" => $module->name_db,
					"icon" => $module->fa_icon,
					"type" => 'module',
					"parent" => $parent
				]);
			}
		}

		// Create Administration Department
	   	$dept = new Department;
		$dept->name = "Administration";
		$dept->tags = "[]";
		$dept->color = "#000";
		$dept->save();

		// Create Super Admin Role
		$role = new Role;
		$role->name = "SUPER_ADMIN";
		$role->display_name = "Super Admin";
		$role->description = "Full Access Role";
		$role->parent = 1;
		$role->dept = $dept->id;
		$role->save();

		// Set Full Access For Super Admin Role
		foreach ($modules as $module) {
			Module::setDefaultRoleAccess($module->id, $role->id, "full");
		}

		// Create Admin Panel Permission
		$perm = new Permission;
		$perm->name = "ADMIN_PANEL";
		$perm->display_name = "Admin Panel";
		$perm->description = "Admin Panel Permission";
		$perm->save();

		$role->attachPermission($perm);

		// Generate CRM Admin Default Configurations

		$caconfig = new CAConfigs;
		$caconfig->key = "sitename";
		$caconfig->value = "CRM Admin 1.0";
		$caconfig->save();

		$caconfig = new CAConfigs;
		$caconfig->key = "sitename_part1";
		$caconfig->value = "crm";
		$caconfig->save();

		$caconfig = new CAConfigs;
		$caconfig->key = "sitename_part2";
		$caconfig->value = "Admin 1.0";
		$caconfig->save();

		$caconfig = new CAConfigs;
		$caconfig->key = "sitename_short";
		$caconfig->value = "CRMA";
		$caconfig->save();

		$caconfig = new CAConfigs;
		$caconfig->key = "site_description";
		$caconfig->value = "CRM Admin is a open-source Laravel Admin Panel for quick-start Admin based applications and boilerplate for CRM or CMS systems.";
		$caconfig->save();

		// Display Configurations

		$caconfig = new CAConfigs;
		$caconfig->key = "sidebar_search";
		$caconfig->value = "1";
		$caconfig->save();

		$caconfig = new CAConfigs;
		$caconfig->key = "show_messages";
		$caconfig->value = "1";
		$caconfig->save();

		$caconfig = new CAConfigs;
		$caconfig->key = "show_notifications";
		$caconfig->value = "1";
		$caconfig->save();

		$laconfig = new CAConfigs;
		$laconfig->key = "show_tasks";
		$laconfig->value = "1";
		$laconfig->save();

		$caconfig = new CAConfigs;
		$caconfig->key = "show_rightsidebar";
		$caconfig->value = "1";
		$caconfig->save();

		$caconfig = new CAConfigs;
		$caconfig->key = "skin";
		$caconfig->value = "skin-white";
		$caconfig->save();

		$laconfig = new CAConfigs;
		$laconfig->key = "layout";
		$laconfig->value = "fixed";
		$laconfig->save();

		// Admin Configurations

		$caconfig = new CAConfigs;
		$caconfig->key = "default_email";
		$caconfig->value = "test@example.com";
		$caconfig->save();

		$modules = Module::all();
		foreach ($modules as $module) {
			$module->is_gen=true;
			$module->save();
		}
	}
}
