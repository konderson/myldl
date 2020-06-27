<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function add(){
        return view('admin.tag.add');
    }
    public function store(Request $request){
        $tag=new Tag();
        $tag->name=$request->nazva;
        $tag->save();
        
      return redirect()->route('admin.adminpanel.tag');
        
    }
    
    public function edit($id){
        
        $tag=Tag::findOrFail($id);
        return view ('admin.tag.edit',compact('tag'));
        
    }
    
    public function index(){
        $tags=Tag:: orderBy('id','desc')->paginate(5);
      return view('admin.tag.index',compact("tags"));
    }
    
    public function update(Request $request){
        $tag=Tag::findOrFail($request->id);
        $tag->name=$request->nazva;
        $tag->save();
        
      return redirect()->route('admin.adminpanel.tag');
        
    }
    
     public function delete ($id){
        
        $tag=Tag::findOrFail($id);
        $tag->delete();
         return redirect()->route('admin.adminpanel.tag');
        
    }
}