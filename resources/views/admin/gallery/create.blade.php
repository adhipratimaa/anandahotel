@extends('layouts.admin')
@section('title','Add Gallery')
@section('content')
<section class="content-header">
  <h1>Gallery<small>create</small></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="">Gallery</a></li>
    <li><a href="">Create</a></li>
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

<form method="post" action="{{route('gallery.store')}}" enctype="multipart/form-data" id="form">
  {{csrf_field()}}
  
  <div class="row">
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header with-heading">
          <h3 class="box-title">Add a new gallery</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label>Title(required)</label>
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
          </div>
          <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{old('slug')}}">
          </div>
          <div class="form-group">
            <label>Upload Image</label>
            <input type="file" name="image[]" multiple id="upload_file">
            <div class="row">
              <div class="col-md-12">
              <div id="image_preview" class="row"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
     <!--  <div class="box box-warning">
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
             <textarea class="form-control" name="meta_description" rows="3">{{old('meta_description')}}</textarea>
          </div>
        </div>
      </div> -->
      <div class="box box-warning">
        <div class="box-header with-heading">
          <h3 class="box-title">Image</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
             <label>Upload Image for listing</label>
             <input type="file" name="list_image" class="form-control">
          </div>
        </div>
      </div>
      <div class="box box-warning">
        <div class="box-header with-heading">
          <h3 class="box-title">Publish</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label for="is_active"><input type="checkbox" id="is_active" name="is_active" checked> Publish</label>
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
@include('admin.include.modal')
@endsection
@push('script')
<script src="{{asset('js/jquery.Jcrop.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  
  <script>

    </script>

     <script >
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
       /****image upload****/
    var _URL = window.URL || window.webkitURL;
    var count = 0;
    var _URL = window.URL || window.webkitURL;
    $(document).ready(function() {
        $('#upload_file').change(function() {
            var file, img;
            var i;
            for (i = 0; i < this.files.length; i++) {
                if ((file = this.files[i])) {
                    img = new Image();
                    img.onload = function() {
                        var width = this.width;
                        var height = this.height;
                        if (height < 600 && width < 600) {
                            alert('you must upload image more than 600*600');
                            return true;
                        }
                        
                    }; // img onload
                    img.onerror = function() {
                        alert("not a valid file: " + file.type);
                    };
                    img.src = _URL.createObjectURL(file);
                    img = "";
                } //if 
            } //for loop
            var formData = new FormData($('#form')[0]);
            $.ajax({
                url: "{{route('galleryimage')}}",
                type: 'POST',
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(returndata) {

                    var step;
                    for (step = 0; step < returndata.length; step++) {
                        addblock(returndata[step], count);
                        count++;
                    }
                }
            });
        });
    });


    function addblock(photo, i) {

    var block = '<div class="col-md-6 well well-sm img-block form-group"id="photo_' + i + '">';
    block += '<div class="img-holder">';



    block += '<img src="' + photo.thumb_path + '/' + photo.name + '" class="img-thumbnail" />';

    block += '</div>';

    block += '<textarea class="form-control" name="caption[]"></textarea>';

    block += '<input type="hidden" name="filename[]" value="' + photo.name + '">';
    block += '<br/>';
    block += '<div class="row">';
    block += '<div class="col-md-6 col-xs-6">';
    block += '<button type="button" data-id="crop" data-image="' + photo.name + '" title="Crop" class="btn bg-navy cropImg btn-block" data-index="' + i + '" ><i class="fa fa-crop"></i></button>';
    block += '</div>';
    block += '<div class="col-md-6 col-xs-6">';
    block += '<button type="button" data-image="' + photo.name + '" id="delete_' + i + '" class="del-btn btn btn-danger btn-block">';
    block += '<i class="fa fa-trash"></i>';
    block += '</button>';

    block += ' </div>';
    block += '</div>';

    block += ' </div>';
    block += '</div>';


    $("#image_preview").append(block);
    }


            /**showing modal**/
     $(document).ready(function() {
     $(document).on("click", "button[data-id]", function() {
         var name = $(this).data('image');
         var index = $(this).data('index');
         $.ajax({
         url: "{{route('crop')}}",
         method: 'post',
         async: true,
         data: { name: name, index: index },
         success: function(data) {
             $('#myModal .modal-body').html(data);
             $('#myModal').modal('show');
         }
     });
     });
     });


    //deleting image block
    $(document).on("click", "button.del-btn", function() {
    var name = $(this).data('image');
    var delConfirm = confirm('Are you sure you want to delete?');
    var _this = this;
    if (delConfirm) {
        $.ajax({
            method: 'post',
            url: "{{route('removeImage')}}",
            data: { name: name },
            success: function(data) {
                $(_this).closest('.img-block').remove();
            }
        });
    }
    return false;
});


$('.message').delay(5000).fadeOut(400);
</script>

@endpush
@push('style')
<style type="text/css">
  .img-holder img{
    height: 250px;
    width:100%;
  }
  </style>
@endpush