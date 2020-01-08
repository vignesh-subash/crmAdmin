@extends("ca.layouts.app")

@section("contentheader_title", "Employees")
@section("contentheader_description", "Employees listing")
@section("section", "Employees")
@section("sub_section", "Listing")
@section("htmlheader_title", "Employees Listing")

@section("headerElems")
@ca_access("Employees", "create")
    <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Employee</button>
@endca_access
@endsection

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-success">
    <!--<div class="box-header"></div>-->
    <div class="box-body">
        <table id="example1" class="table table-bordered">
        <thead>
        <tr class="success">
            @foreach( $listing_cols as $col )
            <th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
            @endforeach
            @if($show_actions)
            <th>Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>

        </tbody>
        </table>
    </div>
</div>

@ca_access("Employees", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Employee</h4>
            </div>
            {!! Form::open(['action' => 'CA\EmployeesController@store', 'id' => 'employee-add-form']) !!}
            <div class="modal-body">
                <div class="box-body">
                    @ca_form($module)

                    {{--
                    @ca_input($module, 'name')
          					@ca_input($module, 'designation')
          					@ca_input($module, 'gender')
          					@ca_input($module, 'mobile')
          					@ca_input($module, 'mobile2')
          					@ca_input($module, 'email')
          					@ca_input($module, 'dept')
          					@ca_input($module, 'city')
          					@ca_input($module, 'address')
          					@ca_input($module, 'about')
          					@ca_input($module, 'date_birth')
          					@ca_input($module, 'date_hire')
          					@ca_input($module, 'date_left')
          					@ca_input($module, 'salary_cur')
                    --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endca_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('ca-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('ca-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
    $("#example1").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url(config('crmadmin.adminRoute') . '/employee_dt_ajax') }}",
        language: {
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search"
        },
        @if($show_actions)
        columnDefs: [ { orderable: false, targets: [-1] }],
        @endif
    });
    $("#employee-add-form").validate({

    });
});
</script>
@endpush
