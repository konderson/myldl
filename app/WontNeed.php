<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WontNeed extends Model
{
        public function user ()
  {
    return $this->belongsToMany('App\User','user_need','user_id','need_id');
  }
}