@extends('layouts.admin')
@section('title','Edit Feature')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@section('content')
<section class="content-header">
    <h1>Feature<small>edit</small></h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="">Feature</a></li>
        <li><a href="">Edit</a></li>
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
    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible message   ">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
        </button>
        {!! Session::get('message') !!}
    </div>
    @endif
    
    <div class="row">
        <div class="col-md-5">
            <form method="post" action="{{route('feature.update',$detail->id)}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="box box-primary">
                <div class="box-header with-heading">
                    <h3 class="box-title">Edit Feature</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{$detail->title}}">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        @if($detail->image)
                        <img src="{{asset('images/main/'.$detail->image)}}" width="100px" height="100px">
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="" class="btn btn-success">
                    </div>      
                </div>
            </form>   
      </div>
    </div>
    <div class="col-md-7">
        <div class="box box-warning">
            <div class="box-header with-heading">
                <h3 class="box-title">Features</h3>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Title</th>
                            <th>Image</th>
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
                            <img src="{{asset('images/main/'.$detail->image)}}" width="100px" height="100px">
                            @endif
                        </td>
                        <td>
                           
                            <a class="btn btn-info edit" href="{{route('feature.edit',$detail->id)}}" title="Edit">Edit</a>
                            <form method= "post" action="{{route('feature.destroy',$detail->id)}}" class="delete">
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

  <!-- CK Editor -->
  <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
  <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <!-- datepicker -->
  <script>
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
    
    $(function () {
      $("#example1").DataTable();
    });
    $('.message').fadeOut(3000);
    </script>

@endpush