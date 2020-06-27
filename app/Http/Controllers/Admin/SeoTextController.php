<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\ SeoText;
use Illuminate\Http\Request;

class SeoTextController extends Controller
{
    public function edit($id){
       
        $st=SeoText::findOrFail($id);
        
        return view ('admin.seo_text.edit',compact('st'));
        
    }
    
    public function index(){
        //$tags=Tag:: orderBy('id','desc')->paginate(5);
       $stexts=SeoText::orderBy('id','desc')->get();
        
      return view('admin.seo_text.index',compact('stexts'));
    }
    
   
    
    public function update(Request $request){
        $st=SeoText::findOrFail($request->id);
        $st->title=$request->title;
        $st->description=$request->description;
        $st->keyw=$request->keywords;
        $st->text=$request->editor1;
        $st->save();
        
       
      return redirect()->route('admin.adminpanel.seo_text');
        
    }
}