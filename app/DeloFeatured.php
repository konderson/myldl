<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeloFeatured extends Model
{
     public function user()
  { 
      return $this->belongsTo('App\User', 'user_id');
    
  }
  
  public function delo(){
       
    return $this->belongsTo('App\Dela');
  
  }
}