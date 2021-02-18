@extends('layouts.admin')
@section('title','Add Room Type')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@section('content')
<section class="content-header">
    <h1>Room Type<small>create</small></h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="">Room Type</a></li>
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
    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible message   ">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
        </button>
        {!! Session::get('message') !!}
    </div>
    @endif
    
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{route('room-type.store')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="box box-primary">
                <div class="box-header with-heading">
                    <h3 class="box-title">Add a new room type</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{old('slug')}}">
                    </div>
                    
                    <div class="form-group select-member">
                        <label>Select Features</label>
                        <select multiple="multiple" class="members form-control" name="features[]" id="feature_select">
                            @foreach($features as $feature)
                                <option value="{{$feature->id}}">{{$feature->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Room Capacity</label>
                        <input type="number" name="room_capacity" class="form-control" value="{{old('room_capacity')}}">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" value="{{old('price')}}">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" value="" multiple id="upload_file">
                    </div>
                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control" name="short_description" rows="3">{{old('short_description')}}</textarea>
                    </div>
                     <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="publish"><input type="checkbox" id="publish" name="publish" checked> Publish</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="" class="btn btn-success">
                    </div>      
                </div>
            </form>   
        </div>
    </div>
    
  </div>
</div>
@endsection
@push('script')

  <!-- CK Editor -->
  <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
    $(".members").select2();
    </script>
    <script>
    CKEDITOR.replace('description');
    CKEDITOR.config.height = 200;
    $('#datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  });

    $('#timepicker1').timepicker();
    $('.message').delay(5000).fadeOut(400);
    </script>

@endpush