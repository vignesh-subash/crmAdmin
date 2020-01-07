@extends("ca.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('crmadmin.adminRoute') . '/organizations') }}">Organization</a> :
@endsection
@section("contentheader_description", $organization->$view_col)
@section("section", "Organizations")
@section("section_url", url(config('crmadmin.adminRoute') . '/organizations'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Organizations Edit : ".$organization->$view_col)

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

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($organization, ['route' => [config('crmadmin.adminRoute') . '.organizations.update', $organization->id ], 'method'=>'PUT', 'id' => 'organization-edit-form']) !!}
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
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <a href="{{ url(config('crmadmin.adminRoute') . '/organizations') }}" class="btn btn-default pull-right">Cancel</a>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#organization-edit-form").validate({
		
	});
});
</script>
@endpush
