@extends('layouts.backend')

@section('title', __('Booking Request'))

@section('content')
<!-- main Section -->
<div class="main-body">
	<div class="container-fluid">
		@php $vipc = vipc(); @endphp
		@if($vipc['bkey'] == 0) 
		@include('backend.partials.vipc')
		@else
		<div class="row mt-25">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-lg-6">
								<span>{{ __('Booking Request') }}</span>
							</div>
						</div>
					</div>
					<!--Data grid-->
					<div class="card-body">
						<div id="tp_datalist">
							@include('backend.partials.booking_request_table')
						</div>
					</div>
					<!--/Data grid/-->
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
<!-- /main Section -->
@endsection

@push('scripts')
<!-- css/js -->
<link rel="stylesheet" href="{{asset('public/backend/bootstrap-datetimepicker/bootstrap-fonticon.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/bootstrap-datetimepicker/bootstrap-datetimepicker.css')}}">
<script src="{{asset('public/backend/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>

<script type="text/javascript">
var TEXT = [];
	TEXT['Do you really want to edit this record'] = "{{ __('Do you really want to edit this record') }}";
	TEXT['Do you really want to delete this record'] = "{{ __('Do you really want to delete this record') }}";
	TEXT['Do you really want to delete this records'] = "{{ __('Do you really want to delete this records') }}";
	TEXT['Please select action'] = "{{ __('Please select action') }}";
	TEXT['Please select record'] = "{{ __('Please select record') }}";
	TEXT['All Category'] = "{{ __('All Category') }}";
$(function () {
	"use strict";
	$("#start_date").datetimepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		todayBtn: true,
		minView: 2
	});

	$("#end_date").datetimepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		todayBtn: true,
		minView: 2
	});
});
</script>
<script src="{{asset('public/backend/pages/booking_request.js')}}"></script>
@endpush