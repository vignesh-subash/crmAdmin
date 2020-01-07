<!-- Main Header -->
<header class="main-header">

	@if(CAConfigs::getByKey('layout') != 'layout-top-nav')
	<!-- Logo -->
	<a href="{{ url(config('crmadmin.adminRoute')) }}" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>{{ CAConfigs::getByKey('sitename_short') }}</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>{{ CAConfigs::getByKey('sitename_part1') }}</b>
		 {{ CAConfigs::getByKey('sitename_part2') }}</span>
	</a>
	@endif

	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top" role="navigation">
	@if(CAConfigs::getByKey('layout') == 'layout-top-nav')
		<div class="container">
			<div class="navbar-header">
				<a href="{{ url(config('crmadmin.adminRoute')) }}" class="navbar-brand"><b>{{ CAConfigs::getByKey('sitename_part1') }}</b>{{ CAConfigs::getByKey('sitename_part2') }}</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<i class="fa fa-bars"></i>
				</button>
			</div>
			@include('ca.layouts.partials.top_nav_menu')
			@include('ca.layouts.partials.notifs')
		</div><!-- /.container-fluid -->
	@else
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle b-l" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		@include('ca.layouts.partials.notifs')
	@endif
	
	</nav>
</header>
