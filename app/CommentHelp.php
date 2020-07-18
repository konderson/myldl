<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentHelp extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User');
  }
  
   public function helps(){
     
    return $this->belongsTo('App\Help','help_id');
  
    }
}