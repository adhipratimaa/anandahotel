<div class="sidebar-room" id="selectedRoom-{{$room->id}}">
    <span class="delete-btn removeButton" data-id="{{$room->id}}"><i class="fa fa-trash" aria-hidden="true"></i></span>
    <div class="sidebar-title-wrapper">
        
        <h3>{{$room->name}}</h3> <span>Rs.{{session()->get('date_diff')*$room->price}}</span>
        
    </div>
   <!--  <ul>
        <li><p>Included: Service Charge</p><span>Rs.500.00</span></li>
        <li>Lorem ipsum dolor sit amet.</li>
        <li><p>Included: City / Local Tax</p><span>Rs.1000.00</span></li>
        <li>Lorem ipsum dolor sit amet.</li>
    </ul> -->
</div>