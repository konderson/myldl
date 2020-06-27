<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    
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
     $reg_id=City::where('id',$city_id)->first();
     $region='';
     if(isset($reg_id->region_id)){
     $region=Region::where('id',$reg_id->region_id)->first();
     return $region->name;
     }
     return $region;
     
 }
   
}