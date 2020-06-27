<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function getCount($id){
      
     
     $coment=CommentProject::where('project_id',$id)->get();
     $count=count($coment);
     return  $count;
     
 }
 
 public function likeCount($id){
           
             $count=Like::where('post_id',$id)->where('type_id',5)->where('dis_like',0)->count();
           return $count;
           }
           public function dislikeCount($id){
            $count=Like::where('post_id',$id)->where('type_id',5)->where('dis_like',1)->count();
           return $count;
           }
}