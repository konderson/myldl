<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CommentNews;
use App\CommentProject;
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
}
