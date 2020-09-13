<?php
namespace App\Repositories\ViewComposer;
use App\Repositories\Dashboard\DashboardRepository;
use App\Repositories\RoomType\RoomTypeRepository;
use Illuminate\View\View;

class ViewComposer {
	private $dashboard;
	
	public function __construct(RoomTypeRepository $roomType,DashboardRepository $dashboard) {
		$this->roomType=$roomType;
		$this->dashboard=$dashboard;
	}
	public function compose(View $view) {
		$dashboard=$this->dashboard->first();
		$roomTypes=$this->roomType->orderBy('created_at','desc')->where('publish',1)->get();
		$view->with(['dashboard_roomTypes'=>$roomTypes,'dashboard_composer'=>$dashboard]);
	}
	
}
