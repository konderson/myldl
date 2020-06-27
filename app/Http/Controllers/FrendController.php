<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Frend;
use Auth;
use App\Event;

class FrendController extends Controller
{
    public function add(Request $request){
       
     $check_frend=Frend::where('user_id',Auth::user()->id)->where('frend_id',$request->frend_id)->first();
     
     if($check_frend!==null){
        return "have"; 
     }
     else
     {
        $frend =new Frend();
        $frend->user_id=Auth::user()->id;
        $frend->frend_id=$request->frend_id;
        $frend->save();
        $event=new Event();//add event data
        $event->type_id=2;//id _type
        $event->title=Auth::user()->name.' добавил новою связь - <a href="/user/ '.$frend->frend_id.'">'.$frend->user->name.'</a>';
     $event->user_id=Auth::user()->id;
     $event->save();
        return "ok";
     }
    }
    public function getFrend(Request $request)
    {
        $frends=Frend::where('user_id',Auth::user()->id)->get();
        
        return view('myprofile.frend.index',compact('frends'));
    }
     public function searchFrend(Request $request){
        $frends=Frend::where('user_id',Auth::user()->id)->get();
        $id=[];
         
        foreach($frends as $frend)
        {
            $id[]=$frend->id;
        }
       // $frends=User::whereIn('id',$id)->where('name', 'like', '%' . $request->str . '%');
       
     }
}