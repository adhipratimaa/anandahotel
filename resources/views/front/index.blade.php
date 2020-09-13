@extends('layouts.front')
@section('content')
<!-- main slider section starts -->

<section class="flexslider main-slider">
    <ul class="slides main-slide-wrapper">
        @foreach($sliders as $slider)
        <li>
            <figure style="background-image:url({{asset('images/thumbnail/'.$slider->image)}})">
                <div class="container">
                    <div class="slider-logo-wrapper">
                        <img src="{{asset('front/images/hotel-ananda-white-logo.png')}}">
                    </div>
                </div>
            </figure>
        </li>
        @endforeach
        
    </ul>
</section>


<!-- main slider section ends -->

<!-- room booking form section starts -->

@include('front.include.room-booking-form')

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
                <div class="video-sec-content-side wow slideInLeft" data-wow-duration="3s">
                    <h2>Hotel Ananda</h2>
                    <span>rich in hospitality:With <p>The Peak hospitality</p></span>
                    <p>{{$dashboard_composer->about_us_description}}</p>

                    <a class="site-btn" href="{{route('page',['about-us'])}}">Know More </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="vodeo-wrapper wow slideInRight" data-wow-duration="3s">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$dashboard_composer->youtubeVideo($dashboard_composer->video)}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> </div>
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
                    <h2>Our Room Types</h2>
                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, nostrum.</span>
                </div>
            </div>
        </div>
        <div class="row room-wrapper ">
            @foreach($roomTypes as $roomType)
            <div class="col-lg-4 col-md-6 col-12 room-col-wrapper wow zoomIn" data-wow-duration="3s">
                <div class="whole-room-wrapper">
                    <a href="room-listing2.php">
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
                        <a href="#">
                            <h3>{{$roomType->name}}</h3>
                        </a>
                        <p>{{str_limit($roomType->short_description,200)}} </p>
                    </div>
                    <div class="room-btn-wrapper">
                        <a class="site-btn home-book-btn room-btn" href="{{route('singleRoomType',$roomType->slug)}}">Book <br> Room</a>
                    </div>
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
            <div class="home-tab-wrapper">
              <!-- Nav tabs -->
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
    $(document).ready(function(){
        var roomCapacity=4;

        

        $("#options.dropdown ul.sub_menu li").click(function(e) {
            e.preventDefault();
            id=$(this).data('id');
            $('.roomtype_id').val(id);
            $('.main-nav').addClass('roomNumber');
            $.ajax({
                url:"{{route('getCategoryCapacity')}}",
                data:{id:id},
                method:"post",
                success:function(data){
                    
                    // getValue(data);
                    roomCapacity=data;
                }
            });
            $("div.title").text($(this).text());
        });

        
        $('.sub').click(function(){
            value=parseInt($('.number_of_rooms').val(),10);
            $('#room-'+value).remove();
            
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            $('.number_of_rooms').val(value);
            


        });

        $(document).on('click','.roomNumber', function() {
            $('.drop-item').slideToggle(50);
        });

        $('.add').click(function(){
            $('.number_of_people').removeClass('d-none');
            value=parseInt($('.number_of_rooms').val(),10);
            value = isNaN(value) ? 0 : value;
            value++;
            
            $(".number_of_rooms").val(value);

            Add='<div class="room-1" id="room-'+value+'">';
            Add+='<span class="max-limit d-none" id="error'+value+'">Max person limit</span>';
            Add+='<p class="people-name">Room '+value+'</p>';
            Add+='<div class="people-wrapper">'
            Add+='<p>Adults</p>'
            Add+='<div class="number-wrapper">'
            Add+='<span class="adultMinus" data-value="'+value+'">-</span>'
            Add+='<input type="text" name="adult[]" value="0" readonly class="adult'+value+'">'
            Add+='<span class="adultPlus" data-value="'+value+'">+</span>'
            Add+='</div>'
            Add+='</div>'
            Add+='<div class="people-wrapper">'
            Add+='<p>Childs</p>'
            Add+='<div class="number-wrapper">'
            Add+='<span class="childMinus" data-value="'+value+'">-</span>'
            Add+='<input type="text" name="child[]" value="0" readonly class="child'+value+'">'
            Add+='<span class="childPlus" data-value="'+value+'">+</span>'
            Add+='</div>'
            Add+='</div>'
            Add+='</div>';
            $('.number_of_people').append(Add);

        });

        $(document).on('click','.adultPlus',function(e){
            e.preventDefault();
            value=$(this).data('value');

            // console.log(parseInt($('.adult'+value).val()));
            //max number of adult 2
            inputValue=parseInt($('.adult'+value).val());
            if(parseInt($('.adult'+value).val()) + parseInt($('.child'+value).val())<roomCapacity){
                newInputValue=inputValue+1;
                if(newInputValue<=2){
                    $('.adult'+value).val(newInputValue);
                }
                

            }else{
                $('#error'+value).removeClass('d-none')
            }
            // if(parseInt($('.adult'+value).val()) + parseInt($('.child'+value).val())<roomCapacity){
            //     newInputValue=inputValue+1;
                
            //     $('.adult'+value).val(newInputValue);

            // }else{
            //     $('#error'+value).removeClass('d-none')
            // }
           

        });
        $(document).on('click','.adultMinus',function(e){
            e.preventDefault();
            value=$(this).data('value');
            inputValue=parseInt($('.adult'+value).val());
            if(inputValue>0){
                newInputValue=inputValue-1;
                $('.adult'+value).val(newInputValue);
                $('#error'+value).addClass('d-none')
            }

        });
        $(document).on('click','.childPlus',function(e){
            e.preventDefault();
            value=$(this).data('value');

            // console.log(parseInt($('.adult'+value).val()));
            inputValue=parseInt($('.child'+value).val());
            if(parseInt($('.adult'+value).val()) + parseInt($('.child'+value).val())<roomCapacity){
                newInputValue=inputValue+1;
                if(newInputValue<=2){
                    $('.child'+value).val(newInputValue);
                }
                

            }else{
                $('#error'+value).removeClass('d-none')
            }
            

        });
        $(document).on('click','.childMinus',function(e){
            e.preventDefault();
            value=$(this).data('value');
            inputValue=parseInt($('.child'+value).val());
            if(inputValue>0){
                newInputValue=inputValue-1;
                $('.child'+value).val(newInputValue);
                $('#error'+value).addClass('d-none')
            }

        });



    });

    $(document).ready(function(){
        $('.room-btn').click(function(e){
            e.preventDefault();
            $("body").scrollTop(0);
            $('.message').removeClass('d-none');
            setTimeout(addClass,3000);
        });
        function addClass(){
           $('.message').addClass('d-none');
        }
    });

   

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