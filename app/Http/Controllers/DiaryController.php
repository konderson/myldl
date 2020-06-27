<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diary;
class DiaryController extends Controller
{
     public function index(){
        //$tags=Tag:: orderBy('id','desc')->paginate(5);
        $diaries=Diary::orderBy('id','desc')->paginate(5);
        $ldiaries=Diary::orderBy('view','desc')->orderBy('created_at','desc')->limit(5)->get();
       
      return view('diary.all',compact('diaries','ldiaries'));
    }
       public function item($id){
        
        $diary=Diary::findOrFail($id);
         $ldiaries=Diary::orderBy('view','desc')->orderBy('created_at','desc')->limit(5)->get();
          return view ('diary.item',compact('ldiaries','diary'));
        
    }
}