<?php
namespace App\Repositories\Booking;
use App\Repositories\Crud\CrudRepository;
use App\Models\Booking;
class BookingRepository extends CrudRepository implements BookingInterface{
	public function __construct(Booking $booking){
		$this->model=$booking;
	}
	public function create($data){
		$this->model->create($data);
	}
}