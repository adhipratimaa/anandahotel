@extends('layouts.front')
@section('content')

<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">


<section class="packages-detail all-sec-padding">
    <div class="container">
        <div class="blog-top-title package-info-title">
            <h2>{{$services->title}}</h2>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="package-image-side">
                    <img src="{{asset('images/thumbnail/'.$services->image)}}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="packge-content-side">
                   {!!$services->description!!}
                </div>
            </div>
        </div>
    </div>
</section>


@endsection