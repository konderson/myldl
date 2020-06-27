<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
        public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }
  
      public function type()
  {
     
    return $this->belongsTo('App\EventType','type_id');
  }
  
}