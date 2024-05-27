@extends('layouts.backend')

@section('title', __('All Booking'))

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
								<span>{{ __('All Booking') }}</span>
							</div>
						</div>
					</div>
					<!--Data grid-->
					<div class="card-body">
						<div id="tp_datalist">
							@include('backend.partials.all_booking_table')
						</div>
					</div>
					<!--/Data grid/-->
				</div>
			</div>
		</div>
		@endif
	</div>
</div>

<!-- Check Out modal -->
<div id="CheckOutModalView" class="modal bd-example-modal-md">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">{{ __('Check Out') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body media-content">
				<div class="container-fluid">
					<form novalidate="" data-validate="parsley" id="DataEntry_formId">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="payment_status_id">{{ __('Payment Status') }}<span class="red">*</span></label>
									<select name="payment_status_id" id="payment_status_id" class="chosen-select form-control">
									@foreach($payment_status_list as $row)
									<option value="{{ $row->id }}">
										{{ $row->pstatus_name }}
									</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="booking_status_id">{{ __('Booking Status') }}<span class="red">*</span></label>
									<select name="booking_status_id" id="booking_status_id" class="chosen-select form-control">
									@foreach($booking_status_list as $row)
									<option value="{{ $row->id }}">
										{{ $row->bstatus_name }}
									</option>
									@endforeach
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12">
								<input class="dnone" id="booking_id" name="booking_id" type="text"/>
								<a id="SubmitBookingCheckOutForm" href="javascript:void(0);" class="btn btn-theme update_btn">{{ __('Update') }}</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/Check Out modal/-->

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
<script src="{{asset('public/backend/pages/all_booking.js')}}"></script>
@endpush