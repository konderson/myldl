<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Dela;
use App\City;
use Auth;
use App\User;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\DeloFeatured;
use Storage;
use App\Help;
class HelpController extends Controller
{
    
    
    
    public function myhelp(){
        
        $helps=Help::where('user_id',Auth::user()->id)->get();
        $count_need=Help::where('user_id',Auth::user()->id)->where('type',1)->count();
        $coun_whelp=Help::where('user_id',Auth::user()->id)->where('type',2)->count();
        $coun_search=Help::where('user_id',Auth::user()->id)->where('type',3)->count();
        return view('myprofile/help/myhelp',compact('helps','count_need','coun_whelp','coun_search'));
    }
    
    




public function edit ($id){
    
    $help=Help::where('id',$id)->first();
     return view('myprofile/help/edit',compact('help'));
    
    
}
    
    
   public function  getHelp($id){
  
        $help=Help::where('id',$id)->first();
        
       
        if($help->type==1){
            $helps=Help::where('type',1)->orderBy('id','desc')->limit(5)->get();
           
            
        }
         if($help->type==2){
            $helps=Help::where('type',2)->orderBy('id','desc')->limit(5)->get();
            
        }
        if($help->type==3){
            $helps=Help::where('type',3)->orderBy('id','desc')->limit(5)->get();
            
        }
     return view('myprofile/help/index',compact('help','helps'));
       
   }
    
