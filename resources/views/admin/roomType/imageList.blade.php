@extends('layouts.admin')
@section('title','Image List')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@section('content')
<section class="content-header">
	<h1>Room Type Image<small>List</small></h1>
	
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">Room Type Image</a></li>
		<li><a href="">list</a></li>
	</ol>
</section>
<div class="content">
	@if(Session::has('message'))
	<div class="alert alert-success alert-dismissible message">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      		<span aria-hidden="true">&times;</span>
    	</button>
    	{!! Session::get('message') !!}
	</div>
	@endif
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Add Image</h3>
				</div>
				<div class="box-body">
					<form action="{{route('room-type-image.store')}}" enctype="multipart/form-data" method="post">
						{{csrf_field()}}
						<input type="hidden" name="roomtype_id" value="{{$roomtype->id}}">
						<div class="form-group">
							<label>Image</label>
							<input type="file" name="image" class="form-control">
						</div>
						<div class="form-group">
							<input type="submit" name="submit" value="submit" class="btn btn-success">
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-xs-6">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Data Table</h3>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S.N.</th>
								<th>Image</th>
								
								
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
						@php($i=1)
						
                        @foreach($roomtypeImages as $detail)
                        <tr>
                        	<td>{{$i++}}</td>
				            <td>@if($detail->image)
				            	<img src="{{asset('images/listing/'.$detail->image)}}">
				            	@endif
				            </td>
				           
				            
				            <td>
				            	
				            	<form method= "post" action="{{route('room-type-image.destroy',$detail->id)}}" class="delete">
                				{{csrf_field()}}
                				<input type="hidden" name="_method" value="DELETE">
               					<button type="submit" class="btn  btn-danger btn-delete" style="display:inline">Delete</button>
               				    </form>
               				    
				            </td>
				            
                        </tr>
                        @php($i++)
                        @endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
  <!-- DataTables -->
  <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset('backend/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('backend/plugins/fastclick/fastclick.js') }}"></script>
  <script >
  	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
      $('.message').fadeOut(3000);
       $('.delete').submit(function(e){
        e.preventDefault();
        var message=confirm('Are you sure to delete');
        if(message){
          this.submit();
        }
        return;
       });
    });
  </script>
  <script>
  $(function () {
    $("#example1").DataTable();
  });

</script>
@endpush
