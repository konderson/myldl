<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appeal;
use Auth;

      class AppealController extends Controller
      { 
          
         public function store(Request $request)
		 {
			 $appeal=new Appeal();
			 $appeal->text=$request->text;
			 $appeal->from_user=Auth::user()->id;
			 if(isset($request->delo_id))
			 {
				$appeal->delo_id=$request->delo_id; 
			 }
			 if(isset($request->user_id))
			 {
			 $appeal->user_id=$request->user_id;
			 }
			 $appeal->type=$request->type;
			 $appeal->status=0;
			 $appeal->save();
			  echo "ok";
			 
		 }
		  
      }
