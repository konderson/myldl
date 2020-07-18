<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\EventType;

class EventController extends Controller
{
    public function index()
	{
		$events=Event::orderBy('id','desc')->paginate(30);
		return view('admin.Events.index',compact('events'));
	}
	
	public function edit($id)
  {
	  $event=Event::findOrFail($id);
	  $types=EventType::all();
	  return view('admin/Events/edit',compact('event','types'));
  }
  
  public function update(Request $request)
  {
	  $event=Event::findOrFail($request->e_id);
	  $event->title=$request->title;
	  $event->type=$request->type;
	 return  redirect()->away('/admin/event_ribbon_profile');
  }
  public function delete($id)
  {
	  $event=Event::findOrFail($id);
	  $event->delete();
	 return  redirect()->away('/admin/event_ribbon_profile');
  }
  
}
