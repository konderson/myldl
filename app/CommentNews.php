<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentNews extends Model
{
      public function user()
  {
    return $this->belongsTo('App\User');
  }
}