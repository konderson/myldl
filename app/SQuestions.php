<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SQuestions extends Model
{
    public static  function getCountAnswer($q_id){
    
      return Answer::where('q_id',$q_id)->count();
    }
    
    public static  function endDate($date){
        
        if(Carbon::parse($date)->format("d.m.y")<Carbon::now()){
            return false;//срок не оконен
        }
        else{
          return  true;//дата завершена
        }
    }
}