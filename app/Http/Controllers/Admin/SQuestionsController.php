<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SQuestions;
use App\Answer;
use App\TypeQ;
class SQuestionsController extends Controller
{
    
    public function add($razdel){
        $types=TypeQ::all();
        return view('admin.socialquest.add',compact('types','razdel'));
    }
    
    
    public function store(Request $request){
       $quest=new SQuestions();
       
      
       $quest->tip_id=$request->questions_type;
       $quest->is_open=0;
       $quest->razdel_id=$request->razdel;
       $quest->text=$request->texts;
       $quest->end_date=$request->questions_dates;
       for($i=1;$i<11;$i++){
           if($request->has("variant_".$i)){
      //  echo ($request->{"variant_$i"});
            $quest->{"variaant$i"}=$request->{"variant_$i"};  
      
       }
       }
     
       $quest->save();
       
       return redirect()->route('admin.adminpanel.razdel.show',$request->razdel);
    }
    
    public function getResult($q_i){
     
    $answers=Answer::where('q_id',$q_i)->get();
    $str_rating='';
    $str_i='';
    $count=count($answers);
    
   
    $quest=SQuestions::findOrFail($q_i);

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
                     $str_i .= '<div class="qi_rating_shkala">
									<div class="qi_rating_left">' .$quest->{"variaant$j"}. '</div>
									<div class="qi_rating_right">
										<div class="qi_rating_line" r_percent="0"></div>
										<div class="qi_rating_count">0</div>
										<div class="qi_rating_percent">0%</div>
									</div>
								</div>';
                    }//en if count==null
                    else{
                        $percent=${"v$j"}*100/$count;
                        $str_i .= '<div class="qi_rating_shkala">
									<div class="qi_rating_left">' .$quest->{"variaant$j"}. '</div>
									<div class="qi_rating_right">
										<div class="qi_rating_line" r_percent="' .$percent. '"></div>
										<div class="qi_rating_count">' .$percent . '</div>
										<div class="qi_rating_percent">' .$percent. '%</div>
									</div>
								</div>';
                        
                        
                    
                    
                    }//end else if c0unt!null
                    
                }
                
                             
                      }   
                        // Преобразуем рейтинговую информацию в Base64
                if ($str_i != '')
                    $str_rating = base64_encode($str_i);
				// $str_rating =$str_i;
            
                       exit(json_encode(array(
            'run_get' => 'yes', // статус информации
            'q_id' => $q_i, // ID опроса
            'q_status' =>$quest->is_open , // Статус опроса
            'count_v' => $count, // Кол. просмотров
            'count_q' => $count, // Кол. ответов
            'block_rating' => $str_rating, // блок с рейтингом
          
        )));
               return   $output;                
    }//end function
    
    public function getArhive()
    {
          $quests=SQuestions::where('is_open','!=',1)->where('end_date','<',date('Y-m-d'))->get();
           return view('admin.socialquest.archive',compact('quests'));
    }
    public function setings(Request $request){
        $quests=SQuestions::findOrFail( $request->sq_id);
        $quests->end_date=$request->date_end;
        $quests->is_open=$request->is_open;
        $quests->save();
        return redirect()->back();
    }
}