<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ananda Hotel</title>
    <link rel="icon" href="#" type="{{asset('front/images/hotel-ananda.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/flexslider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/lightbox.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/animate.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/zebra_datepicker.css')}}">

    <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @stack('styles')


</head>

<body>

    <header>
        <div class="container">
            <div class="main-head">
                <a class="logo-wrapper" href="{{route('home')}}"><img src="{{asset('front/images/ananda_logo.png')}}"></a>
                <div class="top-info-wrapper small-screen">
                    <!-- <button class="book-top-btn"><img src="images/support.png" alt="images/support.png">Book Now</button> -->
                    <span><i class="fa fa-phone" aria-hidden="true"></i>{{$dashboard_setting->phone}}</span>
                    <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>{{$dashboard_setting->email}}</a>
                </div>
                <nav class="main-navigation">
                    <div class="top-info-wrapper big-screen">
                        <span><i class="fa fa-phone" aria-hidden="true"></i>{{$dashboard_setting->phone}}</span>
                        <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>{{$dashboard_setting->email}}</a>
                    </div>
                    <ul class="navigation__wrapper">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('page',['about-us'])}}">About Us</a></li>
                        <li class="drop-menu"><a href="{{route('accomodation')}}">Accommodation</a></li>
                       
                        <li><a href="{{route('allServices', 'packages')}}">Packages</a>
                      
                        </li>
                        <li><a href="{{route('allServices', 'dining')}}">Dining</a></li>
                        <li><a href="{{route('allServices', 'meeting-and-conferences')}}">Meeting and Conference</a></li>
                        <li><a href="{{route('blogs')}}">Blogs</a></li>
                        <li><a href="{{route('testimonials')}}">Review</a></li>
                        <li><a href="{{route('contactUs')}}">Contact</a></li>
                        
                        <li>
                            <a href="#" class="desktop-burger-menu">
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                            </a>
                            <div class="dropdown_wrapper">
                               
                                
                                
                                <ul class="dropdown_menu">
                                    @if(isset($dashboard_menu))
                                    @foreach($dashboard_menu as $menu)
                                    <li>
                                        <a href="{{route('serviceDetail', $menu->slug)}}">{{$menu->title}}</a>
                                    </li>
                                   
                                    @endforeach
                                    @endif
                                    <li><a href="{{route('allGalleries')}}">Gallery</a></li>
                                </ul>
                                
                                
                                
                            </div>
                        </li>
                        <!--<li><a href="{{route('bookNow')}}" class="book__button">Book Now</a></li>-->
                         <li><span class="all_book_btn book__button">Book Now</span></li>

                        <div class="book_form_slide">
                            <span class="close-btn">X</span>
                            @include('front.include.formInner')
                        </div>
                    </ul>
                    
                </nav>
                <div class="top-menu-bar">
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                </div>
            </div>
        </div>
    </header>
        <!-- <section class=" inner-page-form">
            <div class="container">
                <form class="room-booking-form" action="">
                    <div class="row">
                        <div class="col-lg-2 col-md-6 col-12 padding-wrapp">
                            <input type="text" placeholder="Check In" id="arrive_index" name="arrive_index">
                        </div>
                        <div class="col-lg-2 col-md-6 col-12 padding-wrapp">
                            <input type="text" placeholder="Check Out" id="departure_index" name="departure_index">
                        </div>
                        <div class="col-lg-2 col-md-6 col-12 padding-wrapp">
                            <div id="options" class="dropdown">
                                <div class="title">
                                    Room Type
                                </div>
                                <ul class="sub_menu">
                                    <li>Twins Room</li>
                                    <li>Couple Room</li>
                                    <li>Deluxe Room</li>
                                    <li>Heritage Room</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-12 padding-wrapp">
                            <div class="wrapper">
                                <div class="main-nav">No.of Rooms</div>
                                <ul class="drop-item">
                                    <div class="room-number">
                                        <p>Select room</p>
                                        <div class="number-wrapper1">
                                            <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                            <input type="number" id="number" value="0" />
                                            <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                
                        <div class="col-lg-2 col-md-6 col-12 padding-wrapp">
                            <div class="people-wrapp">
                                <input type="text" placeholder="Promo Code">
                            </div>
                            <div class="number">
                                <div class="room-1">
                                    <p class="people-name">Room 1</p>
                                    <div class="people-wrapper">
                                        <p>Adults</p>
                                        <div class="number-wrapper">
                                            <span>-</span>
                                            <p>25</p>
                                            <span>+</span>
                                        </div>
                                    </div>
                                    <div class="people-wrapper">
                                        <p>Childs</p>
                                        <div class="number-wrapper">
                                            <span>-</span>
                                            <p>10</p>
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-12 padding-wrapp">
                            <a href="room-display.php" class="site-btn">Check Availiblity</a>
                        </div>
                    </div>
                </form>
            </div>
        </section> -->
        
        <button class="book-top-btn"><img src="{{asset('front/images/support.png')}}" alt="images/support.png"><p>Book Now</p></button>

    <div class="blank-div"></div>
    <!-- header section ends -->
    @yield('content')
    <!-- footer section starts -->
