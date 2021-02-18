<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Gallery\GalleryRepository;
use Image;
use App\Models\GalleryImage;

class GalleryController extends Controller
{
    private $gallery;
    public function __construct(GalleryRepository $gallery){
        $this->gallery=$gallery;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->gallery->orderBy('created_at','desc')->get();
        return view('admin.gallery.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
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
            
            ]);
        $value=$request->except('is_active','filename','caption','list_image');
        $value['is_active']=is_null($request->is_active) ? 0 : 1 ;
        if($request->list_image){
            $image=$this->imageProcessing($request->file('list_image'));
            $value['list_image']=$image;
        }
        $galleryId=$this->gallery->create($value);
        // dd($galleryId);
        if($request->filename){
        $this->saveimage($galleryId,$request->filename,$request->caption);}
        return redirect()->route('gallery.index')->with('message','Gallery Added Successfully');

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
        $detail=$this->gallery->find($id);
        $images = $this->gallery->find($id)->images;
        return view('admin.gallery.edit',compact('detail','images'));
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
        $value=$request->except('is_active','filename','caption','list_image');
        $value['is_active']=is_null($request->is_active) ? 0 : 1 ;
        if($request->list_image){
            $imagename=$this->imageProcessing($request->file('list_image'));
            $image=$this->gallery->find($id);
            $thumbPath = public_path('images/thumbnail');
            unlink($thumbPath.'/'.$image['list_image']);   
            $value['list_image']=$imagename;
        }
        $galleryId=$this->gallery->update($value,$id);
        // dd($galleryId);
        if($request->filename){
        $this->updateImage($id,$request->filename,$request->caption);}
        return redirect()->route('gallery.index')->with('message','Gallery updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galleryimage=GalleryImage::where('gallery_id',$id)->get();
        foreach($galleryimage as $value){
            if($value['filename']){
                $thumbPath = public_path('images/thumbnail');
                $imagePath = public_path('images');    
                unlink($thumbPath.'/'.$value['filename']);
                unlink($imagePath.'/'.$value['filename']);
            } 
        }
        $image=$this->gallery->find($id);
        if($image['list_image']){
            $thumbPath = public_path('images/thumbnail');
            unlink($thumbPath.'/'.$image['list_image']);
        } 
        $this->gallery->destroy($id);
        return redirect()->route('gallery.index')->with('message','Gallery deleted successfully');

    }
    public function gallery(Request $request){
        $files = $request->file('image');
            
        foreach ($files as $file) {
            list($width, $height, $type, $attr) = getImageSize($file);
            
            if($width < 400 && $height<400){
                continue;
            }
            $filename = time() . '.' . $file->getClientOriginalName();
            $temp = public_path('images');
            $detail['name'] = $filename;
            // $displaypath=public_path('images/temp/display');
            $thumbImagePath = public_path('images/thumbnail/');
            $detail['thumb_path'] = asset('images');
            $file->move($temp, $filename);
            copy($temp . '/' . $filename, $temp . '/thumbnail/' . $filename);
            $img=Image::make('images/' . $filename);

            $img->resize('900', '600');
            $img->save($thumbImagePath . '/' . $filename);
            // $img->fit(100, 80)->save($displaypath . '/' . $filename);
            $name[] = $detail;
        }
        return response()->json($name);
    }
    public function crop(Request $request){
        return view('admin.gallery.jcrop')->with('image',$request->name)->with('index',$request->index);
    }
    public function postJcrop(Request $request) {

        $path = public_path('images');
        $image = $request->image;
        $thumbImagePath = public_path('images/thumbnail');
        $x = $request->x;
        $y = $request->y;
        $w = $request->w;
        $h = $request->h;

        $img = Image::make('images/' . $image);

        $img->crop((int) $w, (int) $h, (int) $x, (int) $y);
        $img->save($thumbImagePath . '/' . $image);
        // $finalImage='images/temp/thumb'.$image;
        $finalImage = asset('images/thumbnail/' . $image);
        $image = '';

        return $finalImage;

    }
    public function galleryUpdate(Request $request,$id){
        $this->validate($request,[
            'title'=>'required',
            ]);
        $value=$request->except('is_active','filename','caption','list_image');
        $value['is_active']=is_null($request->is_active) ? 0 : 1 ;
        if($request->list_image){
            $imagename=$this->imageProcessing($request->file('list_image'));
            $image=$this->gallery->find($id);
            if($image['list_image']){
                $thumbPath = public_path('images/thumbnail');
                unlink($thumbPath.'/'.$image['list_image']);   
            }
            $value['list_image']=$imagename;
        }
        $galleryId=$this->gallery->update($value,$id);
        // dd($galleryId);
        $this->updateImage($id,$request->filename,$request->caption);
        return redirect()->route('gallery.index')->with('message','Gallery updated Successfully');
    }
    public function imageProcessing($image){
       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
       $thumbPath = public_path('images/thumbnail');
       $mainpath=public_path('images/main');
       $imagepath=public_path('images');
       $img = Image::make($image->getRealPath());
       $img->fit(100, 100)->save($thumbPath.'/'.$input['imagename']);
        $img1 = Image::make($image->getRealPath());
       $img1->fit(252, 172)->save($mainpath.'/'.$input['imagename']);
       $img2 = Image::make($image->getRealPath());
       $img2->resize(900, 600)->save($imagepath.'/'.$input['imagename']);
       return $input['imagename'];     
    }
    public function saveimage($galleryid,$filename,$caption){
        for ($i = 0; $i < count($caption); $i++) {
            $input = array('gallery_id' => $galleryid, 'filename' => $filename[$i], 'caption' => $caption[$i]);
            $this->gallery->saveImage($input);
        }
    }
    public function updateImage($id,$filename,$caption){
        $this->gallery->deleteGalleryImages($id);
        for ($i = 0; $i < count($caption); $i++) {
            $input = array('gallery_id' => $id, 'filename' => $filename[$i], 'caption' => $caption[$i]);
            $this->gallery->updateImage($id,$input);
    }
    }
    public function removeimage(Request $request){
        $name = $request->name;
        $path = public_path('images');
        $thumbpath = public_path('images/thumbnail');

        unlink($path . '/' . $name);
        unlink($thumbpath . '/' . $name);
        galleryImage::where('filename',$name)->delete();

        return;
    }
   
}
