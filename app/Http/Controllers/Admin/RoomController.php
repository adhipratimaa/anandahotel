<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Room\RoomRepository;
use App\Repositories\RoomType\RoomTypeRepository;
use App\Repositories\RoomImage\RoomImageRepository;
use App\Repositories\Feature\FeatureRepository;
use Image;

class RoomController extends Controller
{
    public function __construct(RoomRepository $room,RoomTypeRepository $room_type,RoomImageRepository $roomImage,FeatureRepository $feature){
        $this->room=$room;
        $this->room_type=$room_type;
        $this->roomImage=$roomImage;
        $this->feature=$feature;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->room->orderBy('created_at','desc')->get();
        return view('admin.room.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roomTypes=$this->room_type->all();
        $features=$this->feature->all();
        return view('admin.room.create',compact('roomTypes','features'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $message=['roomtype_id.required'=>'Select Room Type'];
        $this->validate($request,['name'=>'required','roomtype_id'=>'required|numeric','short_description'=>'max:250','image'=>'mimes:jpeg,bmp,png','price'=>'required|integer'],$message);
        $data=$request->except('publish','image');
        $data['publish']=is_null($request->publish)?0:1;
        if($request->image){
            $image=$this->imageProcessing($request->file('image'));
            $data['image']=$image;
        }
        $room=$this->room->create($data);
        if($request->features){
            $this->saveRoomfeature($room->id,$request->features);
        }
        return redirect()->route('room.index')->with('message','Room Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room=$this->room->findOrFail($id);
        $roomImages=$room->roomImages;
        return view('admin.room.imageList',compact('room','roomImages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roomTypes=$this->room_type->all();
        $detail=$this->room->findOrFail($id);
        $features=$this->feature->all();
        return view('admin.room.edit',compact('roomTypes','detail','features'));
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
        $message=['roomtype_id.required'=>'Select Room Type'];
        $this->validate($request,['name'=>'required','roomtype_id'=>'required|numeric','short_description'=>'max:250','price'=>'required|integer'],$message);
        $data=$request->except('publish');
        $data['publish']=is_null($request->publish)?0:1;
        if($request->image){
            $image=$this->room->find($id);
            if($image->image){
                $thumbPath = public_path('images/thumbnail');
                $mainPath = public_path('images/main');
                $listingPath = public_path('images/listing');
                if((file_exists($thumbPath.'/'.$image->image)) && (file_exists($listingPath.'/'.$image->image)) &&(file_exists($mainPath.'/'.$image->image))){
                    unlink($thumbPath.'/'.$image->image);
                    unlink($mainPath.'/'.$image->image);
                    unlink($listingPath.'/'.$image->image);
                }
            }
            $image=$this->imageProcessing($request->file('image'));
            $data['image']=$image;
        }
        $this->room->update($data,$id);
        $this->room->deleteRoomfeature($id);
        if($request->features){
            $this->saveRoomfeature($id,$request->features);
        }
        return redirect()->route('room.index')->with('message','Room Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image=$this->room->findOrFail($id);
        if($image->image){
            $thumbPath = public_path('images/thumbnail');
            $mainPath = public_path('images/main');
            $listingPath = public_path('images/listing');
            if((file_exists($thumbPath.'/'.$image->image))  && (file_exists($listingPath.'/'.$image->image)) &&(file_exists($mainPath.'/'.$image->image))){
                unlink($thumbPath.'/'.$image->image);
                unlink($mainPath.'/'.$image->image);
                unlink($listingPath.'/'.$image->image);
            }
        }
        $this->room->destroy($id);
        return redirect()->back()->with('message','Room Deleted Successfully');
    }
    public function imageProcessing($image){
       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
       $thumbPath = public_path('images/thumbnail');
       $mainPath = public_path('images/main');
       $listingPath = public_path('images/listing');
       $img = Image::make($image->getRealPath());
       $img->fit(733,402)->save($mainPath.'/'.$input['imagename']);
       $img1 = Image::make($image->getRealPath());
       $img1->fit(350, 247)->save($thumbPath.'/'.$input['imagename']);
       $img2 = Image::make($image->getRealPath());
       $img2->fit(200, 100)->save($listingPath.'/'.$input['imagename']);
      
       $destinationPath = public_path('/images');
       return $input['imagename'];     
    }
    public function saveRoomfeature($room_id,$features){
        for ($i = 0; $i < count($features); $i++) {
            $input = array('room_id' => $room_id, 'feature_id' => $features[$i]);
            $this->room->saveData($input);
        }
    }

}
