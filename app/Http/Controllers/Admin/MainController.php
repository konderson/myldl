<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Hash;
use App\Person;
use App\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    
    
    public function index(Request $request){
        //$email=$request->user['email'];
        
       
                    $users=User::orderBy('id','desc')->paginate(5);
        return view('admin.index',compact('users'));  
                 
              }
          
          public function filter(Request $request){
               $query=User::where('id','>',0);
        if(!empty($request->user['email'])){
           $query->where('email',$request->user['email']);
        
            }
            
            if(!empty($request->user['name'])){
           $query->where('name',$request->user['name']);
        
            }
            
            if(!empty($request->user['email'])){
           $query->where('email',$request->user['email']);
        
            }
            if(!empty($request->user['tel'])){
                $id=Person::select('user_id')->where('mob_tel',$request->user['tel'])->get();
           $query->whereIn('id',$id);
        
            }
            
            if(!empty($request->user['active'])){
                $id=Person::select('user_id')->where('active',$request->user['active'])->get();
           $query->whereIn('id',$id);
        
            }
            if(!empty($request->user['date_reg'])){
                $query->where('created_at',$request->user['date_reg']);
        
            }
             $users=$query->orderBy('id','desc')->paginate(3);
             
             
            
             return view('admin.user.search',compact('users'));
          }
       
       public function delete($id){
    
           $user=User::where('id',$id)->first();
           $user->delete();
           return redirect()->route('admin.adminpanel');
       }
       
       public function edit($id){
           $user=User::findOrFail($id);
           return view('admin.edit',compact('user'));
       }
    
    public function update(Request $request){
        
        $user=User::where('id',$request->id)->first();
        $user->email=$request->email;
        if($user->password===$request->pass){
           $user->password=Hash::make($request->pass);
        }
        $user->name=$request->name;
        $user->save();
        $person=Person::where('user_id',$user->id)->first();
             $person->name=$request->name;
             $person->birthday=$request->birthday;
              $person->city=$request->city;
             $person->about=$request->about;
             if(!empty($request->pol)){
                 $person->pol=$request->pol;  
             }
             $person->chel_org=$request->chel_org;
            $person->status_str=$request->status_str;
             $person->skype=$request->skype;
             $person->site=$request->site;
             $person->dolznost=$request->dolzhnost;
             $person->dohod=$request->dohod;
             $person->hobbi=$request->hobbi;
             $person->active=$request->active;
             $person->save();
             return redirect()->route('admin.adminpanel');
             
    }
    
    
}