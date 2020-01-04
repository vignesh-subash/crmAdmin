<?php

/* ================== Homepage ================== */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'CA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Kipl\Crmadmin\Helpers\CAHelper::laravel_ver() == 5.5) {
	$as = config('crmadmin.adminRoute').'.';

	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => 'admin.', 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {

	/* ================== Dashboard ================== */

	Route::get(config('crmadmin.adminRoute'), 'CA\DashboardController@index');
	Route::get(config('crmadmin.adminRoute'). '/dashboard', 'CA\DashboardController@index');

	/* ================== Users ================== */
	Route::resource(config('crmadmin.adminRoute') . '/users', 'CA\UsersController');
	Route::get(config('crmadmin.adminRoute') . '/user_dt_ajax', 'CA\UsersController@dtajax');

	/* ================== Uploads ================== */
	Route::resource(config('crmadmin.adminRoute') . '/uploads', 'CA\UploadsController');
	Route::post(config('crmadmin.adminRoute') . '/upload_files', 'CA\UploadsController@upload_files');
	Route::get(config('crmadmin.adminRoute') . '/uploaded_files', 'CA\UploadsController@uploaded_files');
	Route::post(config('crmadmin.adminRoute') . '/uploads_update_caption', 'CA\UploadsController@update_caption');
	Route::post(config('crmadmin.adminRoute') . '/uploads_update_filename', 'CA\UploadsController@update_filename');
	Route::post(config('crmadmin.adminRoute') . '/uploads_update_public', 'CA\UploadsController@update_public');
	Route::post(config('crmadmin.adminRoute') . '/uploads_delete_file', 'CA\UploadsController@delete_file');

	/* ================== Roles ================== */
	Route::resource(config('crmadmin.adminRoute') . '/roles', 'CA\RolesController');
	Route::get(config('crmadmin.adminRoute') . '/role_dt_ajax', 'CA\RolesController@dtajax');
	Route::post(config('crmadmin.adminRoute') . '/save_module_role_permissions/{id}', 'CA\RolesController@save_module_role_permissions');

	/* ================== Permissions ================== */
	Route::resource(config('crmadmin.adminRoute') . '/permissions', 'CA\PermissionsController');
	Route::get(config('crmadmin.adminRoute') . '/permission_dt_ajax', 'CA\PermissionsController@dtajax');
	Route::post(config('crmadmin.adminRoute') . '/save_permissions/{id}', 'CA\PermissionsController@save_permissions');

	/* ================== Departments ================== */
	Route::resource(config('crmadmin.adminRoute') . '/departments', 'CA\DepartmentsController');
	Route::get(config('crmadmin.adminRoute') . '/department_dt_ajax', 'CA\DepartmentsController@dtajax');

	/* ================== Employees ================== */
	Route::resource(config('crmadmin.adminRoute') . '/employees', 'CA\EmployeesController');
	Route::get(config('crmadmin.adminRoute') . '/employee_dt_ajax', 'CA\EmployeesController@dtajax');
	Route::post(config('crmadmin.adminRoute') . '/change_password/{id}', 'CA\EmployeesController@change_password');

	/* ================== Organizations ================== */
	Route::resource(config('crmadmin.adminRoute') . '/organizations', 'CA\OrganizationsController');
	Route::get(config('crmadmin.adminRoute') . '/organization_dt_ajax', 'CA\OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('crmadmin.adminRoute') . '/backups', 'CA\BackupsController');
	Route::get(config('crmadmin.adminRoute') . '/backup_dt_ajax', 'CA\BackupsController@dtajax');
	Route::post(config('crmadmin.adminRoute') . '/create_backup_ajax', 'CA\BackupsController@create_backup_ajax');
	Route::get(config('crmadmin.adminRoute') . '/downloadBackup/{id}', 'CA\BackupsController@downloadBackup');
});
