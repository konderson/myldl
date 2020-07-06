<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Appeal;

class AppeilController extends Controller
{
    public function getUserAppeil()
	{
		$appeails=Appeal::where('type',2)->get();
		return view('admin.appail.index_user',compact("appeails"));
		
	}
	
	
	public function getDeloAppeil()
	{
		$appeails=Appeal::where('type',1)->get();
		return view('admin.appail.index_delo',compact("appeails"));
		
	}
	
	public function chengeStatus(Request $request)
	{
		$appeil=Appeal::findOrFail($request->id);
		$appeil->status=$request->status;
		$appeil->save();
		if($appeil->type==1)
		{
			return redirect()->route('admin.adminpanel.appeil.delo');
		}
		else
		{
			return redirect()->route('admin.adminpanel.appeil.user');
		}
			
		
	}
	public function show($id)
	{
		
		$appeail=Appeal::findOrFail($id);
		return view('admin.appail.show',compact("appeail"));
	}
	
	
}
