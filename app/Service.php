<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public static function getPhoto($data){
     $img=explode(",", $data);
      return $img[0];
    }
    
     public function country()
  {
     
    return $this->belongsTo('App\Country','country_id');
  }
  
    
     public function City()
  {
     
    return $this->belongsTo('App\City');
  }
     public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }
 public  static function  getRegion($city_id){
     $reg_id=City::select('region_id')->where('id',$city_id)->first();
    return $region=Region::select('name')->where('id',$reg_id);
     
 }
}