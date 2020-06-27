<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function Region(){
     
    return $this->belongsTo('App\Region');
  
    }
}