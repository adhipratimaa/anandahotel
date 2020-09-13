<h3>Room History Of the month : {{($month1 != null) ? $month1 : ''}}{{($month2!== null) ? '-'.$month2 : ''}}</h3>
<table id="datatable" class="table jambo_table table-bordered  nowrap bulk_action table-hover table-replace" width="100%">
    <thead>
        <tr>
            <th>Room No</th>
            
      
            @if(isset($days) && count($days) > 0)
            @foreach($days['month_day'] as $day)
             
            <td>{{$day}}</td>
            @endforeach
            @endif
        </tr>
    </thead>
     
    <tbody>
        @if(isset($all_rooms) && $all_rooms->count())
        @foreach($all_rooms as $room_data)
        <tr>
            <td> {{ $room_data->name }} </td>
            @if(isset($days) && count($days) > 0)
            @foreach($days['month_day'] as $day)
            <td>
                @if(isset($booked_room) && $booked_room->count())
                @foreach($booked_room as $booked_data)
                    <?php 
                    // dd($booked_data);
                        $check_In  = $booked_data->checkIn_date;
                        $check_out   = $booked_data->checkOut_date;
                    ?>
                    @if(( $day >= $check_In) && ($day <= $check_out)  && ($booked_data->room_id == $room_data->id))
                    <button title="{{$day}}" data-id="{{$booked_data->id}}" class="ShowBookedDetail btn btn-sm btn-{{
                        ($booked_data->status == 'Checked In') ? 'success': 
                        (($booked_data->status == 'Reserved') ? 'warning' : 'danger')}}">
                        {{ $booked_data->status }}
                    </button>
                    @endif
                @endforeach
                @endif
            </td>
            @endforeach
            @endif
        </tr>
        @endforeach
        @endif
    </tbody>
</table>