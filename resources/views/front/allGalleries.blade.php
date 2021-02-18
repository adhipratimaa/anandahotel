@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">



<section class="gallery-list-page inner-background all-sec-padding">
    <div class="container">
        <div class="title-wrapper service-title news-title">
            <h2>Our Latest Gallery</h2>
            <P>Exercitation llamco laboris nis aliquip sed conseqrure dolorn repreh velit excepteur duis aute irure dolor voluptate voluptatem accusa</P>
        </div>
        <div class="row">
            @foreach($galleries as $gallery)
            <div class="col-lg-4 col-md-6 col-12">
                <a href="{{route('galleryInner',$gallery->id)}}" class="gal-wrapper">
                    <img src="{{asset('images/thumbnail/'.$gallery->list_image)}}" alt="gal-image">
                    <h3 class="gal-title">{{$gallery->title}}</h3>
                </a>
            </div>
            @endforeach
            
        </div>
    </div>
</section>












@endsection