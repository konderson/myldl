<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CommentNews;
use App\CommentProject;
use App\CommentDiary;
use App\CommentPoll;
use App\CommentFuture;
use App\CommentDele;
use App\ComentService;
use App\CommentHelp;
use App\CommentInter;

class CommentController extends Controller
{
    public function getNewsComment()
	{
		$comments=CommentNews::paginate(10);
	 return view('admin.comment.index',compact("comments"));
	}
	
	public function getProjectComment()
	{
		$comments=CommentProject::paginate(10);
	 return view('admin.comment.index',compact("comments"));
	}
	
	
	public function getDiaryComment()
	{
		$comments=CommentDiary::paginate(10);
	 return view('admin.comment.index',compact("comments"));
	}
	
	
	public function getPollComment()
	{
		$comments=CommentPoll::paginate(10);
	 return view('admin.comment.index',compact("comments"));
	}
	public function getFutureComment()
	{
		$comments=CommentFuture::paginate(10);
	 return view('admin.comment.index',compact("comments"));
	}
	
	public function getDeleComment()
	{
		$comments=CommentDele::paginate(10);;
	 return view('admin.comment.index',compact("comments"));
	}
	public function getHelpComment()
	{
		$comments=CommentHelp::paginate(10);
	 return view('admin.comment.index',compact("comments"));
	}
	public function getServiceComment()
	{
		$comments=ComentService::paginate(10);
	 return view('admin.comment.index',compact("comments"));
	}
	public function getInterComment()
	{
		$comments=CommentInter::paginate(10);
	 return view('admin.comment.index',compact("comments"));
	}
	
	public function delete(Request $request)
	{
		if($request->type==='App\CommentDele')
		{
			$com_dele=CommentDele::findOrFail($request->id);
			$com_dele->delete();
			return redirect()->back();
	    }
		
		if($request->type==='App\CommentNews')
		{
			$com_news=CommentNews::findOrFail($request->id);
			$com_news->delete();
			return redirect()->back();
	    }
		if($request->type==='App\CommentProject')
		{
			$com_proj=CommentProject::findOrFail($request->id);
			$com_proj->delete();
			return redirect()->back();
	    }
		if($request->type==='App\CommentDiary')
		{
			$com_diary=CommentDiary::findOrFail($request->id);
			$com_diary->delete();
			return redirect()->back();
	    }
		if($request->type==='App\CommentPoll')
		{
			$com_poll=CommentPoll::findOrFail($request->id);
			$com_poll->delete();
			return redirect()->back();
	    }
		if($request->type==='App\CommentFuture')
		{
			$com_future=CommentFuture::findOrFail($request->id);
			$com_future->delete();
			return redirect()->back();
	    }
		if($request->type==='App\CommentHelp')
		{
			$com_help=CommentHelp::findOrFail($request->id);
			$com_help->delete();
			return redirect()->back();
	    }
		if($request->type==='App\ComentService')
		{
			$com_serv=ComentService::findOrFail($request->id);
			$com_serv->delete();
			return redirect()->back();
	    }
		if($request->type==='App\CommentInter')
		{
			$com_inter=CommentInter::findOrFail($request->id);
			$com_inter->delete();
			return redirect()->back();
	    }
	}
	
	public function filter(Request $request)
	{
		
		if($request->type_com==="" ||$request->type_com==="none"){
		return redirect()->url('/admin/index');
		}
		
		if($request->type_com=="App\CommentDele")
		{
			if(isset($request->filter_search))
			{
				$comments=CommentDele::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->where('text','like','%'.$request->filter_search.'%')->paginate(50);
	     return view('admin.comment.index',compact("comments"));
			}
			else{
			$comments=CommentDele::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->paginate(50);
	 return view('admin.comment.index',compact("comments"));
			}
			
	
		}//if type
	
	
	if($request->type_com=="App\CommentNews")
		{
			if(isset($request->filter_search))
			{
				$comments=CommentCommentNews::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->where('text','like','%'.$request->filter_search.'%')->paginate(50);
	     return view('admin.comment.index',compact("comments"));
			}
			else{
			$comments=CommentCommentNews::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->paginate(50);
	 return view('admin.comment.index',compact("comments"));
			}
			
	
		}//if type
		
		if($request->type_com=="App\CommentNews")
		{
			if(isset($request->filter_search))
			{
				$comments=CommentNews::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->where('text','like','%'.$request->filter_search.'%')->paginate(50);
	     return view('admin.comment.index',compact("comments"));
			}
			else{
			$comments=CommentNews::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->paginate(50);
	 return view('admin.comment.index',compact("comments"));
			}
			
	
		}//if type
		
		if($request->type_com=="App\CommentProject")
		{
			if(isset($request->filter_search))
			{
				$comments=CommentProject::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->where('text','like','%'.$request->filter_search.'%')->paginate(50);
	     return view('admin.comment.index',compact("comments"));
			}
			else{
			$comments=CommentProject::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->paginate(50);
	 return view('admin.comment.index',compact("comments"));
			}
			
	
		}//if type
		
		if($request->type_com=="App\CommentDiary")
		{
			if(isset($request->filter_search))
			{
				$comments=CommentDiary::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->where('text','like','%'.$request->filter_search.'%')->paginate(50);
	     return view('admin.comment.index',compact("comments"));
			}
			else{
			$comments=CommentDiary::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->paginate(50);
	 return view('admin.comment.index',compact("comments"));
			}
			
	
		}//if type
		
		if($request->type_com=="App\CommentPoll")
		{
			if(isset($request->filter_search))
			{
				$comments=CommentPoll::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->where('text','like','%'.$request->filter_search.'%')->paginate(50);
	     return view('admin.comment.index',compact("comments"));
			}
			else{
			$comments=CommentPoll::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->paginate(50);
	 return view('admin.comment.index',compact("comments"));
			}
			
	
		}//if type
		if($request->type_com=="App\Future")
		{
			if(isset($request->filter_search))
			{
				$comments=CommentFuture::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->where('text','like','%'.$request->filter_search.'%')->paginate(50);
	     return view('admin.comment.index',compact("comments"));
			}
			else{
			$comments=CommentFuture::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->paginate(50);
	 return view('admin.comment.index',compact("comments"));
			}
			
	
		}//if type
		
		if($request->type_com=="App\CommentHelp")
		{
			if(isset($request->filter_search))
			{
				$comments=CommentHelp::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->where('text','like','%'.$request->filter_search.'%')->paginate(50);
	     return view('admin.comment.index',compact("comments"));
			}
			else{
			$comments=CommentHelp::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->paginate(50);
	 return view('admin.comment.index',compact("comments"));
			}
			
	
		}//if type
		
		if($request->type_com=="App\ComentService")
		{
			if(isset($request->filter_search))
			{
				$comments=ComentService::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->where('text','like','%'.$request->filter_search.'%')->paginate(50);
	     return view('admin.comment.index',compact("comments"));
			}
			else{
			$comments=ComentService::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->paginate(50);
	 return view('admin.comment.index',compact("comments"));
			}
			
	
		}//if type
		
		if($request->type_com=="App\CommentInter")
		{
			
			if(isset($request->filter_search))
			{
				$comments=CommentInter::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->where('text','like','%'.$request->filter_search.'%')->paginate(50);
	     return view('admin.comment.index',compact("comments"));
			}
			else{
			$comments=CommentInter::where('created_at','>=',$request->filter_date_form)->where('created_at','<',$request->filter_date_before)->paginate(50);
	 return view('admin.comment.index',compact("comments"));
			}
			
	
		}//if type
}
}