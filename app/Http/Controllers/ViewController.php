<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\View;
use Auth;

class ViewController extends Controller
{
    public function store(Request $request){
           $view=0;
           if(Auth::check()){
               $view=View::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('ip',$_SERVER['REMOTE_ADDR'])->count(); 
           if($view>0){
                $view=View::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('user_id',Auth::user()->id)->count();
           }
           }
           else{
                $view=View::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('ip',$_SERVER['REMOTE_ADDR'])->count();  
           }
        
           if($view>0){
                
                
           }
           else{
          $view=new View ();
          $view->type_id =$request->type_id;
          $view->post_id=$request->post_id;
          $view->ip=$_SERVER['REMOTE_ADDR'];
          if(Auth::check()){
             $view->user_id=Auth::user()->id; 
          }
          $view->save();
           $count=View::where('post_id',$request->post_id)->where('type_id',$request->type_id)->count();
           return response()->json(array('count' =>$count));
           } 
           
       }
	   
	    public function viewCount(Request $request){
           
           $count=View::where('post_id',$request->post_id)->where('type_id',$request->type_id)->count();
           return response()->json(array('count' =>$count));
           }
}
