@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">



<section class="blog-page">
    <div class="blog-top-image" style="background-image:url({{asset('front/images/room5.jpg')}})">
        <div class="container">
            <div class="blog-top-title">
                <h2>Our Latest Blogs</h2>
            </div>
        </div>
    </div>
    <div class="blog-list-wrapper">
        <div class="container">
            <div class="row">
            	@foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6 col-12 same-height wow zoomIn" data-wow-duration="2s">
                    <div class="blog-wrapper">
                        <a href="{{route('blogInner',$blog->slug)}}">
                            <figure style="background-image:url({{asset('images/thumbnail/'.$blog->image)}})"></figure>
                        </a>
                        <div class="blog-content">
                            <a href="{{route('blogInner',$blog->slug)}}">
                                <h3>{{$blog->title}}</h3>
                            </a>
                            <div class="date-wrapper">
                                <span>By:<span class="p">{{$blog->author}}</span></span>
                                <span>{{Carbon\Carbon::parse($blog->created_at)->format('Y,M d')}}</span>
                            </div>
                            <p>{{$blog->short_description}}</p>
                                <a class="site-btn" href="{{route('blogInner',$blog->slug)}}">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </div>
</section>
@endsection