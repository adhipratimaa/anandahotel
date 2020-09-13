<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace'=>'Admin'],function(){
	Route::get('login','LoginController@login')->name('login');
	Route::post('postLogin','LoginController@postLogin')->name('postLogin');
});

Route::group(['namespace'=>'Admin','middleware'=>['auth'],'prefix'=>'admin'],function(){
	Route::resource('dashboard','DashboardController');
	Route::get('logout','LoginController@Logout')->name('logout');
	Route::resource('room-type-image','RoomTypeImageController');
	Route::resource('room-type','RoomTypeController');
	Route::resource('room','RoomController');
	Route::resource('service','ServiceController');
	Route::resource('slider','SliderController');
	Route::post('slider-process','SliderController@sliderProcess')->name('sliderProcess');
	Route::post('crop-modal','SliderController@cropmodal')->name('cropmodal');
	Route::post('crop-process','SliderController@cropprocess')->name('slidercropprocess');
	Route::post('update-slider/{id}','SliderController@updateSlider')->name('updateSlider');
	Route::resource('blog','BlogController');
	Route::resource('testimonial','TestimonialController');
	Route::resource('feature','FeatureController');
	Route::resource('room-image','RoomImageController');
	Route::resource('service-image','ServiceImageController');
	Route::resource('team','TeamController');
	Route::resource('page','PageController');
	Route::resource('booking','BookingController');
	Route::resource('promo','PromoController');
	Route::post('GetCustomDateRoomBooking','BookingController@GetCustomDateRoomBooking')->name('GetCustomDateRoomBooking');
	Route::get('booked-history','BookingController@bookedHistory')->name('bookedHistory');
});

Route::group(['namespace'=>'Front'],function(){
	Route::get('/','DefaultController@index')->name('home');
	Route::get('/services','DefaultController@services')->name('services');
	Route::get('blogs','DefaultController@blogs')->name('blogs');
	Route::get('testimonials','DefaultController@testimonials')->name('testimonials');
	Route::get('blog/{slug}','DefaultController@blogInner')->name('blogInner');
	Route::get('all-categories','DefaultController@allCategories')->name('allCategories');
	Route::get('contact-us','DefaultController@contactUs')->name('contactUs');
	Route::post('save-contact','DefaultController@saveContact')->name('saveContact');
	Route::get('room-types/{slug}','DefaultController@singleRoomType')->name('singleRoomType');
	Route::get('teams','DefaultController@teams')->name('teams');
	Route::post('getCategoryCapacity','DefaultController@getCategoryCapacity')->name('getCategoryCapacity');
	Route::get('search-room','DefaultController@searchRoom')->name('searchRoom')->middleware('PreventReturn');
	Route::post('getDataOfSingleRoom','DefaultController@getDataOfSingleRoom')->name('getDataOfSingleRoom');
	Route::post('remove-room','DefaultController@removeRoom')->name('removeRoom');
	Route::post('book-individual-room','DefaultController@bookIndividualRoom')->name('bookIndividualRoom');
	Route::post('addPeopleData','DefaultController@addPeopleData')->name('addPeopleData');
	Route::get('check-out','DefaultController@checkOutForm')->name('checkOutForm');
	Route::post('save-booking','DefaultController@saveBooking')->name('saveBooking');
	Route::post('filter-by-category','DefaultController@filterByCategory')->name('filterByCategory');
	Route::post('filter-by-price','DefaultController@filterByPrice')->name('filterByPrice');
	Route::get('/{slug}','DefaultController@page')->name('page');
});