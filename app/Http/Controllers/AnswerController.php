<?php

namespace App\Http\Controllers;
use App\Answer;
use App\SQuestions;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function add(Request $request){
        $type=$request->type_choice;
        $q_i=$request->quest_id;
        $output='';
         $error=0;
           if(Auth::check()){
               $error=Answer::where('q_id',$q_i)->where('ip',$_SERVER['REMOTE_ADDR'])->count(); 
               
           if($error>0){
                $error=Answer::where('q_id',$q_i)->where('user_id',Auth::user()->id)->count();
           }
           }
           else{
                $error=Answer::where('q_id',$q_i)->where('ip',$_SERVER['REMOTE_ADDR'])->count();  
           }
        
           if($error>0){
            $output='</div>
                                <p>Вы уже проголосовали ранее.</p>
                                <p><a href="/poll">Все опросы</a></p>
            </div>
                  ';
                }
                else{
                    
                    
                       $output='</div>
                                <p><a href="/poll">Все опросы</a></p>
            </div>
                  ';
                    

                    foreach($request->q_answers  as $ans){
              
                    if($ans==='variant_1'||$ans==='variant_2'||$ans==='variant_3'||$ans==='variant_4'||$ans==='variant_5'||$ans==='variant_6'||$ans==='variant_7'||$ans==='variant_8'||$ans==='variant_9'||$ans==='variant_10'){
                         $answer=new Answer();
                        
                    $answer-> section_id=1;
                    $answer->q_id=$q_i;
                    $answer->{"$ans"}=1;
                    $answer->type_q=$type;
                    $answer->ip=$_SERVER['REMOTE_ADDR'];
                    if(Auth::check()){
                     $answer->user_id=Auth::user()->id; 
                     }
                     $answer->save();
                    }
                    }
                    
                }
                
                
                $resultr=$this->getResult($q_i).$output;
                //return $resultr;
                return redirect()->route('poll.show',$q_i)->with( ['data' =>$resultr ] );
                 }
    
    
    
    public function getResult($q_i){
     
    $answers=Answer::where('q_id',$q_i)->get();

    $count=count($answers);
    
    $output="";
    $quest=SQuestions::findOrFail($q_i);
   $output.='<div class="left">
                <h1>Опрос : "jjjbjbjbj"</h1>
                <div class="psli-list">
                    <ul>
                        <li><span>Всего проголосовало: </span>'.$count.'</li>
                        <li><span>Опрос начат: </span>'.Carbon::parse($quest->created_at)->format("d.m.y").'</li>
                        <li><span>Опрос закончен: '.Carbon::parse($quest->end_date)->format("d.m.y").'</span></li>
                    </ul>
                </div>
                <div class="progress-bar-container">';
                $v1=0;
                $v2=0;
                $v3=0;
                $v4=0;
                $v5=0;
                $v6=0;
                $v7=0;
                $v8=0;
                $v9=0;
                $v10=0;
                foreach($answers as $ans )
                {
                    
                    
                    if($ans->variant_1!=null){$v1++; }
                    if($ans->variant_2!=null)$v2++;
                    if($ans->variant_3!=null)$v3++;
                    if($ans->variant_4!=null)$v4++;
                    if($ans->variant_5!=null)$v5++;
                    if($ans->variant_6!=null)$v6++;
                    if($ans->variant_7!=null)$v7++;
                    if($ans->variant_8!=null)$v8++;
                    if($ans->variant_9!=null)$v9++;
                    if($ans->variant_10!=null)$v10++;
                    
                }
                
                for($j=1;$j<11;$j++){
                    
                    if($quest->{"variaant$j"}){
                    if(${"v$j"}==null)${"v$j"}=0;
                    if($count==null){
                        $output.='<div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:'.$percent.'%">
                                </div>
                                <span>'.$quest->{"variaant$j"}.'  - 0 %</span>
                            </div>';
                    }//en if count==null
                    else{
                        
                    $percent=${"v$j"}*100/$count;
                    $output.='<div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:'.$percent.'%">
                                </div>
                                <span>'.$percent.'  </br> '.$quest->{"variaant$j"}.'%</span>
                            </div>';
                    }//end else if c0unt!null
                    
                }
                
                             
                      }     
                      
               return   $output;                
    }//end function
    
    
    
    public function show($q_i){
		
		
        
                $output='';
         $error=0;
           if(Auth::check()){
               $error=Answer::where('q_id',$q_i)->where('ip',$_SERVER['REMOTE_ADDR'])->count(); 
               
           if($error>0){
                $error=Answer::where('q_id',$q_i)->where('user_id',Auth::user()->id)->count();
           }
           }
           else{
                $error=Answer::where('q_id',$q_i)->where('ip',$_SERVER['REMOTE_ADDR'])->count();  
           }
        
           if($error>0){
            $output='</div>
                                <p>Вы уже проголосовали ранее.</p>
                                <p><a href="/poll">Все опросы</a></p>
            </div>
                  ';
                }
                else{
                    
                    
                       $output='</div>
                                <p><a href="/poll">Все опросы</a></p>
            </div>
                  ';
                }
                  $quest=SQuestions::findOrFail($q_i);
        $result=$this->getResult($q_i).$output;
                return view('poll.index',compact('result','quest'));
    }
    
    public function all(){
        $quests=SQuestions::where('is_open',1)->get();
        
          return view('poll.all',compact('quests'));
        
    }
    
}