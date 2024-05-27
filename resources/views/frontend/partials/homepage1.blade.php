<main class="main {{ $PageVariation['home_variation'] }}">
	<!-- Hero Section -->
	@if($slider_hero_section->is_publish == 1)
	<section class="hero-section">
		@foreach ($slider as $row)
		@php $aRow = json_decode($row->desc); @endphp
		<div class="hero-screen hero-overlay" style="background-image: url({{ $row->image ? asset('public/media/'.$row->image) : '' }});">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
						<div class="hero-content">
							<h1>{{ $row->title }}</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</section>
	@endif
	<!-- /Hero Section/ -->

	
	<!-- Featured Section/ -->
	@if($featured_rooms_section->is_publish == 1)
	<section class="section featured-section">
		<div class="container">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<div class="section-heading">
						<h5>{{ __('Choose Your Rooms') }}</h5>
						<h2>{{ $featured_rooms_section->title }}</h2>
					</div>
				</div>
			</div>

			<div class="row">
				@foreach ($featured_rooms as $row)
				<div class="col-sm-12 col-md-6 col-lg-4">
					<div class="item-card">
						<div class="item-image">
							<a href="{{ route('frontend.room', [$row->id, $row->slug]) }}">
								<img src="{{ asset('public/media/'.$row->thumbnail) }}" alt="{{ $row->title }}" />
							</a>
							@if(($row->is_discount == 1) && ($row->old_price !=''))
								@php 
									$discount = number_format((($row->old_price - $row->price)*100)/$row->old_price);
								@endphp
							<span class="item-label">{{ $discount }}% {{ __('Off') }}</span>
							@endif
						</div>
						<div class="item-content">
							<div class="item-title">
								<a href="{{ route('frontend.room', [$row->id, $row->slug]) }}">{{ str_limit($row->title) }}</a>
							</div>
							<div class="pric-card">
								@if($row->price != '')
									@if($gtext['currency_position'] == 'left')
									<div class="new-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->price) }}</div>
									@else
									<div class="new-price">{{ NumberFormat($row->price) }}{{ $gtext['currency_icon'] }}</div>
									@endif
								@endif
								@if(($row->is_discount == 1) && ($row->old_price !=''))
									@if($gtext['currency_position'] == 'left')
									<div class="old-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->old_price) }}</div>
									@else
									<div class="old-price">{{ NumberFormat($row->old_price) }}{{ $gtext['currency_icon'] }}</div>
									@endif
								@endif
								<div class="per-day-night">/ {{ __('Night') }}</div>
							</div>
						</div>
						<a href="{{ route('frontend.room', [$row->id, $row->slug]) }}" class="btn theme-btn book-now-btn">{{ __('Details') }}</a>
						<ul class="item-meta">
							<li>{{ __('Adult') }} {{ $row->total_adult }}</li>
							<li>{{ __('Child') }} {{ $row->total_child }}</li>
						</ul>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif
	<!-- /Featured Section/ -->

</main>