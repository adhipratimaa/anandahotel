@extends('layouts.front')

@push('styles')

<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/css/magnific-popup.css')}}">


@endpush

@section('content')








<section class="gallery-detail-page inner-background all-sec-padding">
    <div class="container">
        <div class="row">
            @foreach($galleries->images->chunk(4) as $image)
            @foreach($image as $img)
            <div class="col-lg-3 col-md-4 col-6 p-0">
                <a class="gal-detail-link" href="{{asset('images/'.$img->filename)}}"><img src="{{asset('images/thumbnail/'.$img->filename)}}"></a>
            </div>
            @endforeach
            @endforeach
        </div>
    </div>
</section>













@endsection

@push('scripts')

<script src="{{asset('front/js/jquery.magnific-popup.js')}}"></script>

@endpush