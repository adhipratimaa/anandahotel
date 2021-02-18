<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Service\ServiceRepository;
use Image;

class ServiceController extends Controller
{
    public function __construct(ServiceRepository $service){
        $this->service=$service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->service->orderBy('created_at','desc')->get();
        return view('admin.service.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
            'title'=>'required',
            'logo'=>'dimensions:max_width=250,max_height=250|mimes:jpeg,bmp,png',
            'image'=>'dimensions:max_width=2000,max_height=2000|mimes:jpeg,bmp,png']);
        $data=$request->except('publish');
        // dd($request->title);
        if($request->logo){
            $documents=$request->file('logo');
            $filename=time().'.'.$documents->getClientOriginalName();
            $documents->move(public_path('images/main'),$filename);   
            $data['logo']=$filename;
            
        }
        if($request->image){
            $image=$this->imageProcessing($request->file('image'));
            $data['image']=$image;
        }
        $data['publish']=is_null($request->publish)?0:1;
        $data['show_in_menu']= is_null($request->show_in_menu)?null:1;
        $data['category']=$request->category;

        $this->service->create($data);
        return redirect()->route('service.index')->with('message','Service Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service=$this->service->findOrFail($id);
        $serviceImages=$service->serviceImages;
        return view('admin.service.imageList',compact('service','serviceImages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail=$this->service->findOrFail($id);
        return view('admin.service.edit',compact('detail'));
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
        $this->validate($request,['title'=>'required','logo'=>'sometimes|nullable|dimensions:max_width=250,max_height=250|mimes:jpeg,bmp,png','image'=>'sometimes|nullable|dimensions:max_width=2000,max_height=2000|mimes:jpeg,bmp,png']);
        $data=$request->except('publish');
        if($request->logo){
            $documents=$request->file('logo');
            $filename=time().'.'.$documents->getClientOriginalName();
            $documents->move(public_path('images/main'),$filename);   
            $data['logo']=$filename;
            
        }
        if($request->image){
            $image=$this->imageProcessing($request->file('image'));
            $data['image']=$image;
        }
        $data['service']=is_null($request->publish)?0:1;
        $data['show_in_menu']= is_null($request->show_in_menu)?null:1;
        $data['category']=$request->category;
        $this->service->update($data,$id);
        return redirect()->route('service.index')->with('message','Service Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->back()->with('message','Service Deleted Successfully');
    }
    public function imageProcessing($image){
       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
       $thumbPath = public_path('images/thumbnail');
       $mainPath = public_path('images/main');
       $listingPath = public_path('images/listing');
       $img = Image::make($image->getRealPath());
       $img->fit(733,440)->save($mainPath.'/'.$input['imagename']);
       $img1 = Image::make($image->getRealPath());
       $img1->fit(349, 241)->save($thumbPath.'/'.$input['imagename']);
       $img2 = Image::make($image->getRealPath());
       $img2->fit(200, 100)->save($listingPath.'/'.$input['imagename']);
      
       $destinationPath = public_path('/images');
       return $input['imagename'];     
    }
}
