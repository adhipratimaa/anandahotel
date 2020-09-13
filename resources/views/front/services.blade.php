@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">



<section class="services-page">
    <div class="services-top-image" style="background-image:url({{asset('front/images/slide-02.jpg')}})">
        <div class="container">
            <div class="services-detail-title">
                <h2>Our Services</h2>
            </div>
        </div>
    </div>
    @include('front.include.formInner')
    <div class="services-detail-content">
        <div class="container">
            

            <div class="service-detail-tab row">
               <div class="col-lg-2 col-md-12 col-12">
                    <div class="service-detail-tab-wrapper">
                        <ul class="nav nav-tabs nav-tabs2" role="tablist">
                        	@foreach($services as $k=>$service)
                            <li class="nav-item wow zoomIn" data-wow-duration="2s"><a class='nav-link {{$k==0?"active":""}}' href="#s{{$service->id}}" role="tab" data-toggle="tab">
                                    <div class="image-wrapper"><img src="{{asset('images/main/'.$service->logo)}}"></div><span>{{$service->title}}</span>
                                </a></li>
                            
                            @endforeach
                            
                           
                        </ul>
                    </div>
               </div>
                <!-- Tab panes -->
                <div class="col-lg-10 col-md-12 col-12">
                    <div class="tab-content tab-content2">
                    	 @foreach($services as $key=>$serv)
                        <div role="tabpanel" class="tab-pane {{$key==0?'in show active':''}}" id="s{{$serv->id}}">
                            <div class="row row-wrapper">
                                <div class="col-lg-6 col-md-12 col-12">
                                    <div class="tab-content-image wow zoomIn" data-wow-duration="2s">
                                        <img src="{{asset('images/thumbnail/'.$serv->image)}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-12">
                                    <div class="tab-content-side wow slideInRight" data-wow-duration="2s">
                                        <h3>{{$serv->title}}</h3>
                                        <p>{!!$serv->description!!}</p>
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



@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.ananta').click(function(){
            $('.ananta').removeClass('active');
            $(this).addClass('active');
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
</script>
@endpush