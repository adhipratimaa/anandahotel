<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Room\RoomRepository;
use Carbon\Carbon;
use App\Repositories\Customer\CustomerRepository;
use PDF;
class BookingController extends Controller
{
    public function __construct(RoomRepository $room,CustomerRepository $customer){
        $this->room=$room;
        $this->customer=$customer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $month1 = date('F');  
        $month2= null;
        $start_date = date('Y-m-01');
        $end_date1 = date('Y-m').'-'.Carbon::now()->daysInMonth;
        $days =[];
        for($day  = $start_date; $day <= $end_date1; $day++){
            $days['month_day'][(int)(date('d', strtotime($day)))] = (date('Y-m-d', strtotime($day)));
        }
        return view('admin.room.roombooking',compact('month1','month2','start_date','end_date','days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $detail=$this->customer->find($id);
        
        return view('admin.room.view')->with('detail',$detail);
    }

    public function downloadPdf(Request $request, $id){
        $detail=$this->customer->find($id);
        // dd($detail);
        $slug = \Str::slug($detail->first_name.'-'.$detail->last_name);
        // dd($slug);
        $pdf = PDF::loadview('admin.room.customer-detail-pdf', 
        compact( 'detail'));
        // )->setPaper('A4');
        // dd($pdf);
        return $pdf->stream($slug.'.pdf');
        // return $pdf->stream('customer-detail.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function GetCustomDateRoomBooking(Request $request){
        $date=explode('-',$request->value);
        $dateFrom = $date[0];
        $dateTo = $date[1];
        $DateNew= strtotime( $dateFrom );
        $dateFrom = date( 'Y-m-d', $DateNew);
        
        $DateNew= strtotime( $dateTo );
        $dateTo = date( 'Y-m-d H:i:s', $DateNew);
        $month1 = date('F', strtotime($dateFrom));
        $month2 = date('F', strtotime($dateTo));
        $days = [];
        $all_rooms = $this->room->get();

        if($all_rooms->count()){
            if($month1 == $month2){
                $end_date1 = $dateTo;
                $booked_room = $this->room_booking->where('checkIn_date','<=',$dateTo)->where('checkOut_date','>=',$dateFrom)->get();
                for($day  = $dateTo; $day <= $dateFrom; $day++){
                    $days['month_day'][(int)(date('d', strtotime($day)))] = (date('Y-m-d', strtotime($day)));
                }
                return response()->json([
                    'status' => true, 
                    'html' => view('admin.room.include.bookingDetails', 
                    compact('booked_room', 'all_rooms', 'month1', 'month2', 'days'))->render(), 
                    'message' => 'Searched data on custom date found.',
                    'booked_room' => $booked_room
                ]);
            }elseif($month1 != $month2){
                $end_of_month_one = cal_days_in_month(CAL_GREGORIAN, (int)date('m', strtotime($request->dateFrom)), date('Y'));
                $end_date1 = date('Y-m', strtotime($dateFrom)).'-'.$end_of_month_one;
                $start_date2 = date('Y-m', strtotime($dateTo)).'-01';
                $end_date2 = $dateTo;
                $start_day2 = date('d', strtotime($dateTo));
                $days = [];
                for($day  = $dateFrom; $day <= $end_date1; $day++){
                    $days['month_day'][date('Y-m-d', strtotime($day))] = (date('Y-m-d', strtotime($day))); 
                }
                for($day  = $start_date2 ; $day <= $end_date2; $day++){
                    $days['month_day'][date('Y-m-d', strtotime($day))] = (date('Y-m-d', strtotime($day)));
                }
                $booked_room = $this->room_booking->where('checkIn_date','<=',$dateTo)->where('checkOut_date','>=',$dateFrom)->get();
                return response()->json([
                    'status' => true, 
                    'html' => view('admin.room.include.bookingDetails', 
                    compact('booked_room', 'all_rooms', 'month1', 'month2', 'days'))->render(), 
                    'message' => 'Searched data on custom date found.', 
                    'booked_room' => $booked_room
                ]);
            }else{
                return response()->json(['status' => false, 'message' => ['No rooms found.'], 'data' => null]);
            }
        }else{
            return response()->json(['status' => false, 'message' => ['No rooms found.'], 'data' => null]);
        }
    }
    public function bookedHistory(){
        $customers = $this->customer->orderBy('created_at','desc')->get();
        // dd($customers);
        return view('admin.room.bookedHistory',compact('customers'));
    }
}
