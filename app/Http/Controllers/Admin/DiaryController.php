<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Diary;
use Auth;


use Illuminate\Http\Request;

class DiaryController extends Controller
{
      public function add(){
        return view('admin.diary.add');
    }
    public function store(Request $request){
        $news=new Diary();
        $news->user_id=Auth::user()->id;
        $news->name=$request->title;
        $news->text=$request->editor1;
        $news->save();
        
      return redirect()->route('admin.adminpanel.diary');
        
    }
    
    public function edit($id){
        
        $diary=Diary::findOrFail($id);
        return view ('admin.diary.edit',compact('diary'));
        
    }
    
    public function index(){
        //$tags=Tag:: orderBy('id','desc')->paginate(5);
        
        $diaries=Diary::orderBy('id','desc')->paginate(5);
      return view('admin.diary.index',compact('diaries'));
    }
    
    
    
    public function update(Request $request){
        $news=Diary::findOrFail($request->id);
        $news->name=$request->title;
          $news->text=$request->editor1;
        $news->save();
    
      return redirect()->route('admin.adminpanel.diary');
        
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
        
        $tag=News::findOrFail($id);
        $tag->delete();
         return redirect()->route('admin.adminpanel.news');
        
    }
    
}