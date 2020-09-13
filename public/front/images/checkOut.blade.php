@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">

<style type="text/css">
.form-control{width: 100%;
padding: 10px 10px; border-radius: 0; height: auto;}
.room-detail-btn{margin-bottom: 30px;}
.secure-payment{text-align: center; border-left: 1px solid #ccc;}
.secure-payment img{width: 24px; }
.secure-payment h4{margin-bottom: 7px; margin-top: 5px;}
.secure-payment > div {margin-bottom: 20px;display: block; }


</style>







<section class="final-room-page">
    <div class="room-top-image" style="background-image:url({{asset('front/images/cafe-1.jpg')}})">
        <div class="container">
            <div class="room-display-title title-wrapper">
                <h2>Ananda Pashupati</h2>
            </div>
        </div>
    </div>
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
            <div class="final-top-title">
                <h2>Finalize your stay</h2>
                <p>You get the best rates as there is no middleman: you are on the hotel website.</p>
            </div>
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
                    <?php
                    $roomtype = \App\Models\RoomType::find($cart['roomtype_id']);

                    ?>
                <ul class="room1-wrap">
                    <li>
                        <h4>Room {{$key}}</h4>
                        <p>{{$cart['adults']}} Adult</p>
                        <p>{{$cart['childs']}} Child</p>
                    </li>
                    <li>
                        <p>{{$roomtype->name}}</p>
                         <p>Bedding options: King or Twin</p>
                        <p>Subject to availability</p>
                       

                        <!-- <p>Bedding options: Double+Single</p>
                        <p>Best Available Rate</p>
                        <p>Breakfast included: Buffet Breakfast</p> -->
                    </li>
                    <li>
                        <span>Rs.{{$cart['price'] * session()->get('date_diff')}}</span>
                    </li>


                        <li class="secure-payment">
                       <div>
                        <p><img src="{{asset('front/images/food.png')}}"></p>
                      <h4>Half-Board</h4>
                        <p>Full Board</p>
                    </div>

                    <div>

                         <p><img src="{{asset('front/images/secure-payment.png')}}"></p>
                        <p><h4>Pay now</h4></p>
                        <p>Pay the full amount of the reservation
                        online in a secure Environment </p>
                        </div>
                    </li>



                </ul>
                
                <?php
                $total= $cart['price']*session()->get('date_diff');
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
                    </ul>
                </div>









     <div class="book-button-wrapper">
                <label for="">Special request</label>
                <textarea name="" id="" cols="" rows="">
                </textarea>
           
              
            </div>





            
        </div>
    </div>




    <div class="container">
        <div class="booking-process">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="gest-info-sec">
                        <h3>Guest Information</h3>
                        <form action="{{route('saveBooking')}}" method="post">
                            {{csrf_field()}}
                            <label for="">E-mail Address</label>
                            <input type="email" placeholder="" name="email">
                            <label for="">Title</label>
                            <div class="title-span">
                                <span>Mr.</span>
                                <span>Ms.</span>
                                <span>Mrs.</span>
                                <span>Dr.</span>
                            </div>
                            <label for="">First Name</label>
                            <input type="text" placeholder="" value="" name="first_name">
                            <label for="">Last Name</label>
                            <input type="text" placeholder="" value="" name="last_name">
                            <label for="">phone Number</label>
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
                                <li><input type="text" placeholder="" name="phone_number"></li>
                            </ul>
                        
                    </div>
                </div>

                
     <div class="col-lg-6 col-md-6 col-12">
                    <div class="gest-info-sec">
                        <h3>Reservation Guarantee</h3>
                        <p><strong>Full payment will be charged on your credit card upon booking.</strong></p>
                        <p>Our reseervation system is secure</p>


<form>
  <div class="form-group row">
    <label for="" class="col-sm-12 col-form-label">Credit Card Number</label>
    <div class="col-sm-12">
      <input type="text" class="form-control"  placeholder="XXXXXXX">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-12 col-form-label">Name On Card</label>
    <div class="col-sm-12">
      <input type="text" class="form-control"  id="inputPassword" placeholder="Jane Doe">
    </div>
  </div>

 <div class="form-group  row">
     <label for="" class="col-sm-12 col-form-label">Expiration date</label>
    <div class="col">
      <input type="date" class="form-control" placeholder="">
    </div>
    <div class="col">
      <input type="date" class="form-control" placeholder="">
    </div>
  </div>


    <div class="form-group row">
    <label for="" class="col-sm-12 col-form-label">Security Code</label>
    <div class="col-sm-12">
      <input type="number" class="form-control"  placeholder="">
    </div>
  </div>


    




</form>


        </div>
    </div>

     <input type="submit" name="submit" value="Book" class="site-btn room-detail-btn">
</section>


@endsection