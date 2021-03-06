<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Slider\SliderRepository;
use App\Repositories\Blog\BlogRepository;
use App\Repositories\Testimonial\TestimonialRepository;
use App\Repositories\Room\RoomRepository;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\RoomType\RoomTypeRepository;
use App\Repositories\Page\PageRepository;
use App\Repositories\Team\TeamRepository;
use App\Repositories\Booking\BookingRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Promo\PromoRepository;
use App\Repositories\Gallery\GalleryRepository;
use Validator;
use Carbon\Carbon;
use Mail;
use DB;
use Session;
class DefaultController extends Controller
{
	public function __construct(SliderRepository $slider,BlogRepository $blog,TestimonialRepository $testimonial,RoomRepository $room,ServiceRepository $service,RoomTypeRepository $roomType,PageRepository $page,TeamRepository $team,BookingRepository $booking,CustomerRepository $customer,PromoRepository $promo, GalleryRepository $gallery){
		$this->slider=$slider;
		$this->blog=$blog;
		$this->testimonial=$testimonial;
		$this->room=$room;
        $this->service=$service;
        $this->roomType=$roomType;
        $this->page=$page;
        $this->team=$team;
        $this->booking=$booking;
        $this->customer=$customer;
        $this->promo=$promo;
        $this->gallery=$gallery;

	}
    public function index(){
        //dd(session()->get('adults'));
        session()->forget('cart');
        session()->forget('check_in_date');
        session()->forget('check_out_date');
        session()->forget('adults');
        session()->forget('number_of_rooms');
        session()->forget('childs');

    	$sliders=$this->slider->where('publish',1)->orderBy('created_at','desc')->where('type','home')->take(4)->get();
    	$blogs=$this->blog->where('publish',1)->orderBy('created_at','desc')->take(3)->get();
    	$testimonials=$this->testimonial->where('publish',1)->orderBy('created_at','desc')->take(3)->get();
    	$rooms=$this->room->where('publish',1)->inRandomOrder()->take(6)->get();
        $services=$this->service->where('publish',1)->orderBy('created_at','desc')->get();
        $roomTypes=$this->roomType->where('publish',1)->orderBy('created_at','desc')->get();
        $promo=$this->promo->where('publish',1)->orderBy('created_at','desc')->first();
    	return view('front.index',compact('sliders','blogs','testimonials','rooms','services','roomTypes','promo'));
    }
    public function services(){
    	session()->forget('cart');
        session()->forget('check_in_date');
        session()->forget('check_out_date');
        session()->forget('adults');

        session()->forget('childs');
        $services=$this->service->where('publish',1)->where('category','none')->where('show_in_menu',null)->orderBy('created_at','desc')->get();
        $roomTypes=$this->roomType->where('publish',1)->orderBy('created_at','desc')->get();

        return view('front.services',compact('services','roomTypes'));
    }
    public function blogs(){
        $roomTypes = $this->roomType->get();
        $blogs=$this->blog->where('publish',1)->orderBy('created_at','desc')->get();
        return view('front.blogs',compact('blogs','roomTypes'));
    }
    public function testimonials(){
        $roomTypes = $this->roomType->get();
        $testimonials=$this->testimonial->where('publish',1)->orderBy('created_at','desc')->get();
        return view('front.testimonials',compact('testimonials','roomTypes'));
    }
    public function singleRoomType($slug){
        session()->forget('cart');
        session()->forget('check_in_date');
        session()->forget('check_out_date');
        session()->forget('adults');

        session()->forget('childs');
        $roomType=$this->roomType->where('slug',$slug)->first();
        if($roomType){
            $rooms=$roomType->rooms()->where('publish',1)->paginate(20);

            $otherRoomTypes=$this->roomType->where('publish',1)->where('id','!=',$roomType->id)->orderBy('created_at','desc')->get();
            $roomTypes=$this->roomType->where('publish',1)->orderBy('created_at','desc')->get();

            return view('front.roomListing',compact('rooms','roomType','roomTypes','otherRoomTypes'));   
        }
        abort(404);
        
    }
    public function blogInner($slug){
        $blog=$this->blog->where('slug',$slug)->first();
        $roomTypes = $this->roomType->get();
        if($blog){
            $recentBlogs=$this->blog->where('publish',1)->orderBy('created_at','desc')->where('id','!=',$blog->id)->take(3)->get();
            return view('front.blogInner',compact('blog','recentBlogs','roomTypes'));
        }
        abort(404);
    }
    public function allCategories(){
        $roomTypes=$this->roomType->where('publish',1)->orderBy('created_at','desc')->get();

        return view('front.allCategory',compact('roomTypes'));
    }
    public function contactUs(){
        $roomTypes = $this->roomType->get();
        return view('front.contactUs',compact('roomTypes'));
    }
    public function saveContact(Request $request){
        $this->validate($request,['name'=>'required','email'=>'required|email','subject'=>'required','message'=>'required']);
        $data = array('email' => $request->email, 'body_message' => $request->message,'name'=>$request->name,'subject'=>$request->subject);
        Mail::send('email.contactTemplate', $data, function ($message) use ($data,$request) {
            $message->to('info@chorachori.com')->from($data['email'],$data['name'])->replyTo($data['email']);
                $message->subject($data['subject']);   
            
        });
        return redirect()->back()->with('message','Message Sent');
    }
    public function page($slug){
    	session()->forget('cart');
        session()->forget('check_in_date');
        session()->forget('check_out_date');
        session()->forget('adults');

        session()->forget('childs');
        $page=$this->page->where('slug',$slug)->first();
        if($page){
            $roomTypes=$this->roomType->where('publish',1)->orderBy('created_at','desc')->get();
            $sliders=$this->slider->where('publish',1)->orderBy('created_at','desc')->where('type','about')->get();
            return view('front.aboutPageTemplate',compact('page','roomTypes','sliders'));   
        }
        abort(404);
        
    }
    public function teams(){
        $roomTypes = $this->roomType->get();
        $teams=$this->team->where('publish',1)->orderBy('created_at','desc')->get();
        return view('front.allTeams',compact('teams','roomTypes'));
    }
    public function getCategoryCapacity(Request $request){
        $roomType=$this->roomType->find($request->id);
        return $roomType->room_capacity;
    }
    public function searchRoom(Request $request){
        //dd($request->all());
        
        // foreach ($request->adult as $key => $value) {
        //     $customMessages['adult.' . $key . '.gt'] = 'Adult for Room'. ($key+1).' should be greater than 0';
        // }

        // $this->validate($request, [
        //     'array' => 'required|array|max:100',
        //     'array.*' => 'required|string|distinct|min:3'
        // ], $customMessages);
        $formatted_dt1=Carbon::parse($request->check_in_date);

        $formatted_dt2=Carbon::parse($request->check_out_date);

        $date_diff=$formatted_dt1->diffInDays($formatted_dt2);

        $today=Carbon::today()->format('Y-m-d');

        $this->validate($request,[
            //'roomtype_id'=>'required|integer',
            'check_in_date' => 'required|date_format:Y-m-d|after_or_equal:'.$today,
            'check_out_date' => 'required|after_or_equal:check_in_date|date_format:Y-m-d',
            'number_of_rooms' => 'required|integer|min:1,max:20',
            'adult'           => 'required|array',
            'adult.*'         => 'required|integer|gt:0',
        ]);
        // $room_type=$this->roomType->findOrFail($request->roomtype_id);
        $number_of_rooms=$request->number_of_rooms;
        if(session()->get('check_in_date')==null && session()->get('check_out_date')==null){
            
            // dd('khali');
            session()->put('check_in_date',$request->check_in_date);
            session()->put('check_out_date',$request->check_out_date);
            session()->put('adults',$request->adult);
            //session()->put('roomtype',$request->roomtype_id);
            session()->put('childs',$request->child);
            session()->put('old_input',$request->adult);
            session()->put('date_diff',$date_diff);
            session()->put('number_of_rooms',$request->number_of_rooms);


        }
        if(session()->get('check_in_date')===$request->check_in_date && session()->get('check_out_date')===$request->check_out_date){

            
            // if($request->roomtype_id==session()->get('roomtype')){
                 
            //     if(session()->get('old_input')!=$request->adult){
                    
            //         // dd('hello1');
            //         $adults=session()->get('adults');
            //         $childs=session()->get('childs');
            //         // dd($request->adult);
            //         $newAdult=[];
            //         foreach($request->adult as $adult){
            //             array_push($adults,$adult);
            //         }
            //         foreach($request->child as $adult){
            //             array_push($childs,$adult);
            //         }

                    
            //         session()->forget('adults');

            //         session()->put('adults',$adults);
            //         session()->forget('childs');
            //         session()->put('childs',$childs);

            //         session()->put('old_input',$request->adult);
            //         // dd(session()->get('old_input'));    
            //     }
            // }
            //else{
                session()->put('check_in_date',$request->check_in_date);
                session()->put('check_out_date',$request->check_out_date);
                session()->put('adults',$request->adult);
                //session()->put('roomtype',$request->roomtype_id);
                session()->put('childs',$request->child);
                session()->put('old_input',$request->adult);
                session()->put('promo_code',$request->promo_code);
                session()->put('date_diff',$date_diff);
                session()->put('number_of_rooms',$request->number_of_rooms);
                //session()->forget('cart');

           // }
        }
        if(session()->get('check_in_date')!=$request->check_in_date && session()->get('check_out_date')!=$request->check_out_date ){
            session()->forget('cart');
            session()->put('check_in_date',$request->check_in_date);
            session()->put('check_out_date',$request->check_out_date);
            session()->put('adults',$request->adult);
            //session()->put('roomtype',$request->roomtype_id);
            session()->put('childs',$request->child);
            session()->put('old_input',$request->adult);
            session()->put('date_diff',$date_diff);
            session()->put('promo_code',$request->promo_code);
            session()->put('number_of_rooms',$request->number_of_rooms);

        }
        
        if($request->check_in_date && $request->check_out_date){
            $checkIn_date = $request->check_in_date;
            $checkOut_date = $request->check_out_date;
            // $booked_room = $this->room_booking->where('checkIn_date','>=',$checkIn_date)->orWhere('checkOut_date','<=',$checkOut_date)->get();
            //when there is room type
            // $booked_room = $this->booking->where('roomtype_id',$request->roomtype_id)->where('checkIn_date','<=',$checkOut_date)->where('checkOut_date','>=',$checkIn_date)->get()->toArray();
            $booked_room = $this->booking->where('checkIn_date','<=',$checkOut_date)->where('checkOut_date','>=',$checkIn_date)->get()->toArray();
            // dd($booked_room);  
            
            foreach($booked_room as $room_data){
                $room_id[] = $room_data['room_id'];
            } 

            // dd($checkIn_date);
        }
        if(isset($room_id) && count($room_id) > 0){
            $all_rooms = $this->room->where('publish', 1)->whereNotIn('id', $room_id )->get();
        } else {
            $all_rooms = $this->room->where('publish', 1)->get();
        }
        $cart=session()->get('cart');

        $roomTypes=$this->roomType->where('publish',1)->orderBy('created_at','desc')->get();
     
        
         
        
        $promo_code=$this->promo->where('promo_code',$request->promo_code)->first();
        
    
            // $related_roomTypes = $this->roomTypes->where('id', $roomTypes->id)->where('publish',1)->get();
        return view('front.searchResult',compact('all_rooms','checkIn_date','checkOut_date','cart','roomTypes','number_of_rooms','promo_code', 'related_roomTypes'));
        
        
        
    }
    public function getDataOfSingleRoom(Request $request){
        $room=$this->roomType->find($request->id);

        if($room){

            
            $cart = session()->get('cart');
            $number_of_rooms_selected = session()->get('number_of_rooms');

            $adults = session()->get('adults');

            
            $number_of_rooms = 0;
            if($cart){
               foreach($cart as $cart){
                   
                   $number_of_rooms+=$cart['number_of_rooms'];
               } 
            }
            //dd($number_of_rooms);
            
            if($number_of_rooms_selected<=$number_of_rooms){
                
                return response()->json(['message'=>'fail','status'=>false]);
            }else{
                $this->addToCart($room);
                $cart = session()->get('cart');
                $sum=0;
                $number_of_rooms = 0;       
                foreach($cart as $cart){
                    $total= $cart['price']*session()->get('date_diff')*$cart['number_of_rooms'];
                    $sum+=$total;
                    $number_of_rooms+=$cart['number_of_rooms'];
                }
                return response()->json(['message'=>'success','status'=>true,'number_of_rooms'=>$number_of_rooms,'sum'=>$sum,'html'=>view('front.include.singleRoomBookSection',compact('room','cart'))->render()]);
            }
        }else{
            return response()->json(['message'=>'fail','status'=>false]);
        }
        
        
        
    }
    public function addToCart($room){
        $cart = session()->get('cart');
        $adults = session()->get('adults');
        $childs = session()->get('childs');
        //adults or childs session should neve be small than cart session
        
        if(is_null($cart)){
            $cart_count=0;
        }else{
            $cart_count=count($cart);   
        }

        
        // if cart is empty then this the first product
        if(!$cart){

            $cart = [
                $room->id => [
                    'id'=>$room->id,
                    "name" => $room->name,
                    "price" => $room->price,
                    "adults"=>$adults[$cart_count],
                    "childs"=>$childs[$cart_count],
                    'number_of_rooms'=>1,
                ]
            ];
            session()->put('cart', $cart);
            return;
        }
        // if cart not empty then check if this product exist then do nothinf 
        if(isset($cart[$room->id])) {
            
            $cart[$room->id]['id']=$room->id;
            $cart[$room->id]['name']=$room->name;
            $cart[$room->id]['price']=$room->price;
            $cart[$room->id]['adults']+=$adults[$cart_count];
            $cart[$room->id]['childs']+=$childs[$cart_count];
            $cart[$room->id]['number_of_rooms']+=1;

            session()->put('cart', $cart);
            
            return;

        }
        // if item not exist in cart then add to cart with quantity = 1

        $cart[$room->id] = [
            'id'=>$room->id,
            "name" => $room->name,
            "price" => $room->price,
            "adults"=>$adults[$cart_count],
            "childs"=>$childs[$cart_count],
            "number_of_rooms"=>1,
        ];
        session()->put('cart', $cart);
       
    }
    public function removeRoom(Request $request){
        $cart=session()->get('cart');
        unset($cart[$request->id]);
        session()->forget('cart');
        session()->put('cart',$cart);
        $cart = session()->get('cart');
        $sum=0;
        $number_of_rooms = 0;       
        foreach($cart as $cart){
            $total= $cart['price']*session()->get('date_diff')*$cart['number_of_rooms'];
            $sum+=$total;
            $number_of_rooms+=$cart['number_of_rooms'];
        }
        return response()->json(['message'=>true,'sum'=>$sum,'number_of_rooms'=>$number_of_rooms]);
    }

