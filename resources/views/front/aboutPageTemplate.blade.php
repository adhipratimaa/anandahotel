@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">




<section class="about-company-page">
    <div class="company-top-image" style="background-image:url({{asset('images/thumbnail/'.$page->image)}}">
        <div class="container">
            <div class="company-title">
                <h2>{{$page->title}}</h2>
                
            </div>
        </div>
    </div>
{{--
       @include('front.include.formInner')
--}}
    <div class="company-profile-content">
        <div class="container">
            <p>{{$page->short_description}}</p>
        </div>
    </div>
    <div class="who-we-are-wrapper">
        <div class="container">
           <div class="row">
               <div class="col-lg-6 col-md-6 col-6">
                   <div class="who-we-are-content">
                        <h3>{{$page->title}}</h3>
                        <p>{!!$page->description!!}
                        </p>
                       
                   </div>
               </div>



     <div class="col-lg-6 col-md-6 col-6">
             <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">


    <div class="carousel-inner">
        
        
    @foreach($sliders as $key=>$slider)
      <div class="carousel-item {{$key==0?'active':''}}">
        <img class="d-block w-100" src="{{asset('images/thumbnail/'.$slider->image)}}" alt="First slide">
      </div>
    @endforeach
    </div>

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
               </div>






               
           </div>

               <!--  <div class="col-lg-6 col-md-6 col-6">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($sliders as $key=>$slider)
                            <div class="carousel-item {{$key==0?'active':''}}active">
                                <img class=" w-100" src="{{asset('images/thumbnail/'.$slider->image)}}" alt="First slide">
                            </div>
                            @endforeach
                            
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div> -->
            </div>

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
                
                $('.adult'+value).val(newInputValue);

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
                
                $('.child'+value).val(newInputValue);

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
    $(document).ready(function(){
        $(".new-room-btn").on("click", function() {
            $("body").scrollTop(0);
            $('.message').removeClass('d-none');
            $('.message').fadeOut(4000);
            // roomtype_id=roomType.id;
            // console.log(roomtype_id);
        });
    });
</script>
@endpush