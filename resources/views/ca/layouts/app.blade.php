<!DOCTYPE html>
<html lang="en">

@section('htmlheader')
	@include('ca.layouts.partials.htmlheader')
@show
<body class="{{ CAConfigs::getByKey('skin') }} {{ CAConfigs::getByKey('layout') }} @if(CAConfigs::getByKey('layout') == 'sidebar-mini') sidebar-collapse @endif" bsurl="{{ url('') }}" adminRoute="{{ config('crmadmin.adminRoute') }}">
<div class="wrapper">

	@include('ca.layouts.partials.mainheader')

	@if(CAConfigs::getByKey('layout') != 'layout-top-nav')
		@include('ca.layouts.partials.sidebar')
	@endif

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		@if(CAConfigs::getByKey('layout') == 'layout-top-nav') <div class="container"> @endif
		@if(!isset($no_header))
			@include('ca.layouts.partials.contentheader')
		@endif

		<!-- Main content -->
		<section class="content {{ $no_padding or '' }}">
			<!-- Your Page Content Here -->
			@yield('main-content')
		</section><!-- /.content -->

		@if(CAConfigs::getByKey('layout') == 'layout-top-nav') </div> @endif
	</div><!-- /.content-wrapper -->

	@include('ca.layouts.partials.controlsidebar')

	@include('ca.layouts.partials.footer')

</div><!-- ./wrapper -->

@include('ca.layouts.partials.file_manager')

@section('scripts')
	@include('ca.layouts.partials.scripts')
@show

</body>
</html>
