@extends('layouts.admin')
@section('title','Page List')
@push('styles')
<link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@section('content')
<section class="content-header">
  <h1>Page<small>List</small></h1>
  <a href="{{route('page.create')}}" class="btn btn-success">Add Page</a>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="">Page</a></li>
    <li><a href="">List</a></li>
  </ol>
</section>
<div class="content">
  @if(Session::has('message'))
  <div class="alert alert-success alert-dismissible">
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
          <table  class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <!--<th>Status</th>-->
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @php($i=1)
                @foreach($details as $detail)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$detail->title}}</td>
                    <td>
                      @if($detail->image)
                      <img src="{{asset('images/listing/'.$detail->image)}}">
                      @else
                      <p>N/A</p>
                      @endif
                    </td>
                    <!--<td>{{$detail->publish==1? 'active':'inactive'}}</td>-->
                    <td>
                       <a class="btn btn-info edit " href="{{route('page.edit',$detail->id)}}" title="Edit">Edit</a>
                        @if($detail->main=='')
                        <form method= "post" action="{{route('page.destroy',$detail->id)}}" class="delete btn btn-danger">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn-delete" style="display:inline">Delete</button>
                        </form>
                        @endif
                  
                      
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
  <script src="{{ asset('public/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('public/admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset('public/admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('public/admin/plugins/fastclick/fastclick.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script >
   $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
              });
    $(document).ready(function(){
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
@endpush
