@extends('layouts.admin')	
@section('title','Setting')
@push('admin.styles')
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
<!-- bootstrap wysihtml5 - text editor -->
@endpush
@section('content')
<section class="content-header">
	<h1>Setting<small></small></h1>
	
</section>
<div class="content">
<form method="post" action="{{route('setting.update',@$detail->id)}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <input type="hidden" name="_method" value="PUT">
  <div class="row">
      	<div class="col-md-8">
          	<div class="box box-primary">
              	<div class="box-header with-heading">
                  <h3 class="box-title">Contacts</h3>
              	</div>
              	<div class="box-body">
					<div class="form-group">
						<label>Address</label>
						<input type="text" name="address" class="form-control" value="{{@$detail->address}}">
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" name="phone" class="form-control" value="{{@$detail->phone}}">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control" value="{{@$detail->email}}">
					</div>
					
					<div class="form-group">
						<label>About Us</label>
						<textarea id="about_us_description" name="about_us_description" class="form-control" maxlength="250">{{@$detail->about_us_description}}</textarea>
					</div>
					
					<div class="form-group">
					   <label>video Link</label>
					   <!-- <input type="text" name="video" class="form-control" value="{{@$detail->video}}"> -->
					   <textarea class="form-control" name="video" class="form-control">{{$detail->video}}</textarea>
					   
					</div>

					<!-- <div class="form-group">
					   <label>Youtube</label>
					   <input type="text" name="youtube" class="form-control" value="{{@$detail->youtube}}">
					   
					</div> -->
					
					
              	</div>  
          	</div>
          	
      	</div>
      	<div class="col-md-4">
      		
			
      		<div class="box box-warning">

				<div class="box-header with-heading">
					<h3 class="box-title">Social Network</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Facebook Link</label>
						<input type="text" name="facebook" class="form-control" value="{{@$detail->facebook}}">
					</div>
					<div class="form-group">
						<label>Twitter Link</label>
						<input type="text" name="twitter" class="form-control" value="{{@$detail->twitter}}">
					</div>
					
					<div class="form-group">
						<label>Instagram Link</label>
						<input type="text" name="instagram" class="form-control" value="{{@$detail->instagram}}">
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
  <script src="{{ asset('js/accessible_character_countdown.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <!-- CK Editor -->
  <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
  <!-- datepicker -->
  <script>
  	// CKEDITOR.replace('about_us');
   //  CKEDITOR.config.height = 200;
    $(document).ready(function () {
        $( "#my-editor" ).accessibleCharCount();
        $( "#contact_us_description" ).accessibleCharCount();
     });
  	
    </script>
@endpush