<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public function user()
  {
    return $this->belongsTo('App\User');
  }
  
     public function Country()
  {
   
    return $this->belongsTo('App\Country','country');
  }
  
  public function City()
  {
	return $this->belongsTo('App\City','city_id');
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