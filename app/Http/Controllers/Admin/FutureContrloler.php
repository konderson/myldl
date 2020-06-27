<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Future;
use Illuminate\Http\Request;

class FutureController extends Controller
{
    
    
  public function index(){
      $futures=Future::orderBy('id','desc')->paginate(5);
      return view('admin.future.index',compact("futures"));
  }
  
  public function delete($id){
  $future=Future::findOrFail($id);
  $future->delete();
   return redirect()->route('admin.adminpanel.future');
  }
  
  public function edit($id){
   $future=Future::findOrFail($id);
      return view('admin.future.edit',compact("future")); 
  }
  public function update(Request $request)
  {
      $future=Future::findOrFail($request->id);
      $future->title=$request->title;
      $future->description=$request->description;
      $future->resource=$request->resource;
      $future->f_date=$request->f_date;
       $future->save();      
     
            return redirect()->route('admin.adminpanel.future'); 
  }
    
    
    
}