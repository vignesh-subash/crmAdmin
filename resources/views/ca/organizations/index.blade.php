@extends("ca.layouts.app")

@section("contentheader_title", "Organizations")
@section("contentheader_description", "Organizations listing")
@section("section", "Organizations")
@section("sub_section", "Listing")
@section("htmlheader_title", "Organizations Listing")

@section("headerElems")
@ca_access("Organizations", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Organization</button>
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

@ca_access("Organizations", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Organization</h4>
			</div>
			{!! Form::open(['action' => 'CA\OrganizationsController@store', 'id' => 'organization-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @ca_form($module)
					
					{{--
					@ca_input($module, 'name')
					@ca_input($module, 'email')
					@ca_input($module, 'phone')
					@ca_input($module, 'website')
					@ca_input($module, 'assigned_to')
					@ca_input($module, 'connected_since')
					@ca_input($module, 'address')
					@ca_input($module, 'city')
					@ca_input($module, 'description')
					@ca_input($module, 'profile_image')
					@ca_input($module, 'profile')
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
        ajax: "{{ url(config('crmadmin.adminRoute') . '/organization_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#organization-add-form").validate({
		
	});
});
</script>
@endpush
