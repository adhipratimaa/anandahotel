@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">



<section class="blog-detail-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12">
                <div class="blog-detail-wrapper">
                    <figure style="background-image:url({{asset('images/main/'.$blog->image)}})"></figure>
                    <div class="date-wrapper">
                        <p>By:<span>{{$blog->author}}</span></p><span>{{Carbon\Carbon::parse($blog->created_at)->format('Y M d')}}</span>
                    </div>
                    <div class="blog-detail-content">
                        <h3>{{$blog->title}}</h3>
                        <p>{!!$blog->description!!}</p>

                        
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="blog-sidebar">
                    @foreach($recentBlogs as $blog)
                    <a class="blog-sidebar-link" href="{{route('blogInner',$blog->slug)}}">
                        <figure style="background-image:url({{asset('front/images/room1.jpg')}})">
                            <i class="fa fa-link" aria-hidden="true"></i>
                        </figure>
                        <span>{{Carbon\Carbon::parse($blog->created_at)->format('Y M d')}}</span>
                        <h4>{{$blog->title}}</h4>
                    </a>
                    @endforeach
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>


@endsection