<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CommentInter;
use Auth;


class CommentInterController extends Controller
{
    public function addcomment(Request $request){
        
       $coment=new CommentInter();
       if(!empty($request->comment_name)){
          $coment->name_author=$request->comment_name;
          $coment->isauth=0;
       }
       else{
            $coment->name_author=Auth::user()->name;
           $coment->user_id=Auth::user()->id;
            $coment->isauth=1;
       }
    
            $coment->text=$request->comment_content;
            $coment->interview_id=$request->inter_id;
            $coment->parent_id=$request->comment_id;
            $coment->save();
       return json_encode('good:yes');
       
           
    }
    
    
    
  /*  public function getComent(Request $request){
       
       
        $coments=CommentDele::where('dela_id',$request->delo_id)->where('parent_id',0)->get();
      
        $output = '';
        foreach($coments as $comment){
           
            $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">By <b>'.$comment->name_author.'</b> on <i>'.$this->showDate($comment->created_at->timestamp).'назад</i></div>
  <div class="panel-body">'.$comment->text.'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$comment->id.'">Reply</button></div>
 </div>
 ';
 $output .= $this->get_reply_comment( $comment->id);
        }
        
        return $output;
       
        
        
    }
    */
    
    
    public function getComent(Request $request){
       
       
        $coments=CommentInter::where('interview_id',$request->inter_id)->where('parent_id',0)->get();
        
       /* $coments = DB::table('comment_dele')
                ->whereColumn([
                    ['dela_id', '=',$request->delo_id ],
                    ['parent_id', '=', 0]
                ])->get();*/
        $output = '';
        foreach($coments as $comment){
           $img='';
           if($comment->user_id!=null){
			   if(isset($comment->user->person->avatar))
			   {
	               $img=$comment->user->person->avatar; 
			   }
			   else{
				   
				   $img='default.png';  
			   }
              
           }
           else{
               $img='noimg.png';
           }
            $output .= '
            <div class="odd-comment">';
			if($comment->user_id==null)
			{
				$output .= '
			
                    <div class="photo"><div class="ava" style="background-image: url(/storage/avatar/noimg.png )"></div></div>
                    <div class="adv-comment">
					<div class="profile-name">
                            <span class="guestCommenter">'.$comment->name_author.'</span>&nbsp;<sup style="color: #888;">гость</sup>&nbsp;                            
                            <span>'.$this->showDate($comment->created_at->timestamp).'</span>
                            
                        </div>';
			}
			else{
				$output .= '
			
                    <div class="photo"><div class="ava" style="background-image: url(/storage/avatar/'.$img.' )"></div></div>
                    <div class="adv-comment">
              <div class="profile-name">
                            <a target="_blank" href="/user/'.$comment->user_id.'">'.$comment->user->name.'</a>                            
                            <span>'.$this->showDate($comment->created_at->timestamp).'</span>
                              </div>';
				
			}
			$output .= '
                      <p>'.$comment->text.'</p>
                        <div class="callback clAnswer">
                            <button type="button" class="btn btn-default reply" id="'.$comment->id.'">Ответить</button>
                            <!-- <span>3 минуты  назад</span> -->
                        </div>
                    </div>
                </div>
            
 ';
 $output .= $this->get_reply_comment( $comment->id);
        }
        
        return $output;
       
        
        
    }
    
    
     function get_reply_comment( $parent_id = 0, $marginleft = 0){
        $output = '';
        if($parent_id==0 ){
           
        }
        else{
           
           $rep_comments=CommentInter::where('parent_id',$parent_id)->get();
          // dd($rep_comments);
           if(count($rep_comments)>0){
                $marginleft = $marginleft + 48;
                
                foreach($rep_comments  as $rp_com){
                     if($rp_com->user_id==null)
					{
						 $output .= '
                     <div class="even-comment">
                     <div class="photo"><div class="ava" style="background-image: url(/storage/avatar/noimg.png)"></div></div>
                    <div class="adv-comment">
                        <div class="profile-name">
                            <span class="guestCommenter">'.$rp_com->name_author.'</span>&nbsp;<sup style="color: #888;">гость</sup>&nbsp;                           
                            <span>'.$this->showDate($rp_com->created_at->timestamp).'</span>
                            
                        </div>';
					}
					else{
						$img=$rp_com->user->person->avatar;
						 $output .= '
						 
                     <div class="even-comment">
                     <div class="photo"><div class="ava" style="background-image: url(/storage/avatar/'.$img.')"></div></div>
                    <div class="adv-comment">
                        <div class="profile-name">
                            <a target="_blank" href="/user/'.$rp_com->user_id.'">'.$rp_com->name_author.'</a>                            
                            <span>'.$this->showDate($rp_com->created_at->timestamp).'</span>
                            
                        </div>';
					}
					
                    $output .= '
                        <p>'.$rp_com->text.'</p>
                        <div class="callback clAnswer">
                            <button class="btn_rep reply"   type="button"  id="'.$rp_com->id.'">Ответить</button>
                           
                        </div>
                    </div>
                </div>
   ';
   $output .= $this->get_reply_comment($rp_com->id, $marginleft);
                }
           }
            
        }
         return $output;
        
    }
    
    
    /*
    
    function get_reply_comment( $parent_id = 0, $marginleft = 0){
        $output = '';
        if($parent_id==0 ){
           
        }
        else{
           
           $rep_comments=CommentDele::where('parent_id',$parent_id)->get();
          // dd($rep_comments);
           if(count($rep_comments)>0){
                $marginleft = $marginleft + 48;
                
                foreach($rep_comments  as $rp_com){
                     $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading">By <b>'.$rp_com->name_author.'</b> on <i>'.$this->showDate($rp_com->created_at->timestamp).'назад</i></div>
    <div class="panel-body">'.$rp_com->text.'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$rp_com->id.'">Reply</button></div>
   </div>
   ';
   $output .= $this->get_reply_comment($rp_com->id, $marginleft);
                }
           }
            
        }
         return $output;
        
    }
    
    */
    
