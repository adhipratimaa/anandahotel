<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Promo\PromoRepository;

class PromoController extends Controller
{
    public function __construct(PromoRepository $promo){
        $this->promo=$promo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->promo->orderBy('created_at','desc')->get();
        return view('admin.promo.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['title'=>'required','promo_code'=>'required','discount'=>'required|numeric']);
        $value=$request->except('publish');
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        $this->promo->create($value);
        return  redirect()->route('promo.index')->with('message','Promo Added Successfully');
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
        $detail=$this->promo->findOrFail($id);
        return view('admin.promo.edit',compact('detail'));  
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
        $this->validate($request,['title'=>'required','promo_code'=>'required','discount'=>'required|numeric']);
        $value=$request->except('publish');
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        $this->promo->update($value,$id);
        return  redirect()->route('promo.index')->with('message','Promo Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->promo->destroy($id);
        return redirect()->back()->with('message','Promo Deleted Successfully');    
    }
}
