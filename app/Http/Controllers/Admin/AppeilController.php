<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppeilController extends Controller
{
    public function index ()
	{
		$appeils=Appeil::where('type',1)->get();
		return view('admin.appeil.index',compact("appeils"));
		
	}
	
	
	
	public chengeStatus($id)
	{
		$appeil=Appeil::orFindFail($id);
		$appeil->status=1;
		$appeil->save();
		return redirect()->route('admin.adminpanel.appeil');
	}
	public function show($id)
	{
		
		$appeil=Appeil::orFindFail($id);
		return view('admin.appeil.show',compact("appeil"));
	}
	
	
}
