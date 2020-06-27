<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
class ProjectController extends Controller
{
     public function index(){
        //$tags=Tag:: orderBy('id','desc')->paginate(5);
        $projects=Project::orderBy('id','desc')->paginate(5);
        $lprojects=Project::orderBy('view','desc')->orderBy('created_at','desc')->limit(5)->get();
       
      return view('project.all',compact('projects','lprojects'));
    }
       public function item($id){
        
        $project=Project::findOrFail($id);
         $lprojects=Project::orderBy('view','desc')->orderBy('created_at','desc')->limit(5)->get();
          return view ('project.item',compact('lprojects','project'));
        
    }
}