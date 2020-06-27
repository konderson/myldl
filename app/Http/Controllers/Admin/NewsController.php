<?php

namespace App\Http\Controllers\Admin;
use App\News;
use Auth;
use App\Tag;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\DeloFeatured;
use Storage;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function add(){
        return view('admin.news.add');
    }
    public function store(Request $request){
        $news=new News();
        $news->user_id=Auth::user()->id;
        $news->name=$request->title;
        $news->flag=$request->flag;
        $news->title=$request->mtitle;
        $news->description=$request->description;
        $news->keyw=$request->keywords;
        $news->text=$request->editor1;
        $news->save();
        
      return redirect()->route('admin.adminpanel.news');
        
    }
    
    public function edit($id){
        $count= $news=News::where('flag','>',0)->count();
        $news=News::findOrFail($id);
        $nedit=News::findOrFail($id);
        $tags=Tag::all();
        return view ('admin.news.edit',compact('tags','news','count','nedit'));
        
    }
    
    public function index(){
        //$tags=Tag:: orderBy('id','desc')->paginate(5);
        $news=News::where('flag',0)->orderBy('id','desc')->paginate(5);
        $fnews=News::where('flag','>',0)->orderBy('flag','asc')->orderBy('updated_at','desc')->get();
      return view('admin.news.index',compact('fnews','news'));
    }
    
    public function change_flag(Request $request){
          $ns=News::findOrFail($request->newsID);
          $ns->flag=$request->flag;
          $ns->save();
           $news=News::where('flag',0)->orderBy('id','desc')->paginate(5);
        $fnews=News::where('flag','>',0)->orderBy('flag','asc')->orderBy('updated_at','desc')->get();
      return view('admin.news.index',compact('fnews','news'));
           return view('admin.news.index',compact('fnews','news'));
    }
    
    public function update(Request $request){
        $news=News::findOrFail($request->id);
        $news->name=$request->title;
        $news->flag=$request->flag;
        $news->title=$request->mtitle;
        $news->description=$request->description;
        $news->keyw=$request->keywords;
        $news->text=$request->editor1;
        $news->save();
        
        if(!empty($request->tags)){
        foreach($request->tags as $tag){
            
            $tg=Tag::findOrFail($tag);
         $tg->news()->attach($news->id);
        }
        }
      return redirect()->route('admin.adminpanel.news');
        
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