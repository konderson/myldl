<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\City;
use Auth;
use App\Event;
use App\User;
use App\Service;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\DeloFeatured;
use Storage;


class ServiceController extends Controller
{
    
     public function add()
     {
         return view('myprofile/service/add');
     }
     
     public function open_serv($id){
         
         $servec=Service::findOrFail($id);
         if($servec->user_id==Auth::user()->id){
             $servec->status=1;
             $servec->save();
             $services_a=Service::where('user_id',Auth::user()->id)->where('status',1)->get();
        $services_nota=Service::where('user_id',Auth::user()->id)->where('status',0)->get();
             return view('myprofile/service/myservice',compact('services_a','services_nota'));
             
         }
         else{
             return('bad');
         }
     }
     public function close_serv($id){
         
         $servec=Service::findOrFail($id);
        
         if($servec->user_id==Auth::user()->id){ 
             
             $servec->status=0;
             $servec->save();
            
               $services_a=Service::where('user_id',Auth::user()->id)->where('status',1)->get();
        $services_nota=Service::where('user_id',Auth::user()->id)->where('status',0)->get();
             return view('myprofile/service/myservice',compact('services_a','services_nota'));
         }
         else{
             return('bad');
         }
         
         
         
     }
     
     public function deleteServ($id){
         $servec=Service::findOrFail($id);
        
         if($servec->user_id==Auth::user()->id){ 
             
            
             $servec->delete();
         }
         else{
             return "bad";
         }
     }
     
     
         public function update(Request $request){
			 
             $serv=Service::where('id',$request->id)->first();
			 if(empty($serv))
			 {
				 abort('404');
			 }
				 
              if($serv->user_id==Auth::user()->id){
                 $serv->title=$request->tema;
        $serv->razdel_id=$request->razdel_id;
        $serv->user_id=Auth::user()->id;
        $serv->description=$request->opisanie;
        $cena=0;
        if(!empty($request->cenarub)){
            $cena=$request->cenarub;
        }
        $serv->price=$cena;
        $serv->srok=$request->srok;
        $serv->phone=$request->phone;
        $serv->status=$request->status;
        $serv->country_id=$request->country;
        $city=City::where('id',$request->city)->first();
		if(!empty($city)){
        $serv->city_id =$request->city;
        $serv->city=$city->name;
		}
        $serv->status=$request->status;
        $serv->flag_coment=$request->flag_comment;
        $serv->flag_email=$request->flag_email;
        if(!empty($request->str_images)){
         $serv->images=$request->str_images;
         }
         $serv->save();
        $services_a=Service::where('user_id',Auth::user()->id)->where('status',1)->get();
        $services_nota=Service::where('user_id',Auth::user()->id)->where('status',0)->get();
             return view('myprofile/service/myservice',compact('services_a','services_nota'));
              }
         
             
         }
     
       public function edit($id){
         $serv=Service::where('id',$id)->first();
         if($serv->user_id==Auth::user()->id){
             return view('myprofile.service.edit',compact('serv'));
         }
         else{
             return "bad";
         }
         
         }
     
       public function myservice(){
        
        $services_a=Service::where('user_id',Auth::user()->id)->where('status',1)->get();
        $services_nota=Service::where('user_id',Auth::user()->id)->where('status',0)->get();
        
        
        return view('myprofile/service/myservice',compact('services_a','services_nota'));
    }
    
    public function store(Request $request){
        
        $service=new Service();
        $service->title=$request->tema;
        $service->razdel_id=$request->razdel_id;
        $service->user_id=Auth::user()->id;
        $service->description=$request->description;
        $cena=0;
        if(!empty($request->cenarub)){
            $cena=$request->cenarub;
        }
        $service->price=$cena;
        $service->srok=$request->srok;
        $service->phone=$request->phone;
        $service->status=$request->status;
        $service->status=$request->status;
         $service->country_id=$request->country;
        $city=City::findOrFail($request->city);
        $service->city_id =$request->city;
        $service->city=$city->name;
        $service->status=$request->status;
        $service->flag_coment=$request->flag_comment;
        $service->flag_email=$request->flag_email;
        if(!empty($request->str_images)){
         $service->images=$request->str_images;
         }
         $service->save();
		 
		 $event=new Event();//add event data
     $event->type_id=4;//id event_type
     $event->title='<p>'.Auth::user()->name.' добавил новое обьявление  -  <a href="/usluga/'.$service->id.'"> '.$service->title.'</a></p>';
     $event->user_id=Auth::user()->id;
     $event->save();
         $services_a=Service::where('user_id',Auth::user()->id)->where('status',1)->get();
        $services_nota=Service::where('user_id',Auth::user()->id)->where('status',0)->get();
             return view('myprofile/service/myservice',compact('services_a','services_nota'));
        
    }
    
     public function  getAllservice (Request $request){
         $services=Service::orderBy('id','desc')->paginate(4);
         $lservices=Service::orderBy('id','desc')->limit(5)->get();
         return view('myprofile/service/all',compact('services','lservices'));
         
     }
     
   public function  getService($id){
       
       $serv=Service::findOrFail($id);
        $services=Service::orderBy('id','desc')->limit(5)->get();
            
        
     return view('myprofile/service/index',compact('serv','services'));
   }
     
    
     public function filter(Request $request){
         $query=Service::where('id','>',0);
         
         if(!empty($request->serch_by_name)){
             
             $query->where('description','like','%'.$request->serch_by_name.'%')->orWhere('title','like','%'.$request->serch_by_name.'%');
              $lservices=Service::orderBy('id','desc')->limit(5)->get(); 
              $services=$query->orderBy('id','desc')->paginate(2);
              return view('myprofile/service/all',compact('services','lservices'));
             
             
             
         }
          if(!empty($request->country_id)){
             $query->where('country_id',$request->country_id);
         }
         if(!empty($request->region_id)){
             $id=City::select('id')->where('region_id',$request->region_id)->get();
            
             $query->whereIn('city_id',$id);
         }
         if(!empty($request->city_id)){
            
             $query->where('city_id',$request->city_id);
         }
          $lservices=Service::orderBy('id','desc')->limit(5)->get(); 
          $services=$query->orderBy('id','desc')->paginate(3);
          return view('myprofile/service/searche',compact('lservices','services'));
        
     }
    
    
}