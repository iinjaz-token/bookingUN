@extends('layouts.backend')

@section('title', __('Price'))

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
								{{ __('Price') }}
							</div>
							<div class="col-lg-6">
								<div class="float-right">
									<a href="{{ route('backend.room-type') }}" class="btn warning-btn"><i class="fa fa-reply"></i> {{ __('Back to List') }}</a>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body tabs-area p-0">
						@include('backend.partials.room_tabs_nav')
						<div class="tabs-body">
							<!--Data Entry Form-->
							<form novalidate="" data-validate="parsley" id="DataEntry_formId">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="price">{{ __('Price') }}<span class="red">*</span></label>
											<input value="{{ $datalist['price'] }}" name="price" id="price" type="text" class="form-control parsley-validated" data-required="true">
										</div>
									</div>
								</div>
								<input value="{{ $datalist['id'] }}" type="text" name="RecordId" id="RecordId" class="dnone">
								<div class="row tabs-footer mt-15">
									<div class="col-lg-12">
										<a id="submit-form" href="javascript:void(0);" class="btn blue-btn">{{ __('Save') }}</a>
									</div>
								</div>
							</form>
							<!--/Data Entry Form/-->
						</div>
					</div>
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
<script src="{{asset('public/backend/pages/price.js')}}"></script>
@endpush