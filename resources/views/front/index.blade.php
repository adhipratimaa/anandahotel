@extends('layouts.front')
@section('content')
<!-- main slider section starts -->

<section class="flexslider main-slider">
    <ul class="slides main-slide-wrapper">
        @foreach($sliders as $slider)
        <li>
            <figure style="background-image:url({{asset('images/thumbnail/'.$slider->image)}})">
               <!-- <div class="container">
                   <div class="slider-logo-wrapper">
                        <img src="{{asset('front/images/hotel-ananda-white-logo.png')}}">
                    </div>
                </div>-->
            </figure>
        </li>
        @endforeach
        
    </ul>
</section>


<!-- main slider section ends -->

<!-- room booking form section starts -->

@include('front.include.room-booking-form')
<!--<input type="text" style="width: 100%" name="check_in_date" id="check_in_inner" autocomplete="off" placeholder="Check In" value="" class="check_in_inner">-->
<!--<input type="text" style="width: 100%" name="check_in_date" autocomplete="off" placeholder="Check In" value="" class="check_in_inner">-->

<!-- room booking section ends -->

<!-- promo code -->
@if($promo)
    <div class="scrollingBox">
        <div class="container">
        <div class="alert box">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
       <p><b>Use Promo Code: <span class="promo">{{$promo->promo_code}}</b></span></p>


   </div>
</div>
    </div>
    @endif


<!-- video section starts -->

<section class="video-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="video-sec-content-side wow fadeInLeft" data-wow-duration="500ms">
                    <h2>Ananda Pashupati</h2>
                    <span>By:    <p>The Peak hospitality</p></span>
                    <p>{{$dashboard_setting->about_us_description}}</p>

                    <a class="site-btn" href="{{route('page',['about-us'])}}">Know More </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="vodeo-wrapper wow fadeInRight" data-wow-duration="500ms" data-wow-delay="500ms">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$dashboard_setting->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


                   
                    </div>
            </div>
        </div>
    </div>
</section>

<!-- video section ends -->

<!-- rooms section starts -->

<section class="rooms-section" style="background: url({{asset('front/images/index-back.jpg')}})">
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

<!-- rooms section ends -->
   
   <section class="services-sec" id="service-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title-wrapper services-title">
                        <h2>Our Services</h2>
                        <span>Lorem ipsum dolor sit amet consectetur adipisicing consectetur.</span>
                    </div>
                </div>
            </div>
                <?php /*
                <div class="home-tab-wrapper">
                        <div class="main-tab-wrapper">
                            <ul class="nav nav-tabs">
                                <div class="owl_1 owl-carousel">
                                    @foreach($services as $k=>$service)
                                    <li class="nav-item ">
                                        <a class='nav-link {{$k==0?"active":""}}' data-toggle="tab" href='#s{{$service->id}}'><div class="image-wrapper"><img src="{{asset('images/main/'.$service->logo)}}"></div><span>{{$service->title}}</span></a>
                                    </li>
                                    @endforeach
                                </div>
                            </ul>
                            <div class="tab-content">
                                @foreach($services as $key=>$serv)
                                <div id='s{{$serv->id}}' class="tab-pane container fade {{$key==0?'in show active':''}}">
                                        <div class="row row-wrapper">
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <div class="tab-content-image">

                                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach($serv->serviceImages as $key=>$image)
                                                        <div class="carousel-item {{$key==0?'active':''}}">
                                                        <img class="d-block w-100" src="{{asset('images/thumbnail/'.$image->image)}}" alt="First slide">
                                                        </div>
                                                        @endforeach
                                                    

                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <div class="tab-content-side wow slideInRight" data-wow-duration="2s">
                                                    <h3>{{$serv->title}}</h3>
                                                    <p>{!!$service->description!!}</p>
                                                    
                                                    <!-- <i class="tab-btn" href="{{route('services')}}">More<i class="fa fa-angle-double-right" aria-hidden="true"></i></a> -->
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                */?>
            <div class="front-service-list wow fadeInUp" data-wow-duration="500ms">
                <ul>
                     <li><img src="{{asset('front/images/reception-desk.svg')}}">24 Hour Front Desk</li>
                    <li><img src="{{asset('front/images/laundry-machine-variant-with-clothes-and-soap-on-top.svg')}}">Dry Cleaning / Laundry Service</li>
                    <li><img src="{{asset('front/images/lounge.svg')}}">Bar / Lounge</li>
                    <li><img src="{{asset('front/images/no-smoking.svg')}}">Non Smoking</li>
                    <li><img src="{{asset('front/images/shop.svg')}}">Shops</li>
                    <li><img src="{{asset('front/images/child.svg')}}">Kids Pool</li>
                    <li><img src="{{asset('front/images/eco-friendly.svg')}}">Eco-Friendly</li>
                    <li><img src="{{asset('front/images/desk.svg')}}">Travel Desk</li>
                    <li><img src="{{asset('front/images/concierge.svg')}}">Concierge</li>
                    <li><img src="{{asset('front/images/room-service.svg')}}">Room Service - 24hr</li>
                    <li><img src="{{asset('front/images/no-pets.svg')}}">Pets Not Allowed</li>
                    <li><img src="{{asset('front/images/suit-and-tie-outfit.svg')}}">Suites</li>
                    <li><img src="{{asset('front/images/baby-changing.svg')}}">Family Rooms</li>
                    <li><img src="{{asset('front/images/stair-of-a-swimming-pool.svg')}}">Outdoor Pool - Unheated</li>
                    <li><img src="{{asset('front/images/wake-up.svg')}}">Wake Up Calls</li>
                    <li><img src="{{asset('front/images/luggage.svg')}}">Luggage Storage</li>
                    <li><img src="{{asset('front/images/conference-hall.svg')}}">Conference/Meeting Facilities</li>
                    <li><img src="{{asset('front/images/elevator.svg')}}">Lift/Elevator</li>
                    <li><img src="{{asset('front/images/wheelchair.svg')}}">Wheelchair Accessible</li>
                    <li><img src="{{asset('front/images/room-key.svg')}}">Interconnecting Rooms</li>
                    <li><img src="{{asset('front/images/parking.svg')}}">On-site Car Parking</li>
                    <li><img src="{{asset('front/images/news.svg')}}">Local Newspaper/s</li>
                    <li><img src="{{asset('front/images/hot-tea.svg')}}">Cafe</li>
                    <li><img src="{{asset('front/images/room-key.svg')}}">Interconnecting Rooms</li>
                    <li><img src="{{asset('front/images/credit-card.svg')}}">Credit Cards Accepted</li>
                    <li><img src="{{asset('front/images/gym-station.svg')}}">Gym/Fitness Room</li>
                    <li><img src="{{asset('front/images/parking.svg')}}">Street Parking</li>
                </ul>
            </div>
        </div>
   </section>
        


