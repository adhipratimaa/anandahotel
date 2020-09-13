<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Team\TeamRepository;
use Image;

class TeamController extends Controller
{
    private $team;
    public function __construct(TeamRepository $team){
        $this->team=$team;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->team->orderBy('created_at','desc')->get();
        return view('admin.team.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $value=$request->except('image','publish');
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        if($request->image){
            $image=$this->imageProcessing($request->file('image'));
            $value['image']=$image;
        }
        $this->team->create($value);
        return redirect()->route('team.index')->with('message','team Added Successfully');
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
        $detail=$this->team->find($id);
        return view('admin.team.edit',compact('detail'));
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
        $this->validate($request, $this->rules());
        $value=$request->except('image','publish');
            $value['publish']=is_null($request->publish)? 0 : 1 ;
            if($request->image){
                $image=$this->team->find($id);
                if($image->image){
                    $thumbPath = public_path('images/thumbnail');
                    $listingPath = public_path('images/listing');
                    if((file_exists($thumbPath.'/'.$image->image)) && (file_exists($listingPath.'/'.$image->image))){
                        unlink($thumbPath.'/'.$image->image);
                        unlink($listingPath.'/'.$image->image);
                    }
                }
                $image=$this->imageProcessing($request->file('image'));
                $value['image']=$image;
            }
            $this->team->update($value,$id);
            return redirect()->route('team.index')->with('message','team Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image=$this->team->find($id);
        if($image->image){
            $thumbPath = public_path('images/thumbnail');
            $listingPath = public_path('images/listing');
            if((file_exists($thumbPath.'/'.$image->image)) && (file_exists($listingPath.'/'.$image->image))){
                unlink($thumbPath.'/'.$image->image);
                unlink($listingPath.'/'.$image->image);
            }
        }
        $this->team->destroy($id);
        return redirect()->back()->with('message','team Deleted Successfully');
    }
    public function imageProcessing($image){
       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
       $thumbPath = public_path('images/thumbnail');
       $listingPath = public_path('images/listing');
       $img = Image::make($image->getRealPath());
       $img->fit(208, 260)->save($thumbPath.'/'.$input['imagename']);
       $img2 = Image::make($image->getRealPath());
       $img2->fit(200, 100)->save($listingPath.'/'.$input['imagename']);
      
       $destinationPath = public_path('/images');
       return $input['imagename'];     
    }
    public function rules($oldId = null, $sameSlugVal=false){
        $rules =  [
            'name' => 'required|max:100',
            'description' => 'required|max:250',
            'position'=>'max:150',
            'image'=>'dimensions:max_width=250,max_height=250'
        ];
        return $rules;
    }
}
