@extends('layouts.frontend')

@section('title', $data->title)
@php $gtext = gtext(); @endphp

@section('meta-content')
	<meta name="keywords" content="{{ $data->og_keywords }}" />
	<meta name="description" content="{{ $data->og_description }}" />
	<meta property="og:title" content="{{ $data->og_title ? $data->og_title : $data->title }}" />
	<meta property="og:site_name" content="{{ $gtext['site_name'] }}" />
	<meta property="og:description" content="{{ $data->og_description }}" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="{{ url()->current() }}" />
	<meta property="og:image" content="{{ $data->og_image ? asset('public/media/'.$data->og_image) : asset('public/media/'.$data->thumbnail) }}" />
	<meta property="og:image:width" content="600" />
	<meta property="og:image:height" content="315" />
	@if($gtext['fb_publish'] == 1)
	<meta name="fb:app_id" property="fb:app_id" content="{{ $gtext['fb_app_id'] }}" />
	@endif
	<meta name="twitter:card" content="summary_large_image">
	@if($gtext['twitter_publish'] == 1)
	<meta name="twitter:site" content="{{ $gtext['twitter_id'] }}">
	<meta name="twitter:creator" content="{{ $gtext['twitter_id'] }}">
	@endif
	<meta name="twitter:url" content="{{ url()->current() }}">
	<meta name="twitter:title" content="{{ $data->og_title ? $data->og_title : $data->title }}">
	<meta name="twitter:description" content="{{ $data->og_description }}">
	<meta name="twitter:image" content="{{ $data->og_image ? asset('public/media/'.$data->og_image) : asset('public/media/'.$data->thumbnail) }}">
@endsection

@section('header')
@include('frontend.partials.header')
@endsection

@section('content')
<main class="main">
	<!-- Page Breadcrumb -->
	<section class="breadcrumb-section" style="background-image:  url({{ $data->thumbnail ? asset('public/media/'.$data->thumbnail) : asset('public/frontend/images/breadcrumb_bg.jpg') }});">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="breadcrumb-card">
						<h2>{{ $data->title }}</h2>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
								<li class="breadcrumb-item active" aria-current="page">{{ $data->title }}</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /Page Breadcrumb/ -->
@endsection

@push('scripts')

@endpush	