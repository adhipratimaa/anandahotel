@extends('layouts.admin')
@section('title','Add Promo')
@section('content')
<section class="content-header">
	<h1>Promo<small>create</small></h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">promo</a></li>
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
<form method="post" action="{{route('promo.store')}}" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-heading">
					<h3 class="box-title">Add a promo</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Title(required)</label>
						<input type="text" name="title" class="form-control" value="{{old('title')}}">
					</div>
					
					<div class="form-group">
						<label>Promo Code</label>
						<input type="text" name="promo_code" class="form-control" value="{{old('promo_code')}}">
					</div>
					<div class="form-group">
						<label>Discount %</label>
						<input type="text" name="discount" class="form-control">
					</div>
					<div class="form-group">
						<label for="publish"><input type="checkbox" id="publish" name="publish" checked> Publish</label>
				    </div>
					<div class="form-group">
				    	<input type="submit" name="" class="btn btn-success">
				    </div>

					<!-- <div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="description" rows="3">{{old('description')}}</textarea>
					</div> -->
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