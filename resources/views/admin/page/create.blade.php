@extends('layouts.admin')
@section('title','Add Page')
@section('content')
<section class="content-header">
	<h1>Page<small>create</small></h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">page</a></li>
		<li><a href="">Create</a></li>
	</ol>
</section>
<div class="content">
	@if (count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif
<form method="post" action="{{route('page.store')}}" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="row">
		<div class="col-md-8">
			<div class="box box-primary">
				<div class="box-header with-heading">
					<h3 class="box-title">Add a new page</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Title(required)</label>
						<input type="text" name="title" class="form-control" value="{{old('title')}}">
					</div>
					<div class="form-group">
						<label>Type</label>
						<select name="type" class="form-control">
							<option value="about">About Us</option>
							<option value="difference">Make A Difference</option>
						</select>
					</div>
					<div class="form-group">
						<label>Slug</label>
						<input type="text" name="slug" class="form-control" value="{{old('slug')}}">
					</div>
					<div class="form-group">
						<label>Short Description</label>
						<textarea class="form-control" name="short_description" rows="3">{{old('short_description')}}</textarea>
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="description" rows="3">{{old('description')}}</textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-warning">
				<div class="box-header with-heading">
					<h3 class="box-title">SEO</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
					   <label>Meta Title(required)</label>
					   <input type="text" name="meta_title" class="form-control" value="{{old('meta_title')}}">
					</div>
					<div class="form-group">
					   <label>Meta Description(required)</label>
					   <textarea class="form-control" name="meta_description" rows="3">{{old('meta_desciription')}}</textarea>
					</div>
				</div>
			</div>
			<div class="box box-warning">
				<div class="box-header with-heading">
					<h3 class="box-title">Image</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
					   <label>Upload Image</label>
					   <input type="file" name="image" class="form-control">
					</div>
				</div>
			</div>
			<div class="box box-warning">
				<div class="box-header with-heading">
					<h3 class="box-title">Publish</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="publish"><input type="checkbox" id="publish" name="publish" checked> Publish</label>
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
  <script src="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('public/admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <!-- CK Editor -->
  <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
  <!-- datepicker -->
  <script>
  	var options = {
  	  filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
  	  filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
  	  filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
  	  filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  	};

  	CKEDITOR.replace('description',options);
    CKEDITOR.config.height = 200;
  	$('#datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  });
    </script>
@endpush