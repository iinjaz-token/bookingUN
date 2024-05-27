@extends('layouts.backend')

@section('title', __('Slider/Hero Section'))

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
								<span>{{ __('Slider/Hero Section') }}</span>
							</div>
							<div class="col-lg-6">
								<div class="float-right">
									<a onClick="onFormPanel()" href="javascript:void(0);" class="btn blue-btn btn-form float-right"><i class="fa fa-plus"></i> {{ __('Add New') }}</a>
									<a onClick="onListPanel()" href="javascript:void(0);" class="btn warning-btn btn-list float-right dnone"><i class="fa fa-reply"></i> {{ __('Back to List') }}</a>
								</div>
							</div>
						</div>
					</div>
						<div id="tp_datalist">
							@include('backend.partials.slider_table')
						</div>
					</div>
					<!--/Data grid/-->
					<!--Data Entry Form-->
					<div id="form-panel" class="card-body dnone">
						<form novalidate="" data-validate="parsley" id="DataEntry_formId">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="slider_type">{{ __('Manage Page') }}<span class="red">*</span></label>
										<select name="slider_type" id="slider_type" class="chosen-select form-control">
											<option value="home_1">Home Page 1</option>
										</select>
									</div>
								</div>
								<div class="col-md-9"></div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="slider_title">{{ __('Title') }}<span class="red">*</span></label>
										<input type="text" name="slider_title" id="slider_title" class="form-control parsley-validated" data-required="true">
									</div>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="slider_image">{{ __('Thumbnail Image') }}<span class="red">*</span></label>
										<div class="tp-upload-field">
											<input type="text" name="image" id="slider_image" class="form-control" readonly>
											<a id="on_slider_image" href="javascript:void(0);" class="tp-upload-btn"><i class="fa fa-window-restore"></i>{{ __('Browse') }}</a>
										</div>
										<em>Recommended image size width: 1000px and height: 675px.</em>
										<div id="remove_slider_image" class="select-image">
											<div class="inner-image" id="view_slider_image"></div>
											<a onClick="onMediaImageRemove('slider_image')" class="media-image-remove" href="javascript:void(0);"><i class="fa fa-remove"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="is_publish">{{ __('Status') }}<span class="red">*</span></label>
										<select name="is_publish" id="is_publish" class="chosen-select form-control">
										@foreach($statuslist as $row)
											<option value="{{ $row->id }}">
												{{ $row->status }}
											</option>
										@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-8"></div>
							</div>
							
							<input type="text" name="RecordId" id="RecordId" class="dnone">
							<div class="row tabs-footer mt-15">
								<div class="col-lg-12">
									<a id="submit-form" href="javascript:void(0);" class="btn blue-btn mr-10">{{ __('Save') }}</a>
								</div>
							</div>
						</form>
					</div>
					<!--/Data Entry Form/-->
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
<!-- /main Section -->

<!--Global Media-->
@include('backend.partials.global_media')
<!--/Global Media/-->

@endsection

@push('scripts')
<!-- css/js -->
<script type="text/javascript">
var media_type = 'Thumbnail';
var TEXT = [];
	TEXT['Do you really want to edit this record'] = "{{ __('Do you really want to edit this record') }}";
	TEXT['Do you really want to delete this record'] = "{{ __('Do you really want to delete this record') }}";
	TEXT['Do you really want to publish this records'] = "{{ __('Do you really want to publish this records') }}";
	TEXT['Do you really want to draft this records'] = "{{ __('Do you really want to draft this records') }}";
	TEXT['Do you really want to delete this records'] = "{{ __('Do you really want to delete this records') }}";
	TEXT['Please select action'] = "{{ __('Please select action') }}";
	TEXT['Please select record'] = "{{ __('Please select record') }}";
</script>
<script src="{{asset('public/backend/pages/slider.js')}}"></script>
<script src="{{asset('public/backend/pages/global-media.js')}}"></script>
@endpush