<a href="javascript:" id="return-to-top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>

<footer>
    <div class="map-section" id="contact-link">
        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.1280568075617!2d85.33076981453772!3d27.682436733194262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1941bee8fd3b%3A0x32ba8029d5f9110e!2sWeb%20House%20Nepal%20Pvt.%20Ltd.!5e0!3m2!1sen!2snp!4v1571729882534!5m2!1sen!2snp" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14129.706074406991!2d85.3502167!3d27.7041144!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6e21e88da37e8f35!2sHotel%20Ananda%20%7C%20Ananda%20Pashupati!5e0!3m2!1sen!2snp!4v1603947439674!5m2!1sen!2snp" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>

        <form action="" class="footer-form">
            <input type="text" placeholder="Name">
            <input type="email" placeholder="Email">
            <textarea placeholder="Message"></textarea>
            <button>Send</button>
            <ul class="contact-info">
                <li><i class="fa fa-phone" aria-hidden="true"></i>{{$dashboard_setting->phone}}</li>
                <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>{{$dashboard_setting->email}}</a></li>
                <li><a href="https://g.page/hotel-ananda-inn?share"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$dashboard_setting->address}}</a></li>
            </ul>
        </form>
    </div>
    <div class="main-footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="footer-col-wrapper">
                        <a class="footer-logo" href="{{route('home')}}"><img src="{{asset('front/images/ananda_logo.png')}}"></a>
                        <ul class="social-media">
                            <li><a href="{{$dashboard_setting->facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            
                            <!-- <li><a href="{{$dashboard_setting->twitter}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li> -->
                            <li><a href="{{$dashboard_setting->instagram}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="footer-col-wrapper">
                        <h3>Quick Links</h3>
                        <ul class="footer-link">
                            <li><a href="{{route('page',['terms-and-conditions'])}}">Terms & Condition</a></li>
                            <li><a href="{{route('page',['privacy-and-policy'])}}">Privacy & Policy</a></li>
                            <li><a href="{{route('teams')}}">Team</a></li>
                            <!-- <li><a href="gallery-listing.php">Gallery</a></li> -->
                            <!-- <li><a href="video-listing.php">Video Gallery</a></li> -->
                            <!-- <li><a href="blog.php">Media</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="footer-col-wrapper">
                        <h3>Newsletter</h3>
                        <p>Subscribe us for our updates</p>
                        <form action="" class="newsletter">
                            <input type="text" placeholder="">
                            <button>Subscribe</button>
                        </form>
                        <a class="batas-logo" href="http://batas.com/" target="_blank"><img src="{{asset('front/images/batas.png')}}" alt="batas"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="main-footer">
    <div class="container">
        <div class="designer-name">
            <p>Designed & Developed By : <a href="https://webhousenepal.com/">Web House Nepal</a></p>
        </div>
    </div>
