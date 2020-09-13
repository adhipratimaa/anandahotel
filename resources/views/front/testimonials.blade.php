@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">


<section class="testimonial-page rooms-section" style="background: url({{asset('front/images/index-back.jpg')}})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="testimonial-page-title">
                    <h2>What People Say About Us</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="testimonial-page-wrapper">
    	<!-- @foreach($testimonials as $testimonial)
        <div class="container">
            <div class="row testi-page-wrapper">
                <div class="col-lg-2 col-md-2 col-12">
                    <div class="client-image">
                        <img src="{{asset('images/thumbnail/'.$testimonial->image)}}">
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-12">
                    <div class="testimonial-page-content">
                        <h4>{{$testimonial->name}}</h4>
                        <span>{{$testimonial->position}}</span>
                        <p>{{$testimonial->description}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach -->

        
            <!-- <div class="flexslider testi_slider" data-item="3">
                <ul class="slides">
                    <li>
                    @foreach($testimonials as $testimonial)

                        <div class="container">
                            <div class="row testi-page-wrapper">
                                <div class="col-lg-2 col-md-2 col-12">
                                    <div class="client-image">
                                        <img src="{{asset('images/thumbnail/'.$testimonial->image)}}">
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-12">
                                    <div class="testimonial-page-content">
                                        <h4>{{$testimonial->name}}</h4>
                                        <span>{{$testimonial->position}}</span>
                                        <p>{{$testimonial->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </li>
                </ul>
            </div> -->

            <div class="flexslider testi_slider" data-item="2">
                <div class="slides">
                    @foreach($testimonials as $testimonial)
                    <div class="item">
                        <div class="container">
                            <div class="row testi-page-wrapper">
                                <div class="col-lg-2 col-md-2 col-12">
                                    <div class="client-image" id="testi-image">
                                        <img src="{{asset('images/thumbnail/'.$testimonial->image)}}">
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-12">
                                    <div class="testimonial-page-content">
                                        <h4>{{$testimonial->name}}</h4>
                                        <span>{{$testimonial->position}}</span>
                                        <p>{{$testimonial->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>


    </div>
    
</section>

@endsection

<!-- 
<div class="flexslider">
    <ul class="slides">
    @foreach($testimonials as $testimonial)
        <li>
            <div class="container">
                <div class="row testi-page-wrapper">
                    <div class="col-lg-2 col-md-2 col-12">
                        <div class="client-image">
                            <img src="{{asset('images/thumbnail/'.$testimonial->image)}}">
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-12">
                        <div class="testimonial-page-content">
                            <h4>{{$testimonial->name}}</h4>
                            <span>{{$testimonial->position}}</span>
                            <p>{{$testimonial->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div> -->