<?php
namespace App\Repositories\Booking;
use App\Repositories\Crud\CrudInterface;
interface BookingInterface extends CrudInterface{
	public function create($data);
}