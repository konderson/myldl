<?php

namespace App\Http\Controllers;
use App\News;
use Auth;
use App\Tag;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        //$tags=Tag:: orderBy('id','desc')->paginate(5);
        $news=News::where('flag',0)->orderBy('id','desc')->paginate(5);
        $fnews=News::where('flag','>',0)->orderBy('flag','asc')->orderBy('updated_at','desc')->get();
        $nv=News::orderBy('view','desc')->orderBy('updated_at','desc')->limit(5)->get();
       
      return view('news.all',compact('fnews','news','nv'));
    }
       public function item($id){
        
        $news=News::findOrFail($id);
         $nv=News::orderBy('view','desc')->orderBy('updated_at','desc')->limit(5)->get();
         $tags=$news->tags()->distinct()->get();
         $liketag=array();
         foreach($tags as $tag){
             $pnews=$tag->news()->where('news_id','!=',$news->id)->get();
             foreach($pnews as $nvl){
                $liketag[]=$nvl;
             }
            
         }
          return view ('news.item',compact('news','nv','tags','liketag'));
        
    }
}