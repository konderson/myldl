<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interview;

class InterviewController extends Controller
{
    public function index(){
    $ivs=Interview::all();
    return view ('interview.all',compact('ivs'));
}

    public function item($id){
        
        $iv=Interview::findOrFail($id);
         $ivs=Interview::all();
          return view ('interview.item',compact('iv','ivs'));
        
    }
}