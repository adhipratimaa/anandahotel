@extends('layouts.admin')
@section('title','Attendance List')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@section('content')
<section class="content-header">
    <h1>OurClients<small>List</small></h1>
   
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="">Attendance</a></li>
        <li><a href="">List</a></li>
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
                
                <div class="box-body">
                    <form action="" method="POST" class="form form-horizontal form-responsive">
                        <div class=" form-group">
                            <div class="col-md-4">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                <input type="text"  id="reservation" class="form-control date" value=""  name="date" />
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                                
                          
                            <!-- <div class="col-md-3 col-sm-3 col-xs-12 pull-left text-capitalize select_data_inner">
                                <select class="form-control text-capitalize">
                                    <option value="week">this week</option>
                                    <option value="week">this month</option>
                                </select>
                            </div> -->

                            
                        </div>
                            
                    </form>
                </div>
                <div class="appendTable">
                    
                </div>
                
            </div>
            <div class="box">

                
            <div class="box-body" id="replacableData">
                @include('admin.room.include.bookingDetails')
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
  
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script >
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     $('input[name="date"]').daterangepicker({
        "maxSpan": {
            "days": 30
        },
        "minSpan": {
                "days": 2
            },

     });
     $(function () {
       $("#datatable").DataTable();
     });

    $(document).ready(function(){
        $('.delete').submit(function(e){
        e.preventDefault();
        var message=confirm('Are you sure to delete?');
        if(message){
            this.submit();
        }
        return;
        });
    });


    $(document).on('click','.applyBtn',function(e){
        e.preventDefault()
        var value=$('.date').val();
       

        $.ajax({
            url: "{{route('GetCustomDateRoomBooking')}}",
            method: 'post',
            async: true,
            data: { value:value },
            success:function(response){
            	console.log(response);
                if(response.status == false ){
                    console.log(response.data)
                    $('#replacableData').html('');
                }else if(response.status == true){
                    console.log(response.booked_room);
                    $('#replacableData').html(response.html);
                    init_DataTables();
                    
                }
            }
        });
    });
    $('.message').delay(5000).fadeOut(400);
    
    

   
</script>
@endpush
