<?php

namespace App\Http\Controllers;
use App\Idie as Idia;
use App\Event;
use Auth;
use Illuminate\Http\Request;

class IdieController extends Controller
{
    public function store(Request $request)
    {
        $idea=new Idia();
        $idea->user_id=Auth::user()->id;
        $idea->title=$request->title;
        $idea->description=$request->content;
        $idea->save();
        $event=new Event();//add event data
        $event->type_id=3;//id _type
        $event->title=Auth::user()->name.' добавил новою мысль - '.$idea->title;
     $event->user_id=Auth::user()->id;
     $event->save();
        return redirect()->route('profile.myidea');
    }
    
    public function add()
    {
       return view ('myprofile.ide.add'); 
    }
    
    public function edit($id)
    {
        
          $idea=Idia::findOrFail($id);
          return view ('myprofile.ide.edit',compact('idea'));
    }
    
    public function update(Request $request)
    {
        $idea=Idia::findOrFail($request->id);
        $idea->title=$request->title;
        $idea->description=$request->content;
        $idea->save();
         $event=new Event();//add event data
        $event->type_id=3;//id _type
        $event->title=Auth::user()->name.' изминил мысль - '.$idea->title;
     $event->user_id=Auth::user()->id;
     $event->save();
         return redirect()->route('profile.myidea');
    }
    
    public function myIdea()
    {
         $ideas=Idia::where('user_id',Auth::user()->id)->get();
         
          return view ('myprofile.ide.ideas',compact('ideas'));
    }
    
     public function Index($id)
     {
          $idea=Idia::findOrFail($id);
          return view('myprofile.ide.index',compact('idea'));
    }
     
     public function delete($id)
     {
          $idea=Idia::findOrFail($id);
          if(Auth::user()->id==$idea->user_id)
          {
              $idea->delete();
               return redirect()->route('profile.myidea');
              
          }
          else{
              return redirect()->route('profile.myidea');
          }
     }
    
}