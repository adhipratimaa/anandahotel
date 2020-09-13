


<section class="room-booking-form-sec" id="form_section">
    <div class="container">
    <div class="error message d-none" >

        <div class="icon">
<i class="fa fa-frown-o" aria-hidden="true"></i>
</div>

        <p>Please fill the information</p>
    </div>
        @if (count($errors) > 0)
        <div class="alert message msg">
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
        <!-- <input type="text" name="date" id="date" autocomplete="off"> -->
        <form class="room-booking-form" action="{{route('searchRoom')}}" method="get" id="roomBooking">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 padding-wrapp calendar">
                    <!-- <label>Arrival Date</label> -->
                    <input type="text" name="check_in_date" id="check_in_date" autocomplete="off" placeholder="Check In" >
                </div>
                <div class="col-lg-3 col-md-6 col-12 padding-wrapp calendar">
                    <!-- <label>Departure Date</label> -->
                    <input type="text" name="check_out_date" id="check_out_date" autocomplete="off" placeholder="Check Out" >
                </div>
                <!-- <div class="col-lg-2 col-md-6 col-12 padding-wrapp">
                   
                    <input type="hidden" name="roomtype_id" value="" class="roomtype_id">
                    <div id="options" class="dropdown">
                        <div class="title">
                            Room Type
                        </div>
                        <ul class="sub_menu">
                            @foreach($roomTypes as $roomtype)
                            <li class="roomtype" data-id="{{$roomtype->id}}">{{$roomtype->name}}</li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div> -->
                <div class="col-lg-2 col-md-6 col-12 padding-wrapp">
                    <div class="wrapper">
                        <div class="main-nav roomNumber">No.of Rooms</div>

                        <ul class="drop-item">
                            <div class="room-number">
                                <p>Select room</p>
                                <form>
                                    <div class="value-button sub" id="decrease"  value="Decrease Value">-</div>
                                    <input type="number" id="number" value="0" class="number_of_rooms" name="number_of_rooms" />
                                    <div class="value-button add" id="increase" value="Increase Value">+</div>
                                </form>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12 padding-wrapp">
                    <div class="people-wrapp">
                        <input type="text" placeholder="Promo Code" name="promo_code">
                    </div>
                    <div class="number number_of_people ">
                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12 padding-wrapp">
                    <input type="submit" name="submit" value="Check Availiblity" class="site-btn">
                    
                </div>
            </div>
        </form>
    </div>
</section>


