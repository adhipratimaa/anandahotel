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
   
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    

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
        
        //adding selected room to cart or checkout form
        $(document).on('click','.addRoom',function(){
            id=$(this).data('id');
                
            
                $.ajax({
                    method:"post",
                    url:"{{route('getDataOfSingleRoom')}}",
                    data:{id:id},
                    success:function(data){
                        console.log(data);
                        if(data.message == 'success'){
                            console.log(data.number_of_rooms);
                            $('.remove').remove();
                            $('.append').append(data.html);
                            total = 'Rs . '+data.sum;
                            no_of_selected_room=$('.sidebar-room').length;
                            if(data.number_of_rooms==number_of_rooms){
                                content = "please checkout";
                            }else{
                                content = "choose your room no "+(data.number_of_rooms+1);
                            }
                           
                            $('.room_message').html("");
                            $('.room_message').html(content);
                            
                            $('#total').html(total);
                        }
                        if(data.message=='fail'){
                            alert('please add room');
                        }
                        
                    }
                });
            
            
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
                    console.log(data);
                    if(data.message){
                        console.log(data.sum);
                        $('#selectedRoom-'+id).remove();
                        $('#total').html(data.sum);
                    }
                    // if($('.room-1').length==0){
                    //     $('#total').html('');
                    // }
                    no_of_selected_room=data.number_of_rooms;

                    content = "choose your room no "+(parseInt(no_of_selected_room)+1);
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
                    if(data=='success'){
                        $('.room-1').remove();
                        $('.no_of_rooms').addClass('d-none');
                        $('.applyButton').addClass('d-none');
                        $('.no_of_rooms').addClass('d-none');
                        $('.number_of_rooms').val(0);
                        no_of_selected_room=$('.sidebar-room').length;
                        content = "choose your room no "+(parseInt(number_of_rooms)+1);
                        number_of_rooms = parseInt(number_of_rooms)+1;
                        $('.room_message').html("");
                        $('.room_message').html(content);
                    }else{
                        $('.room-1').remove();
                        $('.no_of_rooms').addClass('d-none');
                        $('.applyButton').addClass('d-none');
                        $('.no_of_rooms').addClass('d-none');
                        $('.number_of_rooms').val(0);
                    }
                    
                    
                           
                            
                }
            });
        });
    });
    
</script>
@endpush