<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
       public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }
  
  
  public function getCount($id){
      
     
     $coment=CommentInter::where('interview_id',$id)->get();
     $count=count($coment);
     return  $count;
     
 }
 
 public function likeCount($id){
           
             $count=Like::where('post_id',$id)->where('type_id',2)->where('dis_like',0)->count();
           return $count;
           }
           public function dislikeCount($id){
            $count=Like::where('post_id',$id)->where('type_id',2)->where('dis_like',1)->count();
           return $count;
           }
 
}