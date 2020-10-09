<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Person;
use Validator;
use Intervention\Image\Facades\Image;
use App\DeloFeatured;
use App\City;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Event;
use Storage;
use App\UserHeplpsMake as UserHelpsMake;
class ProfileController extends Controller
{
    public function index()
    {
            $events=Event::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(10);
            //dd($events->lastPage());
        // dd($events->total());
    return view('myprofile.index',compact('events'));
    }
	
	public function deleteAvatar(Request $request)
	{
		if($request->avatar!=null){
			$person=Person::findOrFail(Auth::user()->person->id);
			$person->avatar='default.png';
			$person->save();
		    Storage::disk('public')->delete('avatar/'.$request->avatar);
		    echo 'ok';
		} 
	}
	
    
    public function profileView(){
        $userNeed=new UserHelpsMake();
       return view('myprofile.view',compact('userNeed'));
        
    }
    
    public function profileEdit()
    {
		$user=Auth::user();
		$userNeed=new UserHelpsMake();
        return view('myprofile.edit',compact('user','userNeed'));
    }
     public function profileUpdate(Request $request )
    {
     
       //die(var_dump($request->help_additional));
	  $userHelp=new UserHelpsMake();
	   if(isset($request->help_additional[1])){
	   $userHelp=new UserHelpsMake();
	   	if ($userHelp->where('user_id',Auth::user()->id)->where('need_id',1)->count()==0) {
	   		$userHelp->user_id=Auth::user()->id;
	        $userHelp->need_id=1;
	        $userHelp->save();
	   	} 
         }
	   else{
	  $userHelp->where('user_id',Auth::user()->id)->where('need_id',1)->delete();
	   }

if(isset($request->help_additional[2])){
	   	$userHelp=new UserHelpsMake();
	   	if ($userHelp->where('user_id',Auth::user()->id)->where('need_id',2)->count()==0) {
	   		$userHelp->user_id=Auth::user()->id;
	        $userHelp->need_id=2;
	        $userHelp->save();
	   	} 
         }
	   else{
	  $userHelp->where('user_id',Auth::user()->id)->where('need_id',2)->delete();
	   }


	   if(isset($request->help_additional[3])){
	   	$userHelp=new UserHelpsMake();
	   	if ($userHelp->where('user_id',Auth::user()->id)->where('need_id',3)->count()==0) {
	   		$userHelp->user_id=Auth::user()->id;
	        $userHelp->need_id=3;
	        $userHelp->save();
	   	} 
         }
	   else{
	  $userHelp->where('user_id',Auth::user()->id)->where('need_id',3)->delete();
	   }



	   if(isset($request->help_additional[4])){
	   	$userHelp=new UserHelpsMake();
	   	if ($userHelp->where('user_id',Auth::user()->id)->where('need_id',4)->count()==0) {
	   		$userHelp->user_id=Auth::user()->id;
	        $userHelp->need_id=4;
	        $userHelp->save();
	   	} 
         }
	   else{
	  $userHelp->where('user_id',Auth::user()->id)->where('need_id',4)->delete();
	   }

if(isset($request->help_additional[5])){
	   	$userHelp=new UserHelpsMake();
	   	if ($userHelp->where('user_id',Auth::user()->id)->where('need_id',5)->count()==0) {
	   		$userHelp->user_id=Auth::user()->id;
	        $userHelp->need_id=5;
	        $userHelp->save();
	   	} 
         }
	   else{
	  $userHelp->where('user_id',Auth::user()->id)->where('need_id',5)->delete();
	   }
	   if(isset($request->help_additional[6])){
	   	$userHelp=new UserHelpsMake();
	   	if ($userHelp->where('user_id',Auth::user()->id)->where('need_id',6)->count()==0) {
	   		$userHelp->user_id=Auth::user()->id;
	        $userHelp->need_id=6;
	        $userHelp->save();
	   	} 
         }
	   else{
	  $userHelp->where('user_id',Auth::user()->id)->where('need_id',6)->delete();
	   }
	   if(isset($request->help_additional[7])){
	   	$userHelp=new UserHelpsMake();
	   	if ($userHelp->where('user_id',Auth::user()->id)->where('need_id',7)->count()==0) {
	   		$userHelp->user_id=Auth::user()->id;
	        $userHelp->need_id=7;
	        $userHelp->save();
	   	} 
         }
	   else{
	  $userHelp->where('user_id',Auth::user()->id)->where('need_id',7)->delete();
	   }

	   if(isset($request->help_additional[8])){
	   	$userHelp=new UserHelpsMake();
	   	if ($userHelp->where('user_id',Auth::user()->id)->where('need_id',8)->count()==0) {
	   		$userHelp->user_id=Auth::user()->id;
	        $userHelp->need_id=8;
	        $userHelp->save();
	   	} 
         }
	   else{
	  $userHelp->where('user_id',Auth::user()->id)->where('need_id',8)->delete();
	   }
	   
	   if(isset($request->help_additional[9])){
	   	$userHelp=new UserHelpsMake();
	   	if ($userHelp->where('user_id',Auth::user()->id)->where('need_id',9)->count()==0) {
	   		$userHelp->user_id=Auth::user()->id;
	        $userHelp->need_id=9;
	        $userHelp->text=$request->more_text;
	        $userHelp->save();
	   	}
	   	else{
	   		$text=$userHelp->where('user_id',Auth::user()->id)->where('need_id',9)->first();
	   		$text->text=$request->more_text;
	   		$text->save();
	   	} 
         }
	   else{
	  $userHelp->where('user_id',Auth::user()->id)->where('need_id',9)->delete();
	   }

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
			 /*foreach($request->help_additional as $key =>$nedd)
			 {
				$user->need()->attach($key);
			 }*/
			 }
             $person->names=$request->name;
             $person->birthday=Carbon::parse($request->birthday)->format('d-m-Y');
             $person->country=$request->country;
             if($request->name_photo!=null){
			 $person->avatar=$request->name_photo;
			}
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
        
        return redirect()->route('profile.view');
    }
	
	 public function ajaxFilterLenta(Request $request){
		 $events='';
		 $curentPage='';
	 if($request->type==='myDeladLenta')
	 {
        $events=Event::where('user_id',Auth::user()->id)->where('type_id',1)->paginate(2);
		$curentPage=$request->page;
		
		}
	 if($request->type === 'izbDelodLenta'){
	     $events=Event::where('user_id',Auth::user()->id)->where('type_id',7)->paginate(2);
         $curentPage=$request->page;
     }
       if(isset($request->more)){
		return view('/myprofile/filters/filters',compact('events','curentPage'));
	   } else {
        return view('/myprofile/filters/filters_all',compact('events','curentPage'));
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