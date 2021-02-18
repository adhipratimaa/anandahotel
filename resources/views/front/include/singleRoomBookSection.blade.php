<div class="remove">
<?php
    $cart = session()->get('cart');
?>
@php($sum=0)
@foreach($cart as $cart)

    <div class="sidebar-room" id="selectedRoom-{{$cart['id']}}">
        <span class="delete-btn removeButton" data-id="{{$cart['id']}}"><i class="fa fa-trash" aria-hidden="true"></i></span>
        <div class="sidebar-title-wrapper">
            <h3>{{$cart['name']}}</h3> <span>{{$cart['price']*session()->get('date_diff')*$cart['number_of_rooms']}}</span>
        </div>
       <!--  <ul>
            <li><p>Included: Service Charge</p><span>$.500.00</span></li>
            <li>Lorem ipsum dolor sit amet.</li>
            <li><p>Included: City / Local Tax</p><span>$.1000.00</span></li>
            <li>Lorem ipsum dolor sit amet.</li>
        </ul> -->
    </div>
<?php
$total= $cart['price']*session()->get('date_diff')*$cart['number_of_rooms'];
$sum+=$total;
?>
@endforeach
</div>
