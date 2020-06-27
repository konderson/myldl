<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interview;
use Auth;
use Illuminate\Http\Request;

class InterViewController extends Controller
{
    public function add(){
        return view('admin.interview.add');
    }
    
    public function store(Request $request){
         $iv=new Interview();
         $iv->name=$request->nazva;
         $iv->user_id=Auth::user()->id;
         $iv->name_i=$request->name;
         $iv->age=$request->old;
         $iv->work=$request->job;
         $iv->dostijenia=$request->progress;
         $iv->hobbi=$request->interests;
         $iv->image=$request->images;
         $iv->tex=$request->texts;
         $iv->save();
         return redirect()->route('admin.adminpanel.interview');
        
        }
        
        public function index(){
            $interviews=Interview::orderBy('id','desc')->paginate(5);
      return view('admin.interview.index',compact("interviews"));
        }
        
        public function delete($id){
            $interview=Interview::findOrFail($id);
            $interview->delete();
             return redirect()->route('admin.adminpanel.interview');
        }
        
        public function edit($id){
        $interview=Interview::findOrFail($id);
     return view('admin.interview.edit',compact("interview"));
        }
        
        public function update(Request $request){
            
         $iv=Interview::findOrFail($request->id);
         $iv->name=$request->nazva;
         $iv->user_id=Auth::user()->id;
         $iv->name_i=$request->name;
         $iv->age=$request->old;
         $iv->work=$request->job;
         $iv->dostijenia=$request->progress;
         $iv->hobbi=$request->interests;
         $iv->image=$request->images;
         $iv->tex=$request->texts;
         $iv->save();
         return redirect()->route('admin.adminpanel.interview');
        }
}