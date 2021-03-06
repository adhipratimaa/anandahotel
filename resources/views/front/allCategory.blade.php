@extends('layouts.front')
@section('content')



    <link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">





        <section class="new-room-background" style="background-image:url({{asset('front/images/cafe2.jpg')}}">
            <div class="container">
                <div class="title-wrapper room-page-title">
                    <h2>All Categories</h2>
                </div>
                
                @include('front.include.formInner')

                <div class="whole-container-wrapper">
                    @foreach($roomTypes as $roomType)
                    <div class="row new-room-whole-wrapper">
                        <div class="col-lg-5 col-md-6 col-12 p-0">
                            <div class="flexslider room-listing-slider">
                                <ul class="">

                                    <li><a href="#" class="new-room-wrapper"><img src="{{asset('images/thumbnail/'.$roomType->image)}}"></a></li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 pr-0">
                            <div class="new-room-content-wrapp">
                                <a href="room-detail.php"><h3>{{$roomType->name}}</h3></a>
                                <p>{{$roomType->short_description}}</p>


                        <!-- <span>$.{{$roomType->price}}/Night</span> -->
                      <button class="sub-category-btn btn btn-danger"> Book Now</button>
                     

                              <!--       <button class="sub-category-btn btn btn-danger" data-id="{{$roomType->id}}">View more Rooms</button> -->
                                    <!-- <a class="view-room-btn" href="room-detail.php">View Room<i class="fa fa-angle-double-right" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 p-0">
                            <div class="new-room-includes-wrapp">
                                <ul>
                                    @foreach($roomType->features as $feature)
                                    <li class="wow zoomIn" data-wow-duration="2s"><img src="{{asset('images/main/'.$feature->image)}}">{{$feature->title}}</li>
                                    @endforeach
                                    

                                </ul>

                                <!-- <ul class="moretext less-content">          
                                    <li class="wow zoomIn" data-wow-duration="2s"><img src="images/DqYz6-towel.png">Towel</li>
                                    <li class="wow zoomIn" data-wow-duration="2s"><img src="images/6ZLer-closet.png">Clothes Rack</li>   
                                    <li class="wow zoomIn" data-wow-duration="2s"><img src="images/al4Jn-sofa.png">Seating Area</li>
                                    <li class="wow zoomIn" data-wow-duration="2s"><img src="images/DC9CI-safe.png">Personal Safe</li>
                                    <li class="wow zoomIn" data-wow-duration="2s"><img src="images/ec9xY-breakfast.png">Break Fast</li>
                                    <li class="wow zoomIn" data-wow-duration="2s"><img src="images/DqYz6-towel.png">Towel</li>
                                    <li class="wow zoomIn" data-wow-duration="2s"><img src="images/6ZLer-closet.png">Clothes Rack</li>
                                </ul>
                                <button class="moreless-button">Show more <i class=" fa fa-angle-down"></i></button> -->
                            </div>
                        </div>
                 <div class="col-lg-2 col-md-6 col-12 p-0 new-room-btn-top-wrapper">
                          <!-- <div class="new-room-price-wrapper">
                       <span>$.{{$roomType->price}}/Night</span>
                       <a class="site-btn new-room-btn" href="#">Book Now</a>
                      </div> -->
                       </div>
                        <div class="sub-category-wrapp" id="room{{$roomType->id}}">
                            @foreach($roomType->rooms()->where('publish',1)->get() as $room)
                            <div class="row new-room-whole-wrapper sub-category">
                                <div class="col-lg-6 col-md-6 col-12 pr-0">
                                    <div class="new-room-content-wrapp">
                                        <a href="#"><h3>{{$room->name}}</h3></a>
                                        <p>{{$room->short_description}}</p>
                                            <!-- <a class="view-room-btn" href="room-detail.php">View Room<i class="fa fa-angle-double-right" aria-hidden="true"></i></a> -->
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 p-0">
                                    <div class="new-room-includes-wrapp">
                                        <ul>
                                            @foreach($room->features as $feature)
                                            <li class="wow zoomIn" data-wow-duration="2s"><img src="{{asset('images/main/'.$feature->image)}}">{{$feature->title}}</li>
                                            @endforeach
                                            

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-12 p-0 new-room-btn-top-wrapper">
                                    <div class="new-room-price-wrapper">

                                        <!-- <span>$.{{$room->price}}/Night</span> -->
                                        <a class="site-btn new-room-btn new-room-btn" href="#">Book Now</a>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                
                    </div>
                    @endforeach
                    
                    <!-- <ul class="pagination">
                        <li><a href="#"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
                        <li><a class="active" href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
                    </ul> -->
                </div>
            </div>
           
        </section>

@endsection
@push('scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        $('.sub-category-btn').click(function(e){
            e.preventDefault();
            $("body").scrollTop(0);
            $('.message').removeClass('d-none');
            setTimeout(addClass,3000);
        });
        function addClass(){
           $('.message').addClass('d-none');
        }
    });

    $(document).ready(function(){
        $(document).on('click','.addRoom',function(){
            id=$(this).data('id');
            if($('#selectedRoom-'+id).length>0){
                console.log('error');
            }else{
                $.ajax({
                    method:"post",
                    url:"{{route('getDataOfSingleRoom')}}",
                    data:{id:id},
                    success:function(data){
                        if(data.status){
                            $('.append').append(data.html);
                        }
                        
                    }
                });
            }
            
        });
    });
</script>
@endpush
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
            inputValue=parseInt($('.adult'+value).val());
            if(parseInt($('.adult'+value).val()) + parseInt($('.child'+value).val())<roomCapacity){
                newInputValue=inputValue+1;
                if(newInputValue<=2){
                    $('.adult'+value).val(newInputValue);
                }
                

            }else{
                $('#error'+value).removeClass('d-none')
            }
           

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

        $(document).on('click','.removeButton',function(){
            id=$(this).data('id');
            
            $.ajax({
                url:"{{route('removeRoom')}}",
                data:{id:id},
                method:"post",
                success:function(data){
                    
                    if(data.message){
                        $('#selectedRoom-'+id).remove();
                    }
                }
            });
        })
    });

    // $(document).ready(function(){
    //     $(".new-room-btn").on("click", function(e) {
    //         e.preventDefault();
    //         $("body").scrollTop(0);
    //         $('.message').removeClass('d-none');
    //         setTimeout(addClass,3000);
    //         // roomtype_id=roomType.id;
    //         // console.log(roomtype_id);
    //     });
    //      function addClass(){
    //         $('.message').addClass('d-none');
    //      }
    // });
</script>
@endpush