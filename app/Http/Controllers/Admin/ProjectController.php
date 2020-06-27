<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Project;
use Illuminate\Http\Request;
use Auth;
class ProjectController extends Controller
{
     public function add(){
        return view('admin.project.add');
    }
    public function store(Request $request){
        $project=new Project();
        $project->user_id=Auth::user()->id;
        $project->name=$request->title;
        $project->image=$request->images;
        $project->text=$request->editor1;
        $project->save();
        
      return redirect()->route('admin.adminpanel.project');
        
    }
    
    public function edit($id){
        
        $project=Project::findOrFail($id);
        return view ('admin.project.edit',compact('project'));
        
    }
    
    public function index(){
        //$tags=Tag:: orderBy('id','desc')->paginate(5);
        
        $projects=Project::orderBy('id','desc')->paginate(5);
      return view('admin.project.index',compact('projects'));
    }
    
    
    
    public function update(Request $request){
        $project=Project::findOrFail($request->id);
        $project->name=$request->title;
        $project->image=$request->images;
        $project->text=$request->editor1;
        $project->save();
    
      return redirect()->route('admin.adminpanel.project');
        
    }
    
    public function  upload(Request $request){
        
  
        if (isset($request->file)) {
          $image=$request->file;
              $currentData = Carbon::now()->toDateString();
            $imagename =$currentData . '-' . uniqid() . '-' . $image->getClientOriginalName(); 
            
            $img = Image::make($image->getRealPath());
            $img->resize(360, 320, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            Storage::disk('public')->put('news/' . $imagename, $img);
            //Storage::disk('local')->put('images/1/smalls'.'/'.$fileName, $img, 'public');
        
            
              
        echo json_encode(array('location' => 'http://myldl1.xn--d1amkaejqfkvr9a.xn--p1ai/storage/news/'.$imagename));
        }
        else {
    // Notify editor that the upload failed
    header("HTTP/1.1 500 Server Error");
}
    }
    
     public function delete ($id){
        
        $project=Project::findOrFail($id);
        $project->delete();
         return redirect()->route('admin.adminpanel.project');
        
    }
}