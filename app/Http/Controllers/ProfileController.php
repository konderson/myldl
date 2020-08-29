<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Person;
use Validator;
use Intervention\Image\Facades\Image;
use App\DeloFeatured;
use Storage;
use App\City;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Event;
class ProfileController extends Controller
{
    public function index()
    {
            $events=Event::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(10);
            //dd($events->lastPage());
        // dd($events->total());
    return view('myprofile.index',compact('events'));
    }
    
    public function profileView(){
        
       return view('myprofile.view');
        
    }
    
    public function profileEdit()
    {
		$user=Auth::user();
        return view('myprofile.edit',compact('user'));
    }
     public function profileUpdate(Request $request )
    {
     
        
         $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email' => 'required,email'
            ]);
        
        
        $user=User::findOrFail(Auth::user()->id);
         if ($validator->passes()) {
             $person=Person::where('user_id',Auth::user()->id)->first();
			 
             $person->help=$request->help;
			 if($request->help==='want'){
				 Auth::user()->need()->detach();
			 foreach($request->help_additional as $key =>$nedd)
			 {
				$user->need()->attach($key);
			 }
			 }
             $person->names=$request->name;
             $person->birthday=$request->birthday;
             $person->country=$request->country;
			 $person->avatar=$request->name_photo;
			 $person->city_id=$request->city;
		 if(isset($request->city)){
			 $city=City::findOrFail($request->city);
			 $person->city=$city->name;
		 }
			 
             $person->about=$request->about;
             $person->pol=$request->pol;
             $person->status_str=$request->status_str ;
             $person->skype=$request->skype;
             $person->site=$request->site;
             $person->dolznost=$request->dolzhnost;
             $person->dohod=$request->dohod;
             $person->hobbi=$request->hobbi;
             $person->save();
         }
            else{
          
            return response()->json(array('edit_errors' => $validator->getMessageBag()->toArray()));
            
            }
        
        return view('myprofile.view');
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

            Storage::disk('public')->put('/avatar/' . $imagename, $img);
            //Storage::disk('local')->put('images/1/smalls'.'/'.$fileName, $img, 'public');
        
            
                echo $imagename;
      }
   }
	
	
	
    public function ajaxFilter(Request $request){
        $events=Event::where('user_id',Auth::user()->id)->paginate(2);
        $counter=$request->page;
         //$events->total();
        return view('myprofile.filters.filters',compact('events','counter'));
        
    }
     public function ajaxFilterAll(Request $request){
        $events=Event::where('user_id',Auth::user()->id)->paginate(2);
        $counter=$request->page;
         //$events->total();
        return view('/profile/ajax_lenta_all',compact('events','counter'));
        
    }
    
    public function settings(){
        return view('myprofile.settings.setting');
    }
  public function  check_psw(Request $request){
      
      $current_password = Auth::User()->password; 
      
         if(Hash::check($request->data, $current_password))
         {
             
             echo 'ok';
         }
         else
         {
           echo 'none';
          }
  }
  
  
  public function chengePsw(Request $request)
  {
	  $user= Auth::user();
	  $user->password=Hash::make($request->pass);
	  $user->save();
	  
	  return redirect()->route('profile.index');
  }
  
    public function UBlockAccount(Request $request)
  {
	  $user= Auth::user()->person;
	  $user->active=3;
	  $user->save();
	   $event=new Event();//add event data
     $event->type_id=5;//id asset_type
     $event->title='<p>'.Auth::user()->name.' заблокировал страницу </p>';
     $event->user_id=Auth::user()->id;
     $event->save();
	  return redirect()->route('profile.index');
  }
  public function UnBlockAccount(Request $request)
  {
	  
	  $user= Auth::user()->person;
	  $user->active=1;
	  $user->save();
	   $event=new Event();//add event data
     $event->type_id=5;//id asset_type
     $event->title='<p>'.Auth::user()->name.' разблокировал  страницу </p>';
     $event->user_id=Auth::user()->id;
     $event->save();
	  return redirect()->route('profile.index');
  }
  
    public function DeleteAccount(Request $request)
  {
	  $user= Auth::user()->person;
	  $user->active=3;
	  $user->save();
	  
	  return redirect()->route('profile.index');
  }
    
}