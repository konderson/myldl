<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
    public function delo()
  {
    return $this->belongsTo('App\Dela');
  }
  
     public function userFrom()
  {
    return $this->belongsTo('App\User','from_user');
  }
    public function userTo()
  {
    return $this->belongsTo('App\User','user_id');
  }
}
