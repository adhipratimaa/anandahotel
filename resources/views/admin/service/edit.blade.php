@extends('layouts.admin')	
@section('title','Edit Service')
@push('admin.styles')
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css">
<!-- bootstrap wysihtml5 - text editor -->
@endpush
@section('content')
<section class="content-header">
	<h1>Service<small>edit</small></h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">Service</a></li>
		<li><a href="">Edit </a></li>
	</ol>
</section>
<div class="content">
	@if (count($errors) > 0)
	<div class="alert alert-danger message">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      		<span aria-hidden="true">&times;</span>
    	</button>
		<ul>
			@foreach($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif
<form method="post" action="{{route('service.update',$detail->id)}}" enctype="multipart/form-data">
	{{csrf_field()}}
	<input type="hidden" name="_method" value="PUT">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-primary">
				<div class="box-header with-heading">
					<h3 class="box-title">Edit Service</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Title(required)</label>
						<input type="text" name="title" class="form-control" value="{{$detail->title}}">
					</div>

					<div class="form-group">
						<label>Slug</label>
						<input type="text" name="slug" class="form-control" value="{{$detail->slug}}">
					</div>
					
					
					<div class="form-group">
						<label>Description(required)</label>
						<textarea id="my-editor" name="description" class="form-control">{{$detail->description}}</textarea>
					</div>

					 <div class="form-group">
						<label>Category</label>
		    	 			<select type="text" name="category" class="form-control">
		    	 				<!-- (condition ) ? 'dtaa' : 'failed data'  ternery operator-->
		    	 				<option value="packages" {{ ( @$detail->category == 'packages') ? "selected" : ''}}>Packages</option>
								<option value="dining" {{ ( @$detail->category == 'dining') ? "selected" : ''}}>Dining</option>
								<option value="meeting_and_conference" {{ ( @$detail->category == 'meeting_and_conference') ? "selected" : ''}}>Meeting and Conference</option>
								<option value="none" {{ ( @$detail->category == 'none') ? "selected" : ''}}>None</option>
							</select>
						 
							
					</div>
					<div class="form-group">
						<label for="show_in_menu"><input type="checkbox" id="show_in_menu" name="show_in_menu" {{$detail->show_in_menu==1?'checked':''}}>Show as primary menu?</label>
				    </div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-warning">
				<div class="box-header with-heading">
					<h3 class="box-title">Image</h3>
				</div>
				<!-- <div class="box-body">
					<div class="form-group">
					   <label>logo(250*250)</label>
					   <input type="file" name="logo" class="form-control">
					   @if($detail->logo)
					   <img src="{{asset('images/main/'.$detail->logo)}}">
					   @endif
					</div>
				</div> -->
				<div class="box-body">
					<div class="form-group">
					   <label>Upload Image(2000*2000)</label>
					   <input type="file" name="image" class="form-control">
					   @if($detail->image)
					   <img src="{{asset('images/listing/'.$detail->image)}}">
					   @endif
					</div>
				</div>
			</div>
			<div class="box box-warning">
				<div class="box-header with-heading">
					<h3 class="box-title">Publish</h3>
				</div>
				<div class="box-body">
					
					
					<div class="form-group">
						<label for="publish"><input type="checkbox" id="publish" name="publish" {{$detail->publish==1?'checked':''}}> Publish</label>
				    </div>
				    <div class="form-group">
				    	<input type="submit" name="" class="btn btn-success">
				    </div>
				</div>
			</div>
		</div>
	</div>
</form>
</div>
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <!-- CK Editor -->
  <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
  <!-- datepicker -->
  <script>
  	var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
    CKEDITOR.replace('my-editor', options);
    CKEDITOR.config.height = 200;
  	
  	$('.message').delay(5000).fadeOut(400);
    </script>
@endpush