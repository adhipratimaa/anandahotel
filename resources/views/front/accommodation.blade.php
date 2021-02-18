@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">



<section class="all-room-list-page all-sec-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-wrapper room-title">
                    <h2>Accommodation</h2>
                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, nostrum.</span>
                </div>
            </div>
        </div>
        
        <div class="row room-wrapper ">
            
            @foreach($roomTypes as $roomType)
            <div class="col-lg-4 col-md-6 col-12 room-col-wrapper wow zoomIn" data-wow-duration="500ms">
                <div class="whole-room-wrapper">
                    <a href="{{route('roomDetail',$roomType->slug)}}">
                        <!-- <figure style="background-image:url({{asset('images/thumbnail/'.$roomType->image)}})"></figure> -->
                       
                        <div class="flexslider room_type_slider">
                            <ul class="slides">
                                <li class="room_type_image"><img src="{{asset('images/thumbnail/'.$roomType->image)}}"/></li>
                                @if($roomType->images)
                                @foreach($roomType->images as $image)
                                <li class="room_type_image"><img src="{{asset('images/thumbnail/'.$image->image)}}"/></li>
                                @endforeach
                                @endif
                                
                            </ul>
                        </div>

                        <div class=" room-rate price-tag">
                            <div class="price-wrapper">
                                <p>Price From</p>
                                <span>$.{{$roomType->price}}</span>
                            </div>
                        </div>
                    </a>
                    <div class="room-content">
                        <a href="{{route('roomDetail',$roomType->slug)}}">
                            <h3>{{$roomType->name}}</h3>
                        </a>
                       <!-- <p>{{str_limit($roomType->short_description,200)}} </p>-->
                    </div>
                    <div class="room-btn-wrapper">
                        <a class="site-btn home-book-btn room-btn" href="{{route('roomDetail',$roomType->slug)}}">View <br> Room</a>
                    </div>
                    <div class="more_feature_wrapp">
                        <div class="more_feature">
                            <?php
                                $features=$roomType->features;

                            ?>
                            <ul>
                                @foreach($features as $feature)
                                <li><img src="{{asset('images/main/'.$feature->image)}}">
                                    <p>{{$feature->title}}</p>
                                </li>
                                @endforeach

                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</section>




@endsection