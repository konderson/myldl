<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;
class LikeController extends Controller
{
       public function store(Request $request){
           $like=0;
           if(Auth::check()){
               $like=Like::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('ip',$_SERVER['REMOTE_ADDR'])->count(); 
           if($like>0){
                $like=Like::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('user_id',Auth::user()->id)->count();
           }
           }
           else{
                $like=Like::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('ip',$_SERVER['REMOTE_ADDR'])->count();  
           }
        
           if($like>0){
                return response()->json(array('error' =>'Вы уже считаете классной даную публикацию'));
                
           }
           else{
          $like=new Like ();
          $like->type_id =$request->type_id;
          $like->post_id=$request->post_id;
          $like->dis_like=0;
          $like->ip=$_SERVER['REMOTE_ADDR'];
          if(Auth::check()){
             $like->user_id=Auth::user()->id; 
          }
          $like->save();
           $count=Like::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('dis_like',0)->count();
           return response()->json(array('count' =>$count));
           } 
           
       }
       
      
        public function storeDisLike (Request $request){
           $like=0;
           if(Auth::check()){
               $like=Like::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('ip',$_SERVER['REMOTE_ADDR'])->count(); 
           if($like>0){
                $like=Like::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('user_id',Auth::user()->id)->count();
           }
           }
           else{
                $like=Like::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('ip',$_SERVER['REMOTE_ADDR'])->count();  
           }
        
           if($like>0){
                return response()->json(array('error' =>'Вы уже считаете классной даную публикацию'));
                
           }
           else{
          $like=new Like ();
          $like->type_id =$request->type_id;
          $like->post_id=$request->post_id;
          $like->dis_like=1;
          $like->ip=$_SERVER['REMOTE_ADDR'];
          if(Auth::check()){
             $like->user_id=Auth::user()->id; 
          }
          $like->save();
           $count=Like::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('dis_like',1)->count();
           return response()->json(array('count' =>$count));
           } 
           
       }
       public function likeCount(Request $request){
           
             $count=Like::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('dis_like',0)->count();
           return response()->json(array('count' =>$count));
           }
           public function dislikeCount(Request $request){
            $count=Like::where('post_id',$request->post_id)->where('type_id',$request->type_id)->where('dis_like',1)->count();
           return response()->json(array('count' =>$count));
           }
}