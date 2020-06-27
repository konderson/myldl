<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentDele extends Model

{
    
      protected $table = 'comment_dele';


  public function user()
  {
    return $this->belongsTo('App\User');
  }
    
    
}