<?php
namespace App\Repositories\ViewComposer;
use App\Repositories\Dashboard\DashboardRepository;
use App\Repositories\RoomType\RoomTypeRepository;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\Setting\SettingRepository;
use Illuminate\View\View;

class ViewComposer {
	private $dashboard;
	
	public function __construct(RoomTypeRepository $roomType,DashboardRepository $dashboard, ServiceRepository $service, SettingRepository $setting) {
		$this->roomType=$roomType;
		$this->dashboard=$dashboard;
		$this->service=$service;
		$this->setting=$setting;


	}
	public function compose(View $view) {
		$dashboard=$this->dashboard->first();
		$setting=$this->setting->first();
		
		$roomTypes=$this->roomType->orderBy('created_at','desc')->where('publish',1)->get();
		$menu=$this->service->where('show_in_menu', '1')->where('category','none')->where('publish', '1')->limit(4)->get();
		$packages=$this->service->where('show_in_menu', null)->where('category','packages')->where('publish', '1')->get();
		$dining=$this->service->where('show_in_menu', null)->where('category','dining')->where('publish', '1')->get();
		$meeting=$this->service->where('show_in_menu', null)->where('category','meeting_and_conference')->where('publish', '1')->get();
		// $youtubeVideo = $this->youtubevideo($setting->video);
		
		



		// dd($packages);
		
		$view->with(['dashboard_roomTypes'=>$roomTypes,'dashboard_composer'=>$dashboard, 'dashboard_menu'=>$menu, 'dashboard_package'=>$packages, 'dashboard_dining'=>$dining, 'dashboard_meeting'=>$meeting, 'dashboard_setting'=>$setting]);
	}

		// public function youtubeVideo($url){
  //   	$url_string = parse_url($url, PHP_URL_QUERY);
  // 		parse_str($url_string, $args);
  // 		return isset($args['v']) ? $args['v'] : false;
  //   }
	
}