    public function update(Request $request){
      
        $help=Help::findOrFail($request->id);
        $help->user_id=Auth::user()->id;
        $help->type=$request->type;
        $help->title=$request->title;
        $help->description=$request->description;
        $help->email=$request->email;
        $help->phone=$request->phone;
        $help->cocial=$request->cocial;
        $help->country_id=$request->country;
        $city=City::findOrFail($request->city);
        $help->city_id =$request->city;
        $help->city=$city->name;
        $help->status=$request->status;
        if(!empty($request->str_images)){
         $help->images=$request->str_images;
         }
         $help->save();
         return redirect()->route('profile.help.edit',$request->help_id);
    }
    
    
    
    
   public function store(Request $request ){
    
        $help=new Help();
         
        $help->user_id=Auth::user()->id;
        $help->type=$request->type;
        $help->title=$request->title;
        $help->description=$request->description;
        $help->email=$request->email;
        $help->phone=$request->phone;
        $help->cocial=$request->cocial;
        $help->country_id=$request->country;
        if($request->city!=null){
        $city=City::findOrFail($request->city);
        $help->city_id =$request->city;
        $help->city=$city->name;
        }
        $help->status=$request->status;
        if(!empty($request->str_images)){
         $help->images=$request->str_images;
         }
         $help->save();
         
       return redirect()->route('help.my');
    }
    
    
    
       
     public function ajax_delete_photo(Request $request){
         
         if(!empty($request->name)){
             if($request->name!=='noimg.png'){
                 
            Storage::disk('public')->delete('help/'.$request->name);
              $help=Help::findOrFail($request->id);
             $help->images="noimg.png";
             $help->save();
             return response()->json(array('good' =>'Файл удален'));
            
             }
             
         }
         return response()->json(array('error' =>'Ошибка при удалении файла'));
         
     }
     
    
    public function ajax_reploadupload(Request $request){
        
         if($request->name!=='noimg.png'){
                 
            Storage::disk('public')->delete('help/'.$request->photo);
              
            
             }
        
        
        if (isset($request->userfile)) {
          $image=$request->userfile;
              $currentData = Carbon::now()->toDateString();
            $imagename =$currentData . '-' . uniqid() . '-' . $image->getClientOriginalName(); 
            
            $img = Image::make($image->getRealPath());
            $img->resize(360, 320, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            Storage::disk('public')->put('help/' . $imagename, $img);
            //Storage::disk('local')->put('images/1/smalls'.'/'.$fileName, $img, 'public');
        
            
                echo $imagename;
      }
        
    }
    
    
    public function  ajax_upload_avatar(Request $request){
       
        if (isset($request->userfile)) {
          $image=$request->userfile;
              $currentData = Carbon::now()->toDateString();
            $imagename =$currentData . '-' . uniqid() . '-' . $image->getClientOriginalName(); 
            
            $img = Image::make($image->getRealPath());
            $img->resize(360, 320, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            Storage::disk('public')->put('help/' . $imagename, $img);
            //Storage::disk('local')->put('images/1/smalls'.'/'.$fileName, $img, 'public');
        
            
                echo $imagename;
      }
   }
    
     public function add()
     {
         return view('myprofile/help/add');
     }
     
     public function  getAllwont(){
         $helps=Help::where('type',1)->orderBy('id','desc')->paginate(3);
         $lhelps=Help::where('type',2)->orderBy('id','desc')->limit(5)->get();
         return view('myprofile/help/helpall1',compact('helps','lhelps'));
         
     }
     
     
      public function  getAllpoiski(){
         $helps=Help::where('type',2)->orderBy('id','desc')->paginate(3);
         $lhelps=Help::where('type',1)->orderBy('id','desc')->limit(5)->get();
         return view('myprofile/help/helpall2',compact('helps','lhelps'));
         
     }
     
     
      public function  getAllNahodki(){
         $helps=Help::where('type',3)->orderBy('id','desc')->paginate(3);
         $lhelps=Help::where('type',2)->orderBy('id','desc')->limit(5)->get();
         return view('myprofile/help/helpall3',compact('helps','lhelps'));
         
     }
     
      public function filterNahodki(Request $request){
         $query=Help::where('type',$request->type);
         
         if(!empty($request->serch_by_name)){
             $query->where('description','like','%'.$request->serch_by_name.'%')->orWhere('title','like','%'.$request->serch_by_name.'%');
              $lhelps=Help::where('type',2)->orderBy('id','desc')->limit(5)->get(); 
              $helps=$query->orderBy('id','desc')->paginate(2);
              return view('myprofile/help/helpall3',compact('helps','lhelps'));
             
             
             
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
          $lhelps=Help::where('type',2)->orderBy('id','desc')->limit(5)->get(); 
          $helps=$query->orderBy('id','desc')->paginate(3);
          return view('myprofile/help/search',compact('helps','lhelps'));
         
         
     }
     
     public function filterPoiski(Request $request){
         $query=Help::where('type',$request->type);
         
         if(!empty($request->serch_by_name)){
             $query->where('description','like','%'.$request->serch_by_name.'%')->orWhere('title','like','%'.$request->serch_by_name.'%');
              $lhelps=Help::where('type',1)->orderBy('id','desc')->limit(5)->get(); 
              $helps=$query->orderBy('id','desc')->paginate(2);
              return view('myprofile/help/helpall2',compact('helps','lhelps'));
             
             
             
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
          $lhelps=Help::where('type',1)->orderBy('id','desc')->limit(5)->get(); 
          $helps=$query->orderBy('id','desc')->paginate(3);
          return view('myprofile/help/search',compact('helps','lhelps'));
         
         
     }
     
     
     
     
     public function filter(Request $request){
         $query=Help::where('type',$request->type);
         
         if(!empty($request->serch_by_name)){
             $query->where('description','like','%'.$request->serch_by_name.'%')->orWhere('title','like','%'.$request->serch_by_name.'%');
              $lhelps=Help::where('type',2)->orderBy('id','desc')->limit(5)->get(); 
              $helps=$query->orderBy('id','desc')->paginate(2);
              return view('myprofile/help/helpall1',compact('helps','lhelps'));
             
             
             
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
          $lhelps=Help::where('type',2)->orderBy('id','desc')->limit(5)->get(); 
          $helps=$query->orderBy('id','desc')->paginate(3);
          return view('myprofile/help/search',compact('helps','lhelps'));
        
     }
    
    
}