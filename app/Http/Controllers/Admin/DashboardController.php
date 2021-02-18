<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Dashboard\DashboardRepository;
use App\Repositories\RoomType\RoomTypeRepository;
use App\Repositories\Team\TeamRepository;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\Booking\BookingRepository;
use App\Repositories\Customer\CustomerRepository;
use PDF;

class DashboardController extends Controller
{
    public function __construct(DashboardRepository $dashboard, RoomTypeRepository $roomType, TeamRepository $team, ServiceRepository $service, BookingRepository $booking, CustomerRepository $customer){
        $this->dashboard=$dashboard;
        $this->roomType=$roomType;
        $this->team=$team;
        $this->service=$service;
        $this->booking=$booking;
        $this->customer=$customer;




}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $bookings=$this->destination->orderBy('updated_at','desc');
        // $teams=$this->team->orderBy('updated_at','desc');
        $rooms=$this->roomType->get();
        $bookings=$this->booking->get();
        $teams=$this->team->get();
        $services=$this->service->get();
        $customers = $this->customer->orderBy('created_at','desc')->limit(10)->get();



        return view('admin.dashboard',compact('rooms', 'bookings', 'teams', 'services', 'customers'));
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
        //
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
        $this->validate($request,['meta_title'=>'max:250','num_banner_1'=>'integer|min:0','num_banner_2'=>'integer|min:0']);
        $data=$request->except('logo','fav_icon');
        if($request->fav_icon){
            $image=$request->file('fav_icon');
            $imageName = time().'.favicom'.$image->getClientOriginalExtension();

            $image->move(public_path('images/thumbnail'),$imageName);
            $data['fav_icon']=$imageName;
        }
        if($request->logo){
            $logo=$request->file('logo');
            $imageName = time().'.logo'.$logo->getClientOriginalExtension();
            $logo->move(public_path('images/thumbnail'),$imageName);
            $data['logo']=$imageName;
        }
        $this->dashboard->update($data,$id);
        return redirect()->back()->with('message','Dashboard Updated Successfully');
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

    
}
