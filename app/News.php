<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
     public function tags()
  {
    return $this->belongsToMany('App\Tag','news_tag','news_id','tag_id');
  }
  
  public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }
  
  
  public function getCount($id){
      
     
     $coment=CommentNews::where('news_id',$id)->get();
     $count=count($coment);
     return  $count;
     
 }
 
 public function likeCount($id){
           
             $count=Like::where('post_id',$id)->where('type_id',3)->where('dis_like',0)->count();
           return $count;
           }
           public function dislikeCount($id){
            $count=Like::where('post_id',$id)->where('type_id',3)->where('dis_like',1)->count();
           return $count;
           }
}