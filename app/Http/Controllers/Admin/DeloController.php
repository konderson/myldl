<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Dela;
use App\Country;
use Illuminate\Http\Request;

class DeloController extends Controller
{

  public function index(){
      $delas=Dela::orderBy('id','desc')->paginate(5);
      return view('admin.delo.index',compact("delas"));
  }
  
  public function delete($id){
  $delo=Dela::where('id',$id)->first();
  $delo->delete();
   return redirect()->route('admin.adminpanel.delo');
  }
  
  public function edit($id){
      $delo=Dela::where('id',$id)->first();
      return view('admin.delo.edit',compact("delo")); 
  }
  public function update(Request $request)
  {
      $delo=Dela::where('id',$request->id)->first();
      $delo->nazva=$request->nazva;
      $delo->opisanie=$request->opisanie;
      $delo->tip=$request->tip;
      $delo->vhod_v_delo=$request->vhod_v_delo;
      $delo->status=$request->status;
      $country=Country::where('name','like','%' .$request->country.'%' )->first();
      if(!empty($country->name)){
          
          $delo->country_id=$country->id;
      }
      
      $delo->city=$request->city;
      $delo->bydzet=$request->bydzet;
      $delo->vremya=$request->vremya;
      $delo->effekt=$request->effekt;
      $delo->blagodarnost=$request->blagodarnost;
      $delo->dlya_chego=$request->dlya_chego;
      $delo->tip=$request->tip;
    $delo->tip=$request->tip;
      $delo->save();
            return redirect()->route('admin.adminpanel.delo'); 
  }

}