    function showDate( $date ) // $date --> время в формате Unix time
{
    $stf      = 0;
    $cur_time = time();
    $diff     = $cur_time - $date;
 
    $seconds = array( 'секунда', 'секунды', 'секунд' );
    $minutes = array( 'минута', 'минуты', 'минут' );
    $hours   = array( 'час', 'часа', 'часов' );
    $days    = array( 'день', 'дня', 'дней' );
    $weeks   = array( 'неделя', 'недели', 'недель' );
    $months  = array( 'месяц', 'месяца', 'месяцев' );
    $years   = array( 'год', 'года', 'лет' );
    $decades = array( 'десятилетие', 'десятилетия', 'десятилетий' );
 
    $phrase = array( $seconds, $minutes, $hours, $days, $weeks, $months, $years, $decades );
    $length = array( 1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600 );
 
    for ( $i = sizeof( $length ) - 1; ( $i >= 0 ) && ( ( $no = $diff / $length[ $i ] ) <= 1 ); $i -- ) {
        ;
    }
    if ( $i < 0 ) {
        $i = 0;
    }
    $_time = $cur_time - ( $diff % $length[ $i ] );
    $no    = floor( $no );
    $value = sprintf( "%d %s ", $no, $this->getPhrase( $no, $phrase[ $i ] ) );
 
    if ( ( $stf == 1 ) && ( $i >= 1 ) && ( ( $cur_time - $_time ) > 0 ) ) {
        $value .= time_ago( $_time );
    }
 
    return $value;
}
 
 
 public function getCount(Request $request){
     $coment=CommentInter::where('interview_id',$request->inter_id)->get();
     $count=count($coment);
     
     return  $count;
     
 }


function getPhrase( $number, $titles ) {
    $cases = array( 2, 0, 1, 1, 1, 2 );
 
    return $titles[ ( $number % 100 > 4 && $number % 100 < 20 ) ? 2 : $cases[ min( $number % 10, 5 ) ] ];
}

}