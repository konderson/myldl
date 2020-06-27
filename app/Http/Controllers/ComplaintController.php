<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;
class ComplaintController extends Controller
{
    public function addComplaint(Request $request){
        $complaint= new Complaint();
        $complaint->type=$request->type;
        $complaint->text=$request->type;
        if(!empty($request->user_id))
        {
             $complaint->user_id=$request->user_id;
             
        }
        $complaint->save();
        return('ok');
    }
}