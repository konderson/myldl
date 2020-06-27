<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Razdel;
use App\SQuestions;
use Illuminate\Http\Request;

class RazdelController extends Controller
{
    public function store(Request $request){
        $razdel=new Razdel();
        $razdel->name=$request->name;
        $razdel->flag=$request->flag;
        $razdel->save();
         return redirect()->route('admin.adminpanel.razdel');
    }
    
    public function add(){
        
        return view('admin.razdel.add');
    }
    
    public function index(){
        $razdels=Razdel::all();
       return view('admin.razdel.index',compact('razdels'));
    }
    
    public function edit($id){
        
        $razdel=Razdel::findOrFail($id);
         return view('admin.razdel.edit',compact('razdel'));
    }
    
    public function update(Request $request){
        $razdel=Razdel::findOrFail($request->id);
        $razdel->name=$request->name;
        $razdel->flag=$request->flag;
        $razdel->save();
         return redirect()->route('admin.adminpanel.razdel');
    }
    
    public function delete($id){
        $razdel=Razdel::findOrFail($id);
        $razdel->delete();
         return redirect()->route('admin.adminpanel.razdel');
    }
    public function show($id){
        
        $razdel=Razdel::findOrFail($id);
        $quests=SQuestions::where('razdel_id',$id)->orderBy('is_open','desc')->get();
         return view('admin.razdel.show',compact('razdel','quests'));
    }
}