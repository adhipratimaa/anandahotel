<!-- <button class="btn btn-info btn-sm downloadPdfFile" type="button" data-detail_url="{{ route('downloadPdf', $detail->id)}}">Download</button> -->
<a href="{{ route('downloadPdf', $detail->id)}}" class="btn btn-info btn-sm downloadPdfFile" target="_blank">Download</a>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Heading</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $promo=$detail->promo;
      ?>
      <tr class="success">
        <td>Client</td>
        <td>{{$detail->first_name}} {{$detail->last_name}}</td>
      </tr>
      <tr class="danger">
        <td>Email</td>
        <td>{{$detail->email}}</td>
      </tr>
      <tr class="warning">
        <td>Phone</td>
        <td>{{$detail->phone_number}}</td>
      </tr>
      <tr class="success">
        <td>Special Request</td>
        <td>{{$detail->special_request}}</td>
      </tr>
      @if($promo)
      <tr class="success">
        <td>Promo Code</td>
        <td>{{$promo->promo_code}}</td>
      </tr>
      @endif
    </tbody>
  </table>

  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Rooms</h3>
    </div>
    <div class="box-body">
      <table class="table table-bordered">
          <thead>
              <tr>
                <th>S.N.</th>
                <th>Room </th>
                <th>No. of rooms</th>
                <th>CheckIn</th>
                <th>CheckOut</th>
                <th>Price</th>
                <th>Total</th>
              </tr>
            </thead>
          <tbody>
            @php($sum=0)
            @foreach($detail->bookings as $key=>$booking)
            <?php
              $formatted_dt1=\Carbon\Carbon::parse($booking->checkIn_date);

              $formatted_dt2=\Carbon\Carbon::parse($booking->checkOut_date);

              $date_diff=$formatted_dt1->diffInDays($formatted_dt2);
            ?>
            <?php
              $total=$booking->price*$date_diff*$booking->number_of_rooms;
              $sum+=$total;
            ?>
            <tr class="success">
              <td>{{$key+1}}</td>
              <td>{{$booking->roomType->name}}</td>
              <td>{{$booking->number_of_rooms}}</td>
              <td>{{$booking->checkIn_date}}</td>
              <td>{{$booking->checkOut_date}}</td>
              <td>{{$booking->price}}</td>
              <td>{{$total}}</td>
            </tr>
            
            @endforeach
            <?php
              
              if($promo){
                  $discount=$promo->discount/100*$sum;
                  $total=$sum-$discount;
              }else{
                $total = $sum;
              }
              
            ?>
            @if($promo)
            <tr class="success">
              <td colspan="4">Discount({{$promo->discount}}%)</td>
              
              <td>{{$discount}}</td>
            </tr>
            <tr class="success">
              <td colspan="4">total</td>
              
              <td>{{$total}}</td>
            </tr>
            @else
            <tr class="success">
              <td colspan="6">total</td>
              
              <td>{{$total}}</td>
            </tr>
            @endif
          </tbody>
          
        </table>
    </div>
  </div>
