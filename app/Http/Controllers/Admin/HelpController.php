<?php

namespace App\Http\Controllers\Admin;
use App\Service;
use App\City;
use App\Help;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    
  public function   HochyPomIndex()
  {
      $helps=Help::where('type',1)->orderBy('id','desc')->paginate(5);
       return view('admin.help.index1',compact("helps"));
  }
  
  public function   NeedPomIndex()
  {
      $helps=Help::where('type',2)->orderBy('id','desc')->paginate(5);
       return view('admin.help.index2',compact("helps"));
  }
    
     public function   NahodkiIndex()
  {
      $helps=Help::where('type',3)->orderBy('id','desc')->paginate(5);
       return view('admin.help.index3',compact("helps"));
  }
  
  public function HochyPomEdit ($id){
      
      $help=Help::findOrFail($id);
       return view('admin.help/.edit1',compact("help")); 
  }
  
  public function NeedPomEdit ($id){
      
      $help=Help::findOrFail($id);
       return view('admin.help/.edit2',compact("help")); 
  }
  public function NahodkiEdit ($id){
      
      $help=Help::findOrFail($id);
       return view('admin.help/.edit3',compact("help")); 
  }
  
 public function NahodkiDelete ($id)
{
     $help=Help::findOrFail($id);
     $help->delete();
     return redirect()->route('admin.adminpanel.naxodki');
}  

 public function  HochyPompDelete ($id)
{
     $help=Help::findOrFail($id);
     $help->delete();
     return redirect()->route('admin.adminpanel.hochu_pom');
}  


   public function  NeedPomDelete ($id)
    {
     $help=Help::findOrFail($id);
     $help->delete();
     return redirect()->route('admin.adminpanel.poiski');
     }  

  
  
  public function HochyPompUdate (Request $request){
      $help=Help::findOrFail($request->id);
        $help->type=$request->razdel_id;
        $help->title=$request->title;
        $help->description=$request->description;
        $help->email=$request->email;
        $help->phone=$request->phone;
        $help->cocial=$request->social;
        $help->city=$request->city;
          $country=Country::where('name','like','%' .$request->country.'%' )->first();
        
      if(!empty($country->name)){
          
          $help->country_id=$country->id;
      }
        $help->status=$request->status;
         $help->save();
         return redirect()->route('admin.adminpanel.hochu_pom');
      
  }
     public function NeedPomUdate (Request $request){
      $help=Help::findOrFail($request->id);
        $help->type=$request->razdel_id;
        $help->title=$request->title;
        $help->description=$request->description;
        $help->email=$request->email;
        $help->phone=$request->phone;
        $help->cocial=$request->social;
        $help->city=$request->city;
          $country=Country::where('name','like','%' .$request->country.'%' )->first();
        
      if(!empty($country->name)){
          
          $help->country_id=$country->id;
      }
        $help->status=$request->status;
         $help->save();
         return redirect()->route('admin.adminpanel.poiski');
      
  }
    public function NahodkiUdate (Request $request){
      $help=Help::findOrFail($request->id);
        $help->type=$request->razdel_id;
        $help->title=$request->title;
        $help->description=$request->description;
        $help->email=$request->email;
        $help->phone=$request->phone;
        $help->cocial=$request->social;
        $help->city=$request->city;
          $country=Country::where('name','like','%' .$request->country.'%' )->first();
        
      if(!empty($country->name)){
          
          $help->country_id=$country->id;
      }
        $help->status=$request->status;
         $help->save();
         return redirect()->route('admin.adminpanel.naxodki');
      
  }
}