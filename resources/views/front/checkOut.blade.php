@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">

<style type="text/css">
.form-control{width: 100%;
padding: 10px 10px; border-radius: 0; height: auto;}
.room-detail-btn{margin-bottom: 30px;}
li.secure-payment{text-align: left;}
li.secure-payment img{width: 24px; }
li.secure-payment h4{margin-bottom: 7px; margin-top: 5px;}
li.secure-payment > div {margin-bottom: 20px;display: block; }

li.secure-payment {
    flex-direction: column;
    /* justify-content: end; */
    /* align-items: flex-end; */
    max-width: 600px;
}

.book__button {
    
    display:none;
}


</style>





@if (count($errors) > 0)
	<div class="alert alert-danger message">
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

<section class="final-room-page">
    {{--<div class="room-top-image" style="background-image:url({{asset('front/images/cafe-1.jpg')}})">
        <div class="container">
            <div class="room-display-title title-wrapper">
                <h2>Ananda Pashupati</h2>
            </div>
        </div>
    </div>--}}
    <div class="room-top-display">
        <div class="container">
            <ul>
                <li><i class="fa fa-calendar" aria-hidden="true"></i>{{carbon\Carbon::parse($check_in_date)->format('Y m d')}} - {{carbon\Carbon::parse($check_out_date)->format('Y m d')}}</li>
                <li><i class="fa fa-users" aria-hidden="true"></i>5 Adults , 2 Childs</li>
                <li><i class="fa fa-bed" aria-hidden="true"></i>2 Rooms  </li>
                <li><i class="fa fa-percent" aria-hidden="true"></i><input type="text" placeholder="Promo Code"></li>
            </ul>
        </div>
    </div>
    <div class="final-wrapper">
        <div class="container">
            
            
    <div class="container">
        <div class="final-top-title">
                <h2>Finalize your stay</h2>
                <p>You get the best rates as there is no middleman: you are on the hotel website.</p>
            </div>
        <div class="booking-process">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="final-hotel-info">
                        <h3 >Guest Information</h3>
                        
                    <div class="gest-info-sec">
                        
                        <form action="{{route('saveBooking')}}" method="post">
                            {{csrf_field()}}
                            
                            <input type="email" placeholder="Email" name="email" required>
                            <!--<label for="">Title</label>-->
                            <!--<div class="title-span">-->
                            <!--    <span>Mr.</span>-->
                            <!--    <span>Ms.</span>-->
                            <!--    <span>Mrs.</span>-->
                            <!--    <span>Dr.</span>-->
                            <!--</div>-->
                            
                            <input type="text" placeholder="First Name"  name="first_name" required>
                            
                            <input type="text" placeholder="Last Name"  name="last_name" required>
                           
                            <input type="text" placeholder="Address" name="address" required>
                      
                            <ul class="phone-wrapper">
                                <li>
                                    <div class="text__center">
                                        <select class="cs-select cs-skin-elastic" name="country_code">
                                           @foreach($countries as $country)
                                           <option value="{{$country->phonecode}}">{{$country->iso3}}({{$country->phonecode}})</option>
                                           @endforeach
                                           
                                            
                                        </select>
                                    </div>
                                </li>
                                <li><input type="number" placeholder="Phone Number" name="phone_number" required></li>
                            </ul>
                       <div class="book-button-wrapper">
                <label for="">Special request</label>
                <textarea name="special_request" id="" cols="" rows="">
                </textarea>
       <input type="submit" name="submit" value="Send Booking Request" class="site-btn room-detail-btn">
              
            </div>
                      
                        
                
                    </div>
                     </div>

                </div>

                <div class="col-lg-8 col-md-12">
                       <div class="final-hotel-info">
                <h3>Your reservation<!--  - from {{carbon\Carbon::parse($check_in_date)->format('Y m d')}} to {{carbon\Carbon::parse($check_out_date)->format('Y m d')}} --></h3>
                <div class="final-hotel-info-wrapp">
                    <h4>Ananda Pashupati</h4>
                    <ul>
                       
                        <li><span>Check-in <!-- from --></span><p>{{carbon\Carbon::parse($check_in_date)->format('l, M d, Y')}} from 12:00 AM</p></li>
                        <li><span>Check-out <!-- before --></span><p>{{carbon\Carbon::parse($check_out_date)->format('l, M d, Y')}} until 12:00 PM</p></li>
                         <li><span>Total stay</span><p>{{session()->get('date_diff')}} Nights</p></li>
                          <li><span>Address</span><p>{{$dashboard_composer->address}}</p></li>
                        <li><span>Reception is open</span><p>24/7</p></li>
                        <li><span>Spoken languages</span><p>English,Nepali,Hindi</p></li>
                        <li><span>Contact</span><p>{{$dashboard_composer->phone}}</p></li>
                        <li><span>Website</span><p><a href="#">www.webhousenepal.com</a></p></li>
                    </ul>
                </div>
            </div>
                    <div class="final-room-details">
                        @php($sum=0)
        
                    	@foreach($carts as $key=>$cart)
                            
                        <ul class="room1-wrap">
                            <li>
                                <h4>{{$cart['name']}} </h4>
                                <h4>Total room: {{$cart['number_of_rooms']}}</h4>
                                <p>{{$cart['adults']}} Adult</p>
                                <p>{{$cart['childs']}} Child</p>
                            </li>
                            <li>
                                
                                 <p>Bedding options: King or Twin</p>
                                <p>Subject to availability</p>
                               
        
                                <!-- <p>Bedding options: Double+Single</p>
                                <p>Best Available Rate</p>
                                <p>Breakfast included: Buffet Breakfast</p> -->
                            </li>
                            <li>
                                <span>Rs.{{$cart['price'] * session()->get('date_diff')*$cart['number_of_rooms']}}</span>
                            </li>
        
        
                            <!--<li class="secure-payment">-->
                            <!--   <div>-->
                            <!--        <p><img src="{{asset('front/images/food.png')}}"></p>-->
                            <!--      <h4>Half-Board</h4>-->
                            <!--        <p>Full Board</p>-->
                            <!--    </div>-->
        
                            <!--    <div>-->
                            <!--         <p><img src="{{asset('front/images/secure-payment.png')}}"></p>-->
                            <!--        <p>-->
                            <!--            <a href="{{url('process-payment')}}"><h4>Pay now</h4></a>-->
                            <!--        </p>-->
                            <!--        <p>Pay the full amount of the reservation-->
                            <!--        online in a secure Environment </p>-->
                            <!--    </div>-->
                            <!--</li>-->
        
        
        
                        </ul>
                        
                        <?php
                        $total= $cart['price']*session()->get('date_diff')*$cart['number_of_rooms'];
                        $sum+=$total;
                        ?>
                        @endforeach
                        <div class="room-total-wrapp">
                            <ul>
                                <?php
        
                                    if($promo){
                                        $discount=$promo->discount;
                                        $dicounted_amount=$discount/100*$sum;
        
                                        $total=$sum-$dicounted_amount;
                                    }else{
                                        $total=$sum;
                                    }
                                    
                                ?>
                                @if($promo)
                                <li><h4>Discount({{$promo->discount}}%) </h4><span>Rs. {{$dicounted_amount}}</span></li>
                                <li><h4>Total </h4><span>Rs. {{$total}}</span></li>
                                @else
                                <li><h4>Total</h4><span>Rs. {{$total}}</span></li>
                                @endif
                                <!-- <li><p>Included: Service Charge</p><span class="small-rate">Rs.1000</span></li>
                                <li><p>Included: City / Local Tax</p><span class="small-rate">Rs.1000</span></li> -->
                                <!-- <li class="secure-payment"> -->
                                   <!--<div>-->
                                   <!--     <p><img src="{{asset('front/images/food.png')}}"></p>-->
                                   <!--   <h4>Half-Board</h4>-->
                                   <!--     <p>Full Board</p>-->
                                   <!-- </div>-->
            
                                   <!-- <div>-->
                             
                                       <!--  <p>
                                            <a href="{{url('process-payment')}}">
                                                <img src="{{asset('front/images/secure-payment.png')}}">
                                                <h4>Pay now</h4>
                                            </a>
                                        </p>
                                        <p>Pay the full amount of the reservation
                                        online in a secure Environment </p> -->
                                  
                                <!-- </li> -->
                            </ul>
                        </div>
                        

                        <!--<div class="book-button-wrapper">-->
                        <!--    <label for="">Special request</label>-->
                        <!--    <textarea name="" id="" cols="" rows="">-->
                        <!--    </textarea>-->
                        <!--</div>-->
                        
                    </div>
                 
                </div>
                
                
                
                        <!-- <div class="col-lg-6 col-md-6 col-12">-->
                        <!--                                <div class="gest-info-sec">-->
                        <!--                                    <h3>Reservation Guarantee</h3>-->
                        <!--                                    <p><strong>Full payment will be charged on your credit card upon booking.</strong></p>-->
                        <!--                                    <p>Our reseervation system is secure</p>-->
                                    
                                    
                                    
                        <!--              <div class="form-group row">-->
                        <!--                <label for="" class="col-sm-12 col-form-label">Credit Card Number</label>-->
                        <!--                <div class="col-sm-12">-->
                        <!--                  <input type="text" class="form-control"  placeholder="XXXXXXX">-->
                        <!--                </div>-->
                        <!--              </div>-->
                        <!--              <div class="form-group row">-->
                        <!--                <label for="inputPassword" class="col-sm-12 col-form-label">Name On Card</label>-->
                        <!--                <div class="col-sm-12">-->
                        <!--                  <input type="text" class="form-control"  id="inputPassword" placeholder="Jane Doe">-->
                        <!--                </div>-->
                        <!--              </div>-->
                                    
                        <!--             <div class="form-group  row">-->
                        <!--                 <label for="" class="col-sm-12 col-form-label">Expiration date</label>-->
                        <!--                <div class="col">-->
                        <!--                  <input type="date" class="form-control" placeholder="">-->
                        <!--                </div>-->
                        <!--                <div class="col">-->
                        <!--                  <input type="date" class="form-control" placeholder="">-->
                        <!--                </div>-->
                        <!--              </div>-->
                                    
                                    
                        <!--                <div class="form-group row">-->
                        <!--                <label for="" class="col-sm-12 col-form-label">Security Code</label>-->
                        <!--                <div class="col-sm-12">-->
                        <!--                  <input type="number" class="form-control"  placeholder="">-->
                        <!--                </div>-->
                        <!--              </div>-->
                                    
                                    
                                        
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                        <!--                    </div>-->
        </div>
        
         </div>
</section>
</form>
            
            
            
    </div>






@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    var success_message = <?php $session = session()->get('success_message'); echo json_encode($session);?>;

    $(window).on('load',function(){
        if(success_message =='message'){
            console.log(success_message);
            DataSuccessInDatabase2('Your booking request has been sent. We will contact you soon for confirmation.');
        }

        function DataSuccessInDatabase2(message){
        Swal.fire({
            //position: 'top-end',
            type: 'success',
            title: 'Success',
            html: message ,
            confirmButtonColor:"white",
            denyButtonColor:"blue",
            cancelButtonColor:"red",
            confirmButtonText: '<a href="{{route('home')}}">Home</a>',
            
            
            timer: 20000
        });
    }
        
    });


</script>
@endpush