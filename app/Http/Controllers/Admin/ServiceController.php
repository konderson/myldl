<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use App\City;
use App\Country;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
  public function index(){
      $services=Service::orderBy('id','desc')->paginate(5);
      return view('admin.service.index',compact("services"));
  }
  
  public function delete($id){
  $service=Service::where('id',$id)->first();
  $service->delete();
   return redirect()->route('admin.adminpanel.service');
  }
  
  public function edit($id){
      //$service=Service::where('id',$id)->first();
      $service=Service::findOrFail($id);
      return view('admin.service.edit',compact("service")); 
  }
  public function update(Request $request)
  {
        $service=Service::where('id',4)->first();
        $service->title=$request->tema;
        $service->razdel_id=$request->razdel_id;
        $service->description=$request->opisanie;
        $service->price=$request->cena;
        $service->srok=$request->srok;
        $service->phone=$request->phone;
        $service->status=$request->status;
        $service->status=$request->status;
        $country=Country::where('name','like','%' .$request->country.'%' )->first();
        
      if(!empty($country->name)){
          
          $service->country_id=$country->id;
      }
        $city=$request->city;
        $service->city=$request->city;
        $service->status=$request->status;
        $service->flag_coment=$request->flag_comment;
        $service->flag_email=$request->flag_email;
         $service->save();
       
             return redirect()->route('admin.adminpanel.service'); 
  

}
}