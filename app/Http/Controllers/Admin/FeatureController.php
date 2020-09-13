<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Feature\FeatureRepository;

class FeatureController extends Controller
{
    public function __construct(FeatureRepository $feature){
        $this->feature=$feature;
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
        $details=$this->feature->all();
        return view('admin.feature.create',compact('details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['title'=>'required','image'=>'dimensions:max_width=250,max_height=250']);
        $value=$request->except('image');
        if($request->image){
            $documents=$request->file('image');
            $filename=time().'.'.$documents->getClientOriginalName();
            $documents->move(public_path('images/main'),$filename);   
            $value['image']=$filename;
            
        }
        $this->feature->create($value);
        return redirect()->back()->with('message','Feature Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $details=$this->feature->all();
        $detail=$this->feature->findOrFail($id);
        return view('admin.feature.edit',compact('details','detail'));
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
        $this->validate($request,['title'=>'required','image'=>'dimensions:max_width=250,max_height=250']);
        $value=$request->except('image');
        if($request->image){
            $documents=$request->file('image');
            $filename=time().'.'.$documents->getClientOriginalName();
            $documents->move(public_path('images/main'),$filename);   
            $value['image']=$filename;
        }
        $this->feature->update($value,$id);
        return redirect()->route('feature.create')->with('message','Feature Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->feature->destroy($id);
        return redirect()->route('feature.create')->with('message','Feature Deleted Successfully');
    }
}
