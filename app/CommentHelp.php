<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentHelp extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}