</div>



<script src="{{asset('front/js/jquery-3.4.1.min.js')}}"></script>

<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/jquery.flexslider-min.js')}}"></script>
<script src="{{asset('front/js/lightbox.min.js')}}"></script>
<script src="{{asset('front/js/wow.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>-->
<script src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{asset('js/jquery.validate.js')}}"></script>
<script src="{{asset('front/js/custom.js')}}"></script>
<script>
        $('#roomBooking').validate();
    // $('#arrival_top').Zebra_DatePicker({
    //     disabled_dates:true,
    //     direction: true,
    //     pair: $('#departure_top')
    // });
    // $('#arrive_index').Zebra_DatePicker({
    //     disabled_dates:true,
    //     direction: true,
    //     pair: $('#departure_index')
    // });



    // $('#departure_top, #departure_index').Zebra_DatePicker({
    //     direction: 1
    // });
    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

    $('#check_in_date').datepicker({
        autoclose: true,
        startDate: today ,
        format: 'yyyy-mm-dd'
      }).on('change', function() {
        $(this).valid();  // triggers the validation test
        // '$(this)' refers to '$("#datepicker")'
    });
    $('#check_out_date').datepicker({
        autoclose: true,
        startDate: today ,
        format: 'yyyy-mm-dd'
    }).on('change', function() {
        $(this).valid();  // triggers the validation test
        // '$(this)' refers to '$("#datepicker")'
    });
    
    //inner form
    
    $('.check_in_inner').datepicker({
        autoclose: true,
        startDate: today ,
        format: 'yyyy-mm-dd'
      }).on('change', function() {
        $(this).valid();  // triggers the validation test
        // '$(this)' refers to '$("#datepicker")'
    });
    $('#check_out_inner').datepicker({
        autoclose: true,
        startDate: today ,
        format: 'yyyy-mm-dd'
    }).on('change', function() {
        $(this).valid();  // triggers the validation test
        // '$(this)' refers to '$("#datepicker")'
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
        $('.subinner').click(function(){
            value=parseInt($('.number_of_rooms_inner').val(),10);
            $('#room-'+value).remove();
            
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            $('.number_of_rooms_inner').val(value);
            


        });

        $(document).on('click','.roomNumberindex', function() {
            $('.dropItemIndex').slideToggle(50);
        });
        $(document).on('click','.roomNumber', function() {
            $('.dropItemInner').slideToggle(50);
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
        $('.addinner').click(function(){
            $('.number_of_people_inner').removeClass('d-none');
            value=parseInt($('.number_of_rooms_inner').val(),10);
            value = isNaN(value) ? 0 : value;
            value++;
            
            $(".number_of_rooms_inner").val(value);

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
            $('.number_of_people_inner').append(Add);

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
     


    // $('#arrival_top, #departure_top, #departure_inde#arrive_index').daterangepicker({
    //     "singleDatePicker": true,
    //     "showCustomRangeLabel": false,
        

    // }, function(start, end, label) {
    //     console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    // });
    // $('input[name="arrival_top"]').val('Check In');
    // $('input[name="departure_top"]').val('Check Out');
    // $('input[name="arrive_index"]').val('Check In');
    // $('input[name="departure_index"]').val('Check Out');
</script>
@stack('scripts')







<script type="text/javascript">
   $(function() {
    // Set this variable with the desired height
    var offsetPixels = 670; 

    $(window).scroll(function() {
        if ($(window).scrollTop() > offsetPixels) {
            $( ".scrollingBox" ).css({
                "position": "fixed",
                "top": "150px",
                   "float":"left",
                  


            });
        } else {
            $( ".scrollingBox" ).css({
                "position": "relative",
                "top": "10px",
                "float":"left",
               
            });
        }
    });
});


</script>

</body>

</html>