    public function removeElementWithValue($array, $key, $value){
        foreach($array as $subKey => $subArray){
            if($subArray[$key] == $value){
               unset($array[$subKey]);
            }
        }
        return $array;
    }
   public function checkOutForm(){

        $carts=session()->get('cart');
        $promo_code=session()->get('promo_code');
        $promo=$this->promo->where('promo_code',$promo_code)->first();
        $countries=DB::table('country')->get();
        if($carts!=null){
            $roomTypes = $this->roomType->get();
            $check_in_date=session()->get('check_in_date');
            $check_out_date=session()->get('check_out_date');
            return view('front.checkOut',compact('carts','check_in_date','check_out_date','countries','promo','roomTypes'));
        }
        return redirect()->route('home');
        
    }
    public function bookIndividualRoom(Request $request){
        dd($request->all());
    }
   public function addPeopleData(Request $request){
        //dd($request->all());
        $validator = Validator::make($request->all(),[
            'addedadult'           => 'required|array',
            'addedadult.*'         => 'required|integer|gt:0',
        ]);
        if($validator->fails()){
            return 'fail';
        }else{
            foreach($request->addedadult as $adults){
                
                $adult=session()->get('adults');
                $adult_count=count($adult);
                $adult[$adult_count]=$adults;
            }
            foreach($request->addedchild as $childs){
                $child=session()->get('childs');
                $child_count=count($child);
                $child[$child_count]=$childs;
            }
            $previous_no_of_rooms = session()->get('number_of_rooms');
            $new_number_of_rooms = $previous_no_of_rooms+$request->number_of_rooms; 
            session()->put('number_of_rooms',$new_number_of_rooms);
            
            session()->forget('adults');
            session()->forget('childs');
            session()->put('adults',$adult);
            session()->put('childs',$child);
            return "success";
        }
        
    }
    public function saveBooking(Request $request){
        
         $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email'=>'required',
            'special_request'=>'required',

            
            ]);

        $carts=session()->get('cart');
        if(session()->get('cart')){
            $customer['first_name']=$request->first_name;
            $customer['last_name']=$request->last_name;
            $customer['email']=$request->email;
            $customer['phone_number']=$request->phone_number;
            $customer['special_request']=$request->special_request;

            if($promo_code=session()->get('promo_code')){
                $promo=$this->promo->where('promo_code',$promo_code)->first();
                $customer['promo_id']=$promo->id;
            }

            
            $result=$this->customer->create($customer);
            foreach($carts as $cart){
                
                
                $data['roomtype_id']=$cart['id'];
                $data['customer_id']=$result->id;
                $data['checkIn_date']=session()->get('check_in_date');
                $data['checkOut_date']=session()->get('check_out_date');
                $data['person']=$cart['adults']*$cart['number_of_rooms'];
                $data['childs']=$cart['childs']*$cart['number_of_rooms'];

                $data['price']=$cart['price'];
                $data['number_of_rooms'] = $cart['number_of_rooms'];
                $data['first_name']=$request->first_name;
                $data['last_name']=$request->last_name;
                $data['phone_number']=$request->phone_number;
                $data['email']=$request->email;
                $data['special_request']=$request->special_request;
                if($promo_code=session()->get('promo_code')){
                    $promo=$this->promo->where('promo_code',$promo_code)->first();
                    $data['promo_id']=$promo->id;
                }
                
                
                $this->booking->create($data);
            }
            //session()->forget('cart');
            session()->forget('check_in_date');
            session()->forget('check_out_date');
            session()->forget('adults');

            session()->forget('childs');
            session()->forget('promo_code');
            session()->forget('number_of_rooms');
            session()->put('thankyou',1);
             Mail::send('email.customerDetail', $data, function ($message) use ($data,$request) {
            $message->to('adhipratimaa@gmail.com')->from($data['email'],$data['first_name'])->replyTo($data['email']);
                $message->subject('Room Booking'); 
              
            
        });
             
            return redirect()->back()->with('success_message','message');

        }else{
            return redirect()->route('home');
        }
        
    }
    public function filterByCategory(Request $request){
        $category=$this->roomType->findOrFail($request->id);

        $checkIn_date = session()->get('check_in_date');
        $checkOut_date = session()->get('check_out_date');

        $booked_room = $this->booking->where('roomtype_id',$request->id)->where('checkIn_date','<=',$checkOut_date)->where('checkOut_date','>=',$checkIn_date)->get()->toArray();

        
        
        foreach($booked_room as $room_data){
            $room_id[] = $room_data['room_id'];
        }

        if(isset($room_id) && count($room_id) > 0){
            $all_rooms = $this->room->where('roomtype_id',$request->roomtype_id)->where('publish', 1)->whereNotIn('id', $room_id )->get();
        } else {
            $all_rooms = $this->room->where('roomtype_id',$request->id)->where('publish', 1)->get();
        }

        
        return response()->json(['status'=>true,'html'=>view('front.include.filterResult',compact('all_rooms'))->render()]);
    }
    public function filterByPrice(Request $request){
       
        $checkIn_date = session()->get('check_in_date');
        $checkOut_date = session()->get('check_out_date');
        $roomType_id=session()->get('roomtype');

        $booked_room = $this->booking->where('roomtype_id',$request->id)->where('checkIn_date','<=',$checkOut_date)->where('checkOut_date','>=',$checkIn_date)->get()->toArray();

        
        
        foreach($booked_room as $room_data){
            $room_id[] = $room_data['room_id'];
        }

        if(isset($room_id) && count($room_id) > 0){
            $all_rooms = $this->room->where('roomtype_id',$roomType_id)->where('publish', 1)->whereNotIn('id', $room_id );
        } else {
            $all_rooms = $this->room->where('roomtype_id',$roomType_id)->where('publish', 1);
        }
        if($request->value=='lowtohigh'){
            $all_rooms=$all_rooms->orderBy('price','asc')->get();
        }else{
            $all_rooms=$all_rooms->orderBy('price','desc')->get();
        }
        
        return response()->json(['status'=>true,'html'=>view('front.include.filterResult',compact('all_rooms'))->render()]);
    }

    public function room(){

        return view('front.singleRoom',compact('detail'));
    }
    public function allServices($slug){
        $roomTypes = $this->roomType->get();
        
        if($slug == 'packages'){
        $services=$this->service->where('publish',1)->where('category','packages')->orderBy('created_at','desc')->get();

        } else if ($slug == 'dining'){
        $services=$this->service->where('publish',1)->where('category','dining')->orderBy('created_at','desc')->get();

        }else if ($slug == 'meeting-and-conferences'){
        $services=$this->service->where('publish',1)->where('category','meeting_and_conference')->orderBy('created_at','desc')->get();

        }
        
        
       

        return view('front.allServices',compact('services','roomTypes'));
    }
    public function serviceDetail($slug){
        $roomTypes = $this->roomType->get();
        $services=$this->service->where('slug',$slug)->first();
        
        
        return view('front.serviceDetail',compact('services','roomTypes'));
        }
        
  
    public function accomodation(){
        $roomTypes=$this->roomType->where('publish',1)->orderBy('created_at','desc')->get();
       
       return view('front.accommodation',compact('roomTypes'));

    }

    public function roomDetail($slug){
        $roomType=$this->roomType->where('slug',$slug)->first();
        // dd($roomTypes);
        $roomTypes = $this->roomType->get();
        
        return view('front.roomDetail',compact('roomType','roomTypes'));
    }

    public function roomTypeImage($id){
        $roomTypeImage=$this->roomType->findOrFail($id);
        // dd($roomTypeImage);
        
        return view('front.roomDetail',compact('roomTypeImage'));
    }
    public function bookNow(){
        $roomTypes = $this->roomType->get();
        return view('front.bookNow',compact('roomTypes'));
    }
    public function thankYou(){
        if(session()->get('thankyou')==1){
            $roomTypes = $this->roomType->get();
            return view('front.thankU',compact('roomTypes'));
        }else{
            return redirect()->route('home');
        }
        
    }

    public function allGalleries(){

        $galleries=$this->gallery->orderBy('created_at','desc')->where('is_active',1)->get();
        $roomTypes = $this->roomType->get();


        // dd($galleries);
        return view('front.allGalleries',compact('galleries', 'roomTypes'));
    }

    public function galleryInner($id){
        $galleries=$this->gallery->findOrFail($id);
        $roomTypes = $this->roomType->get();
        return view('front.galleryInner',compact('galleries', 'roomTypes'));
    }

    
    
}


