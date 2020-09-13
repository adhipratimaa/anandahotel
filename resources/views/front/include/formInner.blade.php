<section class=" inner-page-form" id="inner-form">
    <div class="alert-warning error message d-none" >
        <div class="icon">
<i class="fa fa-frown-o" aria-hidden="true"></i>
</div>
        <p>Please fill the information</p>
    </div>
    <div class="container">
        @if (count($errors) > 0)
        <div class="error alert alert-danger message msg">
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
        <form class="room-booking-form" action="{{route('searchRoom')}}" method="get">
            {{csrf_field()}}
           
            <div class="row">
                
                <div class="col-lg-3 col-md-6 col-12 padding-wrapp">
                    <?php
                        $route_name = Request::route()->getName();
                    ?>
                    {{--
                    @if($route_name=='searchRoom')
                    <div class="whole-filter-wrapp">
                        <div class="filter-wrapper">
                            <span class="filter-icon"><i class="fa fa-filter" aria-hidden="true"></i></span> 
                        </div>
                        <div class="filter-container">
                            <div class="filter-box-wrapper">
                                <input type="hidden" name="roomtype_id" value="" class="roomtype_id">
                                <div id="options1" class="dropdown1">
                                    <div class="title1">
                                        Filter by Room Type
                                    </div>
                                    <ul class="sub_menu1">
                                        @foreach($roomTypes as $roomtype)
                                        <li class="roomtype filterByRoomType" data-id="{{$roomtype->id}}">{{$roomtype->name}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-box-wrapper">
                                <div id="options2" class="dropdown5">
                                    <div class="title2">
                                        Filter by price
                                    </div>
                                    <ul class="sub_menu2">
                                        <li class="filterByPrice" data-value="lowtohigh">Low to High</li>
                                        <li class="filterByPrice" data-value="hightolow">Hight to Low</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    --}}
                    @if(session()->get('check_in_date'))

                    <input style="width: 100%" class="date-check" type="text" name="check_in_date" id="check_in_date" autocomplete="off" placeholder="Check In" value="{{session()->get('check_in_date')}}">
                    @else
                    <input type="text" style="width: 100%" name="check_in_date" id="check_in_date" autocomplete="off" placeholder="Check In" value="">
                    @endif
                </div>
                <div class="col-lg-3 col-md-6 col-12 padding-wrapp">
                    @if(session()->get('check_out_date'))
                    <input type="text" name="check_out_date" id="check_out_date" autocomplete="off" placeholder="Check Out" value="{{session()->get('check_out_date')}}">
                    @else
                    <input type="text" name="check_out_date" id="check_out_date" autocomplete="off" placeholder="Check Out" value="">
                    @endif
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
                                <div class="number-wrapper1">
                                    <div class="value-button sub" id="decrease" value="Decrease Value">-</div>
                                    <input type="number" id="number" value="0" class="number_of_rooms" name="number_of_rooms" />
                                    <div class="value-button add" id="increase" value="Increase Value">+</div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            
                <div class="col-lg-2 col-md-6 col-12 padding-wrapp">
                    <div class="people-wrapp">
                        <input type="text" placeholder="Promo Code" name="promo_code">
                    </div>
                    <div class="number number_of_people">
                        
                    </div>
                   
                </div>
                <div class="col-lg-2 col-md-6 col-12 padding-wrapp">
                    <input type="submit" name="" class="site-btn submitButton" value="Check Availiblity">
                    <!-- <a href="room-display.php" class="site-btn">Check Availiblity</a> -->
                </div>
            </div>
        </form>
    </div>
</section>