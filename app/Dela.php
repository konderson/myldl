<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dela extends Model
{
     protected $table = 'dela';
     
     public function userOne()
  {
    return $this->belongsTo('App\User','user_id');
  }
     
      public function country()
  {
     
    return $this->belongsTo('App\Country','country_id');
  }
  
      public function City()
  {
     
    return $this->belongsTo('App\City','city_id');
  }
   public function user()
  {
    return $this->belongsToMany('App\User','user_dela','delo_id','user_id');
  }
   public  static function  getRegion($city_id){
     $reg_id=City::select('region_id')->where('id',$city_id)->first();
    return $region=Region::select('name')->where('id',$reg_id);
     
 }
   public function getCount($id){
      
     
     $coment=CommentDele::where('dela_id',$id)->get();
     $count=count($coment);
     return  $count;
     
 }
 
 public function likeCount($id){
           
             $count=Like::where('post_id',$id)->where('type_id',1)->where('dis_like',0)->count();
           return $count;
           }
           public function dislikeCount($id){
            $count=Like::where('post_id',$id)->where('type_id',1)->where('dis_like',1)->count();
           return $count;
           }
 
 
}