<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ReadCheck;
use App\User;
use App\Message;
use Auth;
use Carbon\Carbon;
use App\Events\NewMessage;
use App\Events\DeleteMessage;

class MessageController extends Controller
{
    
    public function index()
    {
        return view('myprofile.chat.index');
    }
    public function get(){
        
        $aray=[];
        $ms=Message::where('to',Auth::user()->id)->orWhere('from',Auth::user()->id)->get();
        foreach($ms as $m)
        {
            if($m->to==Auth::user()->id){
              $aray[]=$m->from ;
              
            }
            if($m->from==Auth::user()->id){
              $aray[]=$m->to ;
              
            }
        }
        $contacts=User::where('id','!=',Auth::user()->id)->whereIn('id',$aray)->with('person')->get();
        foreach($contacts as $contact)
        {
            if($contact->isOnline())
            {
             $contact['is_onl']=1;   
            }
            else{
                 $contact['is_onl']=0;
            }
            
          
        }

        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
      $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', 0)
            ->groupBy('from')
            ->get();

        // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });
        

        return response()->json($contacts);
    }

            public   function  read(Request $request){

                broadcast(new ReadCheck($request->ms_id,$request->from));
            }

    public  function getMessagesFor($id){
        //$messages=Message::where('from',$id)->orWhere('to',$id)->get();
       Message::where('from',$id)->where('to',auth()->id())->update(['read'=>true]);

        $messages=Message::where(function ($q)use ($id){
            $q->where('from',auth()->id());
            $q->where('to',$id);
        })->orWhere(function ($q) use ($id){
            $q->where('to',auth()->id());
            $q->where('from',$id);
        })
            ->get();
            $count=0;
            $today_count=0;
            $created=new Carbon();
            foreach($messages as $message){
            $message['time']=Carbon::parse($message->created_at)->format('H:i');
           
            if($count==0)
            {
                
                $message['date']=Carbon::parse($message->created_at)->format('d.m.Y');  
                $created = new Carbon($message->created_at);
                if($message->created_at->diff(Carbon::now())->days==0 && $today_count==0){
                    $message['date']="today";
                    $today_count=1;
                }
                
                
            }
            else{
                
               // $message['date'] = ($created->diff($message->created_at)->days >0)?Carbon::parse($message->created_at)->format('d.m.Y')
               // : 0;  
               
                $message['date'] =($created->diffInDays($message->created_at)>0)?Carbon::parse($message->created_at)->format('d.m.Y')
                : 0;
                
                if($message->created_at->diff(Carbon::now())->days==0 && $today_count==0){
                    $message['date']="today";
                    $today_count=1;
                }
                
                
                $created = Carbon::parse($message->created_at);
            }
            $count=1;
            }

        return response()->json($messages);
    }

      public  function save(Request $request){

        $message=new Message();

        $message->to=$request->contact_id;
        $message->from=Auth::user()->id;
        $message->text=$request->text;
        $message->read=0;
        $message->save();

       //Test::dispatch("new Test");
      broadcast(new NewMessage($message));

        return response()->json($message);
      }
      public function deleteContact(Request $request)
      {
          $id=$request->contact_id;
       $messages=Message::where(function ($q)use ($id){
            $q->where('from',auth()->id());
            $q->where('to',$id);
        })->orWhere(function ($q) use ($id){
            $q->where('to',auth()->id());
            $q->where('from',$id);
        })
            ->delete();
            
      }
      public function deleteMessage(Request $request)
      {
           $message=Message::where('id',$request->message['id'])->first();
           $message->flag=1;
           $message->save();
           
           broadcast(new DeleteMessage($message));
           
      }
}