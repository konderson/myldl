<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Future;

class FutureController extends Controller
{
    
    public function add(){
        return view('myprofile.future.add');
    }
    
    public function store (Request $request){
         $future=new Future();
         $future->user_id=Auth::user()->id;
         $future->title=$request->title;
         $future->resource=$request->resource;
         $future->f_date=$request->date_begin;
         $future->save();
         
        
    }
    
    public function myfuture(){
        
        $futures=Future::where('user_id',Auth::user()->id)->get();
        return view('myprofile.future.myfuture',compact('futures'));
    }
    
    
    public function edit($id){
        
        $future=Future::findOrFail($id);
        if($future->user_id==Auth::user()->id){
            return view('myprofile.future.edit',compact('future'));
        }
        else{
            return view('error');
        }
    }
    
    public function update(Request $request){
        
          $future=Future::findOrFail($request->id);
        if($future->user_id==Auth::user()->id){
         $future->title=$request->title;
         $future->resource=$request->resource;
         $future->f_date=$request->date_begin;
         $future->save();
            return redirect('/profile/future_business');
            
        }
        else{
            return view('error');
        }
        
    }
    
    public function index($id){
        $future=Future::findOrFail($id);
          return view('myprofile.future.index',compact('future'));
        
    }
}