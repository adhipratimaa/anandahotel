@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">





<section class="room-detail-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="flexslider room-detail-slider">
                    <ul class="slides">
                        @if($roomType->image)
                        <li>
                            <figure style="background-image:url('{{asset('images/main/'.$roomType->image)}}')"></figure>
                        </li>
                        @endif
                        @if($roomType->images)
                        @foreach($roomType->images as $image)
                        <li>
                            <figure style="background-image:url('{{asset('images/thumbnail/'.$image->image)}}')"></figure>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
               
                <!-- <div class="related-room-sec">
                    <div class="room-detail-title"><h3>Other Similar Rooms</h3></div>
                    <div class="row room-wrapper ">
                        <div class="col-lg-6 col-md-6 col-12 room-col-wrapper wow zoomIn" data-wow-duration="3s">
                            <div class="whole-room-wrapper">
                                <a href="#">
                                    <figure style="background-image:url('{{asset('front/images/room4.jpg')}}')"></figure>
                                    <div class="room-rate">
                                        <p>From</p>
                                        <span>Rs. </span> <span>5000</span>
                                    </div>
                                </a>
                                <div class="room-content">
                                    <a href="#">
                                        <h3>Twins Room</h3>
                                    </a>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio officiis, quidem modi esse eum iste, impedit atque consequatur eligendi optio possimus asperiores. 
                                        Deserunt magni atque, earum voluptates sed itaque dignissimos.</p>
                                    <div class="room-btn-wrapper">
                                        <a class="site-btn room-btn" href="#">View Rooms</a>
                                        <ul>
                                            <li><i class="fa fa-wifi" aria-hidden="true"></i>
                                                <span class="hover-text">Free Wifi</span>
                                            </li>
                                            <li><i class="fa fa-television" aria-hidden="true"></i>
                                                <span class="hover-text">Net Tv</span>
                                            </li>
                                            <li><i class="fa fa-television" aria-hidden="true"></i>
                                                <span class="hover-text">Cooler</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 room-col-wrapper wow zoomIn" data-wow-duration="3s">
                            <div class="whole-room-wrapper">
                                <a href="#">
                                    <figure style="background-image:url('{{asset('front/images/room5.jpg')}}')"></figure>
                                    <div class="room-rate">
                                        <p>From</p>
                                        <span>Rs. </span> <span>5000</span>
                                    </div>
                                </a>
                                <div class="room-content">
                                    <a href="#">
                                        <h3>Twins Room</h3>
                                    </a>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio officiis, quidem modi esse eum iste, impedit atque consequatur eligendi optio possimus asperiores. 
                                        Deserunt magni atque, earum voluptates sed itaque dignissimos.</p>
                                    <div class="room-btn-wrapper">
                                        <a class="site-btn room-btn" href="#">View Rooms</a>
                                        <ul>
                                            <li><i class="fa fa-wifi" aria-hidden="true"></i>
                                                <span class="hover-text">Free Wifi</span>
                                            </li>
                                            <li><i class="fa fa-television" aria-hidden="true"></i>
                                                <span class="hover-text">Net Tv</span>
                                            </li>
                                            <li><i class="fa fa-television" aria-hidden="true"></i>
                                                <span class="hover-text">Cooler</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
            
            <div class="col-lg-6 col-md-12 col-12">
                 <div class="room-slider-content">
                    <h2>{!!$roomType->title!!}</h2>
                    <span>Rs. {{$roomType->price}}/Night</span>
                    {!!$roomType->description!!}
                </div>
            </div>
            <div class="col-12">
                 <div class="room-facility-wrapper">
                    <h3>Room Facility</h3>
                    <ul>
                        @if($roomType->features)
                        @foreach($roomType->features as $feature)
                        <li><img src="{{asset('images/main/'.$feature->image)}}"><p>{{$feature->title}}</p></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>

              <div class="col-12">
                 <div class="room-facility-wrapper">
                    <h3>Other Rooms</h3>
                </div>
              <div class="row room-wrapper ">
                  
                
            
            @foreach($roomTypes as $roomType)
            <div class="col-lg-4 col-md-6 col-12 room-col-wrapper wow zoomIn" data-wow-duration="500ms">
                <div class="whole-room-wrapper">
                    <a href="{{route('roomDetail',$roomType->slug)}}">
                         <figure style="background-image:url({{asset('images/thumbnail/'.$roomType->image)}})"></figure> 
                       
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
                        <p>{{str_limit($roomType->short_description,200)}} </p>
                    </div>
                    <div class="room-btn-wrapper">
                        <a class="site-btn home-book-btn room-btn" href="{{route('roomDetail',$roomType->slug)}}">View <br> Room</a>
                    </div>
                    
                </div>
            </div>
            @endforeach
            
        </div>
            </div>
            <!--<div class="col-lg-4 col-md-6 col-12">-->
                <!--<div class="room-detail-sidebar">-->
                    <!-- <form action="" class="sidebar-form"> -->
                        <!-- <h3>Book Room<h3> -->
                            <!-- <input type="text" placeholder="Arrival Date"> -->
                            <!-- <input type="text" placeholder="Departure Date"> -->
                            <!-- <select name="Room Type" id="">
                                <option value="">Room Type</option>
                                <option value="">Twins Room</option>
                                <option value="">Deluxe Room</option>
                            </select> -->
                           <!--  <select name="No. of Rooms" id="">
                                <option value="">No. of Rooms</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select> -->
                           <!--  <select name="" id="">
                                <option value="">Adults</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select> -->
                            <!-- <select name="" id="">
                                <option value="">Childs</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select> -->
                            <!-- <input type="text" placeholder="Promo Code"> -->
                            <!-- <button class="site-btn">Book Now</button> -->
                    <!-- </form> -->
                <!--</div>-->
                <!--<div class="book-contact">-->
                <!--    <span><i class="fa fa-volume-control-phone" aria-hidden="true"></i></span>-->
                <!--    <h3>Book Hotel By Phone</h3>-->
                <!--    <p>+977-9845-646-4654</p>-->
                <!--</div>-->
            <!--</div>-->
        </div>
        
    </div>
</section>









@endsection


