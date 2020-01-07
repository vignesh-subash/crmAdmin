<?php
/**
 * Controller generated using CrmAdmin
 * Help: http://crmadmin.com
 * CrmAdmin is open-sourced software licensed under the MIT license.
 * Developed by: Kipl IT Solutions
 * Developer Website: http://kipl.com
 */

namespace App\Http\Controllers\CA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Kipl\Crmadmin\Models\Module;
use Kipl\Crmadmin\Models\ModuleFields;

use App\Models\Employee;

class EmployeesController extends Controller
{
    public $show_action = true;

    /**
     * Display a listing of the Employees.
     *
     * @return mixed
     */
    public function index()
    {
        $module = Module::get('Employees');

        if(Module::hasAccess($module->id)) {
            return View('ca.employees.index', [
                'show_actions' => $this->show_action,
                'listing_cols' => Module::getListingColumns('Employees'),
                'module' => $module
            ]);
        } else {
            return redirect(config('crmadmin.adminRoute') . "/");
        }
    }

    /**
     * Show the form for creating a new employee.
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created employee in database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if(Module::hasAccess("Employees", "create")) {

            $rules = Module::validateRules("Employees", $request);

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $insert_id = Module::insert("Employees", $request);

            return redirect()->route(config('crmadmin.adminRoute') . '.employees.index');

        } else {
            return redirect(config('crmadmin.adminRoute') . "/");
        }
    }

    /**
     * Display the specified employee.
     *
     * @param int $id employee ID
     * @return mixed
     */
    public function show($id)
    {
        if(Module::hasAccess("Employees", "view")) {

            $employee = Employee::find($id);
            if(isset($employee->id)) {
                $module = Module::get('Employees');
                $module->row = $employee;

                return view('ca.employees.show', [
                    'module' => $module,
                    'view_col' => $module->view_col,
                    'no_header' => true,
                    'no_padding' => "no-padding"
                ])->with('employee', $employee);
            } else {
                return view('errors.404', [
                    'record_id' => $id,
                    'record_name' => ucfirst("employee"),
                ]);
            }
        } else {
            return redirect(config('crmadmin.adminRoute') . "/");
        }
    }

    /**
     * Show the form for editing the specified employee.
     *
     * @param int $id employee ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        if(Module::hasAccess("Employees", "edit")) {
            $employee = Employee::find($id);
            if(isset($employee->id)) {
                $module = Module::get('Employees');

                $module->row = $employee;

                return view('ca.employees.edit', [
                    'module' => $module,
                    'view_col' => $module->view_col,
                ])->with('employee', $employee);
            } else {
                return view('errors.404', [
                    'record_id' => $id,
                    'record_name' => ucfirst("employee"),
                ]);
            }
        } else {
            return redirect(config('crmadmin.adminRoute') . "/");
        }
    }

    /**
     * Update the specified employee in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id employee ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if(Module::hasAccess("Employees", "edit")) {

            $rules = Module::validateRules("Employees", $request, true);

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();;
            }

            $insert_id = Module::updateRow("Employees", $request, $id);

            return redirect()->route(config('crmadmin.adminRoute') . '.employees.index');

        } else {
            return redirect(config('crmadmin.adminRoute') . "/");
        }
    }

    /**
     * Remove the specified employee from storage.
     *
     * @param int $id employee ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if(Module::hasAccess("Employees", "delete")) {
            Employee::find($id)->delete();

            // Redirecting to index() method
            return redirect()->route(config('crmadmin.adminRoute') . '.employees.index');
        } else {
            return redirect(config('crmadmin.adminRoute') . "/");
        }
    }

    /**
     * Server side Datatable fetch via Ajax
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function dtajax(Request $request)
    {
        $module = Module::get('Employees');
        $listing_cols = Module::getListingColumns('Employees');

        $values = DB::table('employees')->select($listing_cols)->whereNull('deleted_at');
        $out = Datatables::of($values)->make();
        $data = $out->getData();

        $fields_popup = ModuleFields::getModuleFields('Employees');

        for($i = 0; $i < count($data->data); $i++) {
            for($j = 0; $j < count($listing_cols); $j++) {
                $col = $listing_cols[$j];
                if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
                    $data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
                }
                if($col == $module->view_col) {
                    $data->data[$i][$j] = '<a href="' . url(config('crmadmin.adminRoute') . '/employees/' . $data->data[$i][0]) . '">' . $data->data[$i][$j] . '</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }

            if($this->show_action) {
                $output = '';
                if(Module::hasAccess("Employees", "edit")) {
                    $output .= '<a href="' . url(config('crmadmin.adminRoute') . '/employees/' . $data->data[$i][0] . '/edit') . '" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                }

                if(Module::hasAccess("Employees", "delete")) {
                    $output .= Form::open(['route' => [config('crmadmin.adminRoute') . '.employees.destroy', $data->data[$i][0]], 'method' => 'delete', 'style' => 'display:inline']);
                    $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                    $output .= Form::close();
                }
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
