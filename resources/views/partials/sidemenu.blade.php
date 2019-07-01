	<!-- START SIDEBAR -->
	<section class="sidebar">
		<div class="brand-logo">
		<a href="{{ url('/') }}">Application</a>
		</div>

		<!-- start sidebar navigation -->
		<ul class="sidebar-navigation">
			<li class="active">
				<a href="{{ url('/') }}"><i aria-hidden="true" class="fa fa-dashboard"></i> Dashboard</a>
			</li>
			
			
			@if(Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
			<li class="custom-dropdown">
				<a href="{{ route('products.index') }}">Tests</a>

				<ul class="sidebar-submenu">
					<li><a href="{{ route('products.index') }}">All tests</a></li>
					<li><a href="{{ route('product_categories.index') }}">Categories</a></li>
				</ul>
			</li>
			@endif


			@if(Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
			<li class="custom-dropdown">
				<a href="{{ route('doctors.index') }}">Doctors</a>

				<ul class="sidebar-submenu">
					<li><a href="{{ route('doctors.index') }}">All Doctors</a></li>
					<li><a href="{{ route('doctors.create') }}">Add New</a></li>
				</ul>
			</li>
			@endif
			
			@if(Auth::user()->role !== 'employee' )
			<li class="custom-dropdown">
				<a href="{{ route('doctors.index') }}">Reports</a>
				<ul class="sidebar-submenu">
					<li><a href="{{ route('sells.index') }}">Sell Reports</a></li>
					<li><a href="{{ route('slip.index') }}">Test Reports</a></li>
				</ul>
			</li>
			@endif
			
			<li class="custom-dropdown">
				<a href="{{ route('sells.create') }}">Sell Now</a>
			</li>
			
			
			<li class="collapse_menu">
				<button type="button" class="collapse_button"><i aria-hidden="true" class="fa fa-toggle-off"></i> Collapse menu</button>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR END -->