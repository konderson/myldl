<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentFuture extends Model
{
     public function user()
  {
    return $this->belongsTo('App\User');
  }
}