<!-- service section -->

<!-- services section ends -->

<!-- testimonial section starts -->

<section class="testimonial-sec" style="background-image:url({{asset('front/images/khadeeja-yasser-msFZE7d9KB4-unsplash.jpg')}})">
    <div class="container">
        <div class="flexslider testimonial-slider">
            <ul class="slides">
                @foreach($testimonials as $testimonial)
                <li>
                    <div class="testimonial-whole-wrapper">
                        <div class="testimonial-content">
                            <p>{{$testimonial->description}}</p>
                        </div>
                        <div class="testimonial-image">
                            <img src="{{asset('images/thumbnail/'.$testimonial->image)}}">
                        </div>
                        <div class="testimonial-info">
                            <h4>{{$testimonial->name}}</h4>
                            <span>{{$testimonial->position}}</span>
                        </div>
                    </div>
                </li>
                @endforeach
               
            </ul>
        </div>
    </div>
</section>

<!-- testimonial section endss -->

<!-- blogs section starts -->

<section class="blog-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-wrapper">
                    <h2>Blogs</h2>
                    <span>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus, praesentium!</span>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6 col-12 same-height wow zoomIn" data-wow-duration="500ms">
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
</section>

<!-- blog section ends -->
@endsection
@push('scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    

    // $(document).ready(function(){
    //     $('.room-btn').click(function(e){
    //         e.preventDefault();
    //         $("body").scrollTop(0);
    //         $('.message').removeClass('d-none');
    //         setTimeout(addClass,3000);
    //     });
    //     function addClass(){
    //        $('.message').addClass('d-none');
    //     }
    // });

   

</script>

<!-- promo code -->

<script type="text/javascript">
    
$(document).ready(function() {
  var stickyTop = $('.coupon').offset().top;

  $(window).scroll(function() {
    var windowTop = $(window).scrollTop();

    if (stickyTop < windowTop) {
      $('.coupon').css('position', 'fixed');
    } else {
      $('.coupon').css('position', 'relative');
    }
  });
});



    
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>



<script type="text/javascript">
	


$(' .owl_1').owlCarousel({
    loop:false,
    margin:2,	
	responsiveClass:true,autoplayHoverPause:false,
	autoplay:false,
	 slideSpeed: 400,
      paginationSpeed: 400,
	 // autoplayTimeout:3000,
    responsive:{
        0:{
            items:1,
            nav:true,
			  loop:false
        },
        600:{
            items:3,
            nav:true,
			  loop:false
        },
        1000:{
            items:7,
            nav:true,
            loop:false
        }
    }
})

$(document) .ready(function(){
var li =  $(".owl-item li a ");
$(".owl-item li a").click(function(){
li.removeClass('active');
});
});









</script>








@endpush