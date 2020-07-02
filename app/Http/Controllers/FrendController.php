<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Frend;
use Auth;
use App\User;
use App\Event;

class FrendController extends Controller
{
    public function add(Request $request){
       
     $check_frend=Frend::where('user_id',Auth::user()->id)->where('frend_id',$request->frend_id)->first();
     
     if($check_frend!==null){
        return "have"; 
     }
     else
     {
        $frend =new Frend();
        $frend->user_id=Auth::user()->id;
        $frend->frend_id=$request->frend_id;
        $frend->save();
        $event=new Event();//add event data
        $event->type_id=2;//id _type
        $event->title=Auth::user()->name.' добавил новою связь - <a href="/user/ '.$frend->frend_id.'">'.$frend->user->name.'</a>';
     $event->user_id=Auth::user()->id;
     $event->save();
        return "ok";
     }
    }
    public function getFrend(Request $request)
    {
        $frends=Frend::where('user_id',Auth::user()->id)->get();
        
        return view('myprofile.frend.index',compact('frends'));
    }
     public function searchFrend(Request $request){
        $frends=Frend::where('user_id',Auth::user()->id)->get();
	    
		
        $id=[];
         
        foreach($frends as $frend)
        {
            $id[]=$frend->frend_id;
        }
		
        $frends=User::whereIn('id',$id)->where('name', 'like', '%' . $request->str . '%')->get();
		
		$output='';
		foreach($frends as $frend)
		{
         $output.="<div class='person'>
	           <div class='person-photo'>
                            <div class='avatar' style='background-image: url(/storage/avatar/".$frend->person->avatar.");'></div>";
							
                             if($frend->isOnline()==true)
							 {	 
						  
						  $output.="<span class='status' title='Онлайн'></span>";
                           
							 }
							else
							{
								
                             $output.=" <span class='offline status' style='background-color: #ca3d3d;' title='Офлайн'></span>";
							}
                         
                         $output.="
                             <a href='/del/frend/".$frend->id."' class='close mem-close del-relation'></a>
                           </div>
                        <div>
                        <a href='/user/".$frend->id."}}'>".$frend->name."</a>
                    </div>
                       </div>";	
       
     }
	 echo $output;
	 }
	 
	 public function delete($id)
	 {
		 $frends=Frend::where('user_id',Auth::user()->id)->where('frend_id',$id)->first();
		 $frends->delete();
		 return redirect()->back();
	 }
	 
	 
	 
	 public function ajaxAllFrend()
	 {
	   $frends=Frend::where('user_id',Auth::user()->id)->get();
	 
	$output='';
		foreach($frends as $frend)
		{
			
			
               $output.="<div class='person'>
	           <div class='person-photo'>
                            <div class='avatar' style='background-image: url(/storage/avatar/".$frend->userFrend->person->avatar.");'></div>";
							
                             if($frend->userFrend->isOnline()==true)
							 {	 
						  
						  $output.="<span class='status' title='Онлайн'></span>";
                           
							 }
							else
							{
								
                             $output.=" <span class='offline status' style='background-color: #ca3d3d;' title='Офлайн'></span>";
							}
                         
                         $output.="
                             <a href='/del/frend/".$frend->userFrend->id."' class='close mem-close del-relation'></a>
                           </div>
                        <div>
                        <a href='/user/".$frend->userFrend->id."'>".$frend->userFrend->name."</a>
                    </div>
                       </div>";	
       
         
		}
	       echo $output;
	 }
	 
	 
	 public function isOnline()
	 {
	 $frends=Frend::where('user_id',Auth::user()->id)->get();
	 
	$output='';
		foreach($frends as $frend)
		{
			
			if($frend->userFrend->isOnline()==true){
               $output.="<div class='person'>
	           <div class='person-photo'>
                            <div class='avatar' style='background-image: url(/storage/avatar/".$frend->userFrend->person->avatar.");'></div>";
							
                             if($frend->userFrend->isOnline()==true)
							 {	 
						  
						  $output.="<span class='status' title='Онлайн'></span>";
                           
							 }
							else
							{
								
                             $output.=" <span class='offline status' style='background-color: #ca3d3d;' title='Офлайн'></span>";
							}
                         
                         $output.="
                             <a href='/del/frend/".$frend->userFrend->id."' class='close mem-close del-relation'></a>
                           </div>
                        <div>
                        <a href='/user/".$frend->userFrend->id."'>".$frend->userFrend->name."</a>
                    </div>
                       </div>";	
       
         }
		}
	       echo $output;
	   }	 
	 
	 
}