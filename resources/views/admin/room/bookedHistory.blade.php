@extends('layouts.admin')
@section('title','Booked History')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@section('content')
<section class="content-header">
	<h1>Booking<small>List</small></h1>
	
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">Booking</a></li>
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
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Data Table</h3>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S.N.</th>
								<th>name</th>
								<th>Email</th>
								<th>Phone</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($customers as $key=>$customer)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$customer->first_name}} {{$customer->last_name}}</td>
							<td>{{$customer->email}}</td>
							<td>{{$customer->phone_number}}</td>
							<td>
								<a href="" class="btn btn-info view" data-id="{{$customer->id}}">View</a>
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@include('admin.include.modal')
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

  $(document).ready(function(){
  	$(document).on('click','.view',function(e){
  		e.preventDefault();
  		var id = $(this).data('id');
  		$.ajax({
  		  url: "/admin/booking/"+id,
  		  method: 'GET',
  		  async: true,
  		  data: { id: id},
  		  success:function(data){
  		    
  		    $('#myModal .modal-body').html(data);
  		    $('#myModal').modal('show');
  		  }
  		});
  		
  	});
  });

</script>
@endpush
