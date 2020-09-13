<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoomTypeImage\RoomTypeImageRepository;
use Image;

class RoomTypeImageController extends Controller
{
    public function __construct(RoomTypeImageRepository $roomTypeImage){
        $this->roomTypeImage=$roomTypeImage;
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
        $this->validate($request,['image'=>'required|dimensions:max_width:2000,max_width:2000|mimes:jpeg,bmp,png']);
        $image=$request->file('image');
        $input=$request->except('image');
        $input['image'] = time().'.'.$image->getClientOriginalExtension();
        $thumbPath = public_path('images/thumbnail');
        
        $listingPath = public_path('images/listing');
        $img = Image::make($image->getRealPath());
        $img->fit(368,232)->save($thumbPath.'/'.$input['image']);
        $img1 = Image::make($image->getRealPath());
        $img1->fit(200, 150)->save($listingPath.'/'.$input['image']);
        $this->roomTypeImage->create($input);
        return redirect()->back()->with('message','RoomImage Added Successfully');
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
        $image=$this->roomTypeImage->findOrFail($id);
        if($image->image){
            $thumbPath = public_path('images/thumbnail');
            
            $listingPath = public_path('images/listing');
            if((file_exists($thumbPath.'/'.$image->image)) && (file_exists($listingPath.'/'.$image->image))){
                unlink($thumbPath.'/'.$image->image);
               
                unlink($listingPath.'/'.$image->image);
            }
        }
        $this->roomTypeImage->destroy($id);
        return redirect()->back()->with('message','Image Deleted Successfully');
    }
}
