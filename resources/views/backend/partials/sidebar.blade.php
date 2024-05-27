<div class="sidebar-wrapper">
	<div class="logo">
		<a href="{{ route('backend.dashboard') }}">
		<img src="{{ asset('public/frontend/images/logo.png') }}" alt="Logo" />
		</a>
	</div>
	<ul class="left-navbar">
		@if (Auth::user()->role_id == 1)
		<li><a href="{{ route('backend.dashboard') }}"><i class="fa fa-tachometer"></i>{{ __('Dashboard') }}</a></li>
		<li class="dropdown"><a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fa fa-rocket"></i>{{ __('Booking Manage') }}</a>
			<ul class="dropdown-menu">
				<li><a href="{{ route('backend.booking-request') }}">{{ __('Booking Request') }}</a></li>
				<li><a href="{{ route('backend.book-room') }}">{{ __('Book Room') }}</a></li>
				<li><a href="{{ route('backend.all-booking') }}">{{ __('All Booking') }}</a></li>
			</ul>
		</li>
		<li><a href="{{ route('backend.room-list') }}"><i class="fa fa-braille"></i>{{ __('Room List') }}</a></li>
		<li class="dropdown"><a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fa fa-bed"></i>{{ __('Hotel Manage') }}</a>
			<ul class="dropdown-menu">
				<li><a href="{{ route('backend.room-type') }}">{{ __('Room Type') }}</a></li>
				<li><a href="{{ route('backend.categories') }}">{{ __('Categories') }}</a></li>
				<li><a href="{{ route('backend.amenities') }}">{{ __('Amenities') }}</a></li>
				<li><a href="{{ route('backend.complements') }}">{{ __('Complements') }}</a></li>
				<li><a href="{{ route('backend.bed-types') }}">{{ __('Bed Types') }}</a></li>
			</ul>
		</li>

		<li class="dropdown"><a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fa fa-pencil-square-o"></i>{{ __('Home Page Manage') }}</a>
			<ul class="dropdown-menu">
				<li><a href="{{ route('backend.slider') }}">{{ __('Slider/Hero Section') }}</a></li>
			</ul>
		</li>
		<li><a href="{{ route('backend.customers') }}"><i class="fa fa-users"></i>{{ __('Customers') }}</a></li>
		<li><a href="{{ route('backend.media') }}"><i class="fa fa-picture-o"></i>{{ __('Media') }}</a></li>
		<li><a href="{{ route('backend.users') }}"><i class="fa fa-user-plus"></i>{{ __('Users') }}</a></li>
		@elseif (Auth::user()->role_id == 3)
		<li><a href="{{ route('receptionist.dashboard') }}"><i class="fa fa-tachometer"></i>{{ __('Dashboard') }}</a></li>
		<li><a href="{{ route('receptionist.room-list') }}"><i class="fa fa-braille"></i>{{ __('Room List') }}</a></li>
		<li class="dropdown"><a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fa fa-rocket"></i>{{ __('Booking Manage') }}</a>
			<ul class="dropdown-menu">
				<li><a href="{{ route('receptionist.booking-request') }}">{{ __('Booking Request') }}</a></li>
				<li><a href="{{ route('receptionist.book-room') }}">{{ __('Book Room') }}</a></li>
				<li><a href="{{ route('receptionist.all-booking') }}">{{ __('All Booking') }}</a></li>
			</ul>
		</li>
		<li><a href="{{ route('receptionist.profile') }}"><i class="fa fa-user"></i>{{ __('Profile') }}</a></li>
		<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('receptionist-logout-form').submit();"><i class="fa fa-sign-out"></i>{{ __('Logout') }}</a></li>
		<form id="receptionist-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
			@csrf
		</form>
		@endif
	</ul>
</div>