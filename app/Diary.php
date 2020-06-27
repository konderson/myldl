<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    public function getCount($id){
      
     
     $coment=CommentDiary::where('diary_id',$id)->get();
     $count=count($coment);
     return  $count;
     
 }
 
 public function likeCount($id){
           
             $count=Like::where('post_id',$id)->where('type_id',4)->where('dis_like',0)->count();
           return $count;
           }
           public function dislikeCount($id){
            $count=Like::where('post_id',$id)->where('type_id',4)->where('dis_like',1)->count();
           return $count;
           }
}