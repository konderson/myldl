<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frend extends Model
{
      public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }
      public function userFrend()
  {
    return $this->belongsTo('App\User','frend_id');
  }
      public function types()
  {
    return $this->belongsTo('App\EventType','type_id');
  }
  
}