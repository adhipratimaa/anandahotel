<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ServiceImage\ServiceImageRepository;
use Image;

class ServiceImageController extends Controller
{
    public function __construct(ServiceImageRepository $service_image){
        $this->service_image=$service_image;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'image'=>'required|dimensions:max_width:2000,max_width:2000|mimes:jpeg,bmp,png|max:1024']);
        $image=$request->file('image');
        $input=$request->except('image');
        $input['image'] = time().'.'.$image->getClientOriginalExtension();
        $thumbPath = public_path('images/thumbnail');
        
        $listingPath = public_path('images/listing');
        $img = Image::make($image->getRealPath());
        $img->fit(368,232)->save($thumbPath.'/'.$input['image']);
        $img1 = Image::make($image->getRealPath());
        $img1->fit(200, 150)->save($listingPath.'/'.$input['image']);
        $this->service_image->create($input);
        return redirect()->back()->with('message','Service Image Added Successfully');
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
        $image=$this->service_image->findOrFail($id);
        
        if($image->image){
            $thumbPath = public_path('images/thumbnail');
            
            $listingPath = public_path('images/listing');
            if((file_exists($thumbPath.'/'.$image->image)) && (file_exists($listingPath.'/'.$image->image))){
                unlink($thumbPath.'/'.$image->image);
               
                unlink($listingPath.'/'.$image->image);
            }
        }
        $this->service_image->destroy($id);
        return redirect()->back()->with('message','Image Deleted Successfully');
    }
}
