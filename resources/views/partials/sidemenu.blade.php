	<!-- START SIDEBAR -->
	<section class="sidebar">
		<div class="brand-logo">
			<a href="/">Brand Logo</a>
		</div>

		<!-- start sidebar navigation -->
		<ul class="sidebar-navigation">
			<li class="active">
				<a href="/"><i aria-hidden="true" class="fa fa-dashboard"></i> Dashboard</a>
			</li>
			<li class="custom-dropdown">
				<a href="{{ route('products.index') }}"><i class="fa fa-product-hunt" aria-hidden="true"></i>Tests</a>

				<ul class="sidebar-submenu">
					<li><a href="{{ route('products.index') }}">All tests</a></li>
					<li><a href="{{ route('products.create') }}">Add New test</a></li>
					<li><a href="{{ route('product_categories.index') }}">Categories</a></li>
				</ul>
			</li>
			<li class="custom-dropdown">
				<a href="view-all-pages.html"><i aria-hidden="true" class="fa fa-money"></i> Sells</a>

				<ul class="sidebar-submenu">
					<li><a href="{{ route('sells.create') }}">Sells Now</a></li>
					@if(Auth::user()->role !== 'operator')
						<li><a href="{{ route('sells.index') }}">Sells Report</a></li>
					@endif
				</ul>

			</li>
			<li class="custom-dropdown">
				<a href="{{ route('doctors.index') }}"><i aria-hidden="true" class="fa fa-user"></i>Doctors</a>
				<ul class="sidebar-submenu">
					<li><a href="{{ route('doctors.index') }}">All Doctors</a></li>
					<li><a href="{{ route('doctors.create') }}">Add New Doctors</a></li>
				</ul>
			</li>
			<li class="collapse_menu">
				<button type="button" class="collapse_button"><i aria-hidden="true" class="fa fa-toggle-off"></i> Collapse menu</button>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR END -->