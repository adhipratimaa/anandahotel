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
                    <p>{{$room->short_description}}</p>
                </div>
                <div class="option-right">
                    <span class="rate">$.{{$room->price}}</span>
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