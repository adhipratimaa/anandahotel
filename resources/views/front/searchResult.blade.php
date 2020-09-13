@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">





<section class="room-display-page">
    <div class="room-top-image" style="background-image:url({{asset('front/images/cafe-1.jpg')}}">
        <div class="container">
            <div class="room-display-title title-wrapper">
                <h2>Ananda Hotel</h2>
            </div>
        </div>
    </div>
       <div class="container">
            @if (count($errors) > 0)
            <div class="alert alert-danger error message">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
       </div>

        
    @include('front.include.formInner')
    <div class="room_message"><div class="container">
        <div class="roommsg">
        choose your room 1
    </div>
    </div>


    </div>
    <div class="room-top-display">
        <div class="container">
            <ul>
                <li><i class="fa fa-calendar" aria-hidden="true"></i>20 january - 25 january</li>
                <li><i class="fa fa-users" aria-hidden="true"></i>5 Adults , 2 Childs</li>
                <li><i class="fa fa-bed" aria-hidden="true"></i>2 Rooms  </li>
                <li><i class="fa fa-percent" aria-hidden="true"></i><input type="text" placeholder="Promo Code"></li>
            </ul>
        </div>
    </div>
    <div class="room-displsy-wrapper">
        <div class="container">
            <div class="row whole-room">
                <div class="col-lg-8">
                    <div class="room-display-listing">
                        
                        <div class="room-option">
                            @foreach($all_rooms as $room)
                            <div class="row room-option-parent">
                                <div class="col-lg-4 col-md-4 col-12 pl-0">
                                    <div class="option-image-wrapp">
                                        <img src="{{asset('images/thumbnail/'.$room->image)}}">
                                        <h3>{{$room->name}}</h3>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-12 pl-0">
                                   <div class="room-option-wrapper">
                                        <div class="option-info-wrapp">
                                            <div class="option-left">
                                                <p>{{str_limit($room->short_description,200)}}</p>
                                            </div>
                                            <div class="option-right">
                                                <span class="rate">Rs.{{$room->price}}</span>
                                                <p>Price for 1 Night</p>
                                                <ul>
                                                    <!-- <li>1 Adult,0 Child,1 Room</li> -->
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="option-book option-info-wrapp">
                                            <div class="option-left">
                                                <!-- <p class="room-option-info"><i class="fa fa-plus-circle" aria-hidden="true"></i>Room Info</p> -->
                                            </div>
                                            <div class="option-right">
                                                <button class="site-btn addRoom" id="addRoom_{{$room->id}}" data-id="{{$room->id}}" >Select Room</button>
                                                <!-- <a href="final-room.php" class="site-btn">Check out</a> -->
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="room-display-sidebar">
                        <div class="room-sidebar">
                            <span>Check In
                                <p>{{$checkIn_date}}</p>
                            </span>
                            <span>Check Out
                                <p>{{$checkOut_date}}</p>
                            </span>
                        </div>
                        <div class="append">
                            @if(isset($cart))
                            @php($sum=0)
                            @foreach($cart as $cart)
                                <div class="sidebar-room" id="selectedRoom-{{$cart['id']}}">
                                    <span class="delete-btn removeButton" data-id="{{$cart['id']}}"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                    <div class="sidebar-title-wrapper">
                                        <h3>{{$cart['name']}}</h3> <span>{{$cart['price']*session()->get('date_diff')}}</span>
                                    </div>
                                   <!--  <ul>
                                        <li><p>Included: Service Charge</p><span>$.500.00</span></li>
                                        <li>Lorem ipsum dolor sit amet.</li>
                                        <li><p>Included: City / Local Tax</p><span>$.1000.00</span></li>
                                        <li>Lorem ipsum dolor sit amet.</li>
                                    </ul> -->
                                </div>
                            <?php
                            $total= $cart['price']*session()->get('date_diff');
                            $sum+=$total;
                            ?>
                            @endforeach
                            @endif

                        </div>
                        @if($promo_code)
                        <div class="total">
                            <h3>Promo Code({{$promo_code->promo_code}})</h3>
                            
                            <span>discount {{$promo_code->discount}}%    </span>
                            

                            
                        </div>
                        @endif
                        <div class="total">
                            <h3>Total</h3>
                            
                            <span id="total"> @if(isset($cart)){{$sum}}@endif</span>
                            

                            
                        </div>
                        <div class="check-btn-wrapper">
                            <a class="add-room-btn addNewRoom" href="#">Add Room</a>
                            <div class="no_of_rooms d-none">
                                <div class="room-number">
                                    <p>Select room</p>
                                    <div class="number-wrapper1">
                                        <div class="value-button extrasub" id="decrease" value="Decrease Value">-</div>
                                        <input type="number" id="number" value="0" class="number_of_rooms" name="number_of_rooms" />
                                        <div class="value-button extraadd" id="increase" value="Increase Value">+</div>
                                    </div>
                                </div>
                            </div>

                            <form id="newform" enctype="multipart/form-data" method="post">
                                {{csrf_field()}}
                            <div class="number add-room-form" id="numberofpeople">
                                
                               <!-- <div class="new_room_wrapper">
                                    <div class="add_room_wrapper">
                                        <span class="close_btn">X</span>
                                            <p class="room-name">Room 2</p>
                                            <div class="people-wrapper">
                                                <p>Adults</p>
                                                <div class="number-wrapper">
                                                    <span class="adultMinus" data-value="1">-</span>
                                                    <input type="text" name="adult" value="0" readonly="" class="adult1" id="addedAdult">
                                                    <span class="adultPlus" data-value="1">+</span>
                                                </div>
                                            </div>
                                            <div class="people-wrapper">
                                                <p>Childs</p>
                                                <div class="number-wrapper">
                                                    <span class="adultMinus" data-value="1">-</span>
                                                    <input type="text" name="adult" value="0" readonly="" class="adult1" id="addedAdult">
                                                    <span class="adultPlus" data-value="1">+</span>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="add_room_wrapper">
                                        
                                    </div>
                                    <div class="room_btn_wrapper">
                                        <button>Add Room</button><button>Apply</button>
                                    </div>
                               </div> -->

                               
                            <button class="d-none applyButton" type="submit">Apply</button>
                            </div>
                            
                            </form>
                            <a class="site-btn next-btn" href="{{route('checkOutForm')}}">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    var promo_code = <?php echo json_encode($promo_code);?>;
    var days = <?php echo json_encode(session()->get('date_diff'));?>;
    console.log(days);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(window).on('load',function(e) {
        e.preventDefault();
          no_of_selected_room=$('.sidebar-room').length;

    });

    $(document).ready(function(){
        var number_of_rooms=<?php echo json_encode($number_of_rooms);?>;
        //adding selected room to cart or checkout form
        $(document).on('click','.addRoom',function(){
            id=$(this).data('id');
            
            if($('#selectedRoom-'+id).length>0){
                alert('room already added');
            }else{
                $.ajax({
                    method:"post",
                    url:"{{route('getDataOfSingleRoom')}}",
                    data:{id:id},
                    success:function(data){
                        console.log(data)
                        if(data.status){
                            $('.append').append(data.html);
                            total = 'Rs . '+data.sum;
                            no_of_selected_room=$('.sidebar-room').length;
                            if(no_of_selected_room==data.number_of_rooms){
                                content = "please checkout";
                            }else{
                                content = "choose your room no "+(no_of_selected_room+1);
                            }
                           
                            $('.room_message').html("");
                            $('.room_message').html(content);
                            
                            $('#total').html(total);
                        }else{
                            alert('please add room');
                        }
                        
                    }
                });
            }
            
        });
    });

    $(document).ready(function(){
        
        
        roomCapacity = 4;
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


    // $(document).on("click", function(event){
    //     var $trigger = $(".roomNumber");
    //     if($trigger !== event.target && !$trigger.has(event.target).length){
    //         $(".drop-item").slideUp("50");
    //     }            
    // });




        $('.add').click(function(){
            
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
                    if($('.room-1').length==0){
                        $('#total').html('');
                    }
                    no_of_selected_room=$('.sidebar-room').length;

                    content = "choose your room no "+(no_of_selected_room+1);
                    $('.room_message').html("");
                    $('.room_message').html(content);
                }
            });

        })

        //adding extra room
        $(document).on('click','.addNewRoom',function(e){
           e.preventDefault();
           $('.no_of_rooms').removeClass('d-none');
           $('#numberofpeople').removeClass('d-none');
           
            // if($('#room-1').length==0){
            //     value=1;
            //     Add='<div class="room-1 newRoom" id="room-'+value+'">';
            //     Add+='<span class="max-limit d-none" id="error'+value+'">Max person limit</span>';
            //     Add+='<span class="close-btn removeExtraRoom">x</span>'
            //     Add+='<p class="people-name">Room '+value+'</p>';
            //     Add+='<div class="people-wrapper">'
            //     Add+='<p>Adults</p>'
            //     Add+='<div class="number-wrapper">'
            //     Add+='<span class="adultMinus" data-value="'+value+'">-</span>'
            //     Add+='<input type="text" name="adult" value="0" readonly class="adult'+value+'" id="addedAdult">'
            //     Add+='<span class="adultPlus" data-value="'+value+'">+</span>'
            //     Add+='</div>'
            //     Add+='</div>'
            //     Add+='<div class="people-wrapper">'
            //     Add+='<p>Childs</p>'
            //     Add+='<div class="number-wrapper">'
            //     Add+='<span class="childMinus" data-value="'+value+'">-</span>'
            //     Add+='<input type="text" name="child" value="0" readonly class="child'+value+'" id="addedChild">'
            //     Add+='<span class="childPlus" data-value="'+value+'">+</span>'
            //     Add+='</div>'
            //     Add+='</div>'
            //     Add+='<button class="btn btn-success applyButton" id="apply_'+value+'">apply</button>'
            //     Add+='</div>';
            //     $('#numberofpeople').append(Add);
            //     console.log('appended');


            // }
            
        });
        $(document).on('click','.removeExtraRoom',function(e){
            $('.newRoom').remove();
            // $('.add-room-form').slideToggle(300);
            
        });
       
        

        //filter by category
        $(document).on('click','.filterByRoomType',function(e){
            e.preventDefault();
                id=$(this).data('id');
                
                $.ajax({
                    method:"post",
                    url:"{{route('filterByCategory')}}",
                    data:{id:id},
                    success:function(data){
                        console.log(data);
                        if(data.status==true){
                            console.log('hello');
                            $('.room-option').html('');
                            $('.room-option').append(data.html);

                        }
                    }
                });
        });

        //filter by price
        $(document).on('click','.filterByPrice',function(e){
            e.preventDefault();
                value=$(this).data('value');
                
                $.ajax({
                    method:"post",
                    url:"{{route('filterByPrice')}}",
                    data:{value:value},
                    success:function(data){
                        console.log(data);
                        if(data.status==true){
                            console.log('hello');
                            $('.room-option').html('');
                            $('.room-option').append(data.html);
                            
                        }
                    }
                });
        });

        
    });

    $(document).ready(function(){
        $(document).on('click','.extrasub',function(){
            value=parseInt($('.number_of_rooms').val(),10);
            
            $('#extraroom-'+value).remove();
            
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            $('.number_of_rooms').val(value);
            
            if(value==0){


                $('.applyButton').addClass('d-none');
                $('.no_of_rooms').addClass('d-none');
                $('.add-room-form').addClass('d-none');


            }
        });

        $(document).on('click','.extraadd',function(){
            $('.applyButton').removeClass('d-none');

            $('.no_of_rooms').removeClass('d-none');
            $('#numberofpeople').show();
            value=parseInt($('.number_of_rooms').val(),10);
            value = isNaN(value) ? 0 : value;
            value++;
            
            $(".number_of_rooms").val(value);

            Add='<div class="room-1" id="extraroom-'+value+'">';
            Add+='<span class="max-limit d-none" id="error'+value+'">Max person limit</span>';
            Add+='<p class="people-name">Room '+value+'</p>';
            Add+='<div class="people-wrapper">'
            Add+='<p>Adults</p>'
            Add+='<div class="number-wrapper">'
            Add+='<span class="adultMinus" data-value="'+value+'">-</span>'
            Add+='<input type="text" name="addedadult[]" value="0" readonly class="adult'+value+'" class="addedAdult">'
            Add+='<span class="adultPlus" data-value="'+value+'">+</span>'
            Add+='</div>'
            Add+='</div>'
            Add+='<div class="people-wrapper">'
            Add+='<p>Childs</p>'
            Add+='<div class="number-wrapper">'
            Add+='<span class="childMinus" data-value="'+value+'">-</span>'
            Add+='<input type="text" name="addedchild[]" value="0" readonly class="child'+value+'" class>'
            Add+='<span class="childPlus" data-value="'+value+'">+</span>'
            Add+='</div>'
            Add+='</div>'
            Add+='</div>';
            existed=$('#extraroom-'+value).length;
            if(existed>0){
                $('#extraroom-'+value).removeClass('d-none');
                $('#extraroom-'+value).show();
            }else{
                $('.add-room-form').prepend(Add);
            }
            


        });


    });
    // $(document).ready(function(){
    //     //apply button
    //     $(document).on('click','.applyButton',function(e){
    //         e.preventDefault();
    //         // Get form
    //             var form = $('#newform')[0];
 
    //         // Create an FormData object 
    //         var data = new FormData(form);
    //         console.log(data.serialize());
    //         // adult = $('#addedAdult').val();
    //         // child = $('#addedChild').val();

    //         // answer=$('input[name^="addedAdult"]').each(function() {
    //         //     return $(this).val();
    //         // });
    //         // console.log('tables: ' + JSON.stringify(answer));
            
            
    //             $.ajax({
    //                 method:"post",
    //                 url:"{{route('addPeopleData')}}",
    //                 data:{adult:data},
    //                  processData: false,
    //                 contentType: false,
    //                 success:function(data){
    //                      console.log(data);
                        
                        
                        
    //                 }
    //             });
            

            
            
    //     });
    // });

    //filter
    $(document).ready(function(){
        $('.applyButton').click(function(e){
            e.preventDefault();
            $.ajax({
                method:"post",
                url:"{{route('addPeopleData')}}",
                data:$('#newform').serialize(),
                success:function(data){
                    console.log(data);
                    $('.room-1').remove();
                    $('.no_of_rooms').addClass('d-none');
                    $('.applyButton').addClass('d-none');
                    $('.no_of_rooms').addClass('d-none');
                    no_of_selected_room=$('.sidebar-room').length;
                    content = "choose your room no "+(no_of_selected_room+1);
                    $('.room_message').html("");
                    $('.room_message').html(content);
                    
                           
                            
                }
            });
        });
    });
    
</script>
@endpush