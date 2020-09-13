<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoomType\RoomTypeRepository;
use App\Repositories\Feature\FeatureRepository;
use Image;
class RoomTypeController extends Controller
{
    public function __construct(RoomTypeRepository $roomtype,FeatureRepository $feature){
        $this->roomtype=$roomtype;
        $this->feature=$feature;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->roomtype->orderBy('created_at','desc')->get();
        return view('admin.roomType.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $features=$this->feature->get();
        return view('admin.roomType.create',compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required','room_capacity'=>'required|integer','image'=>'mimes:jpeg,bmp,png']);
        $data=$request->except('publish');
        $data['slug']=str_slug($request->name);
        $detail=$this->roomtype->where('slug',$data['slug'])->first();
        if($detail){
            $data['slug']=$data['slug'].'a';
        }
        
        $data['publish']=is_null($request->publish)?0:1;
        if($request->image){
            $image=$this->imageProcessing($request->file('image'));
            $data['image']=$image;
        }
        $room_type=$this->roomtype->create($data);
        
        if($request->features){
            $this->saveRoomTypefeature($room_type->id,$request->features);
        }
        return redirect()->route('room-type.index')->with('message','Roomtype Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roomtype=$this->roomtype->findOrFail($id);
        $roomtypeImages=$roomtype->images;
        return view('admin.roomType.imageList',compact('roomtype','roomtypeImages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $features=$this->feature->get();
        $detail=$this->roomtype->findOrFail($id);
        
        return view('admin.roomType.edit',compact('features','detail'));
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
        $this->validate($request,['name'=>'required','room_capacity'=>'required|integer','image'=>'mimes:jpeg,bmp,png']);
        $data=$request->except('publish');
        $data['publish']=is_null($request->publish)?0:1;
        
        $detail=$this->roomtype->findOrFail($id);
        if($detail->name==$request->name){
            $data['slug']=$detail['slug'];
        }else{
            $data['slug']=str_slug($request->name);
        }
        if($request->image){
            $image=$this->imageProcessing($request->file('image'));
            $data['image']=$image;
        }
        
        $this->roomtype->update($data,$id);
        $this->roomtype->deleteRoomTypefeature($id);
        if($request->features){
            $this->saveRoomTypefeature($id,$request->features);
        }
        return redirect()->route('room-type.index')->with('message','Roomtype Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->roomtype->destroy($id);
        return redirect()->back()->with('message','Room Type Deleted Successfully');
    }
    public function saveRoomTypefeature($roomtype_id,$features){
        for ($i = 0; $i < count($features); $i++) {
            $input = array('roomtype_id' => $roomtype_id, 'feature_id' => $features[$i]);
            $this->roomtype->saveData($input);
        }
    }
    public function imageProcessing($image){
       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
       $thumbPath = public_path('images/thumbnail');
       $mainPath = public_path('images/main');
       $listingPath = public_path('images/listing');
       $img = Image::make($image->getRealPath());
       $img->fit(733,440)->save($mainPath.'/'.$input['imagename']);
       $img1 = Image::make($image->getRealPath());
       $img1->fit(349, 251)->save($thumbPath.'/'.$input['imagename']);
       $img2 = Image::make($image->getRealPath());
       $img2->fit(200, 100)->save($listingPath.'/'.$input['imagename']);
      
       $destinationPath = public_path('/images');
       return $input['imagename'];     
    }

}
