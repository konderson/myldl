<?php

namespace App\Http\Controllers;
use Menu as LavMenu;  
use App\Country;
use App\Help;
use App\Region;
use App\Service;
use App\Dela;
use App\User;
use App\SeoText;
use App\News;
use App\City;
use App\SQuestions;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMaail;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Frend;
use App\Person;
use Illuminate\Support\Facades\Hash;
use Validator;

class MainController extends Controller
{
    public $req='';
    public function index()
{
   // $arrMenu = \App\Menu::all();
    //$menu = $this->buildMenu($arrMenu);
  /*  $users_wont=DB::table('users')
        ->join('people', function ($join) {
            $join->on('users.id', '=', 'people.user_id')
                 ->where('people.help', '=', 'want');
        })->get();*/
	
       /*$users_wont = User::with('person')->whereHas('person', function ($query) {
   $query->where('help', 'want');
   
    return $query->take(10);
})->limit(10)->get();
*/

$users_wont=Person::where('help', 'want')->orderBy('id','desc')->limit(10)->get();


    
    $help_need=Help::where('type',1)->where('status',1)->orderBy('created_at','desc')->limit(7)->get();
    $help_wont=Help::where('type',2)->where('status',1)->orderBy('created_at','desc')->limit(6)->get();
    $help_search=Help::where('type',3)->where('status',1)->orderBy('created_at','desc')->limit(7)->get();
    $delas=Dela::where('status',1)->orderBy('created_at','desc')->limit(7)->get();
    $news=News::orderBy('flag','desc')->orderBy('created_at','desc')->limit(6)->get();
	
    
    $services=Service::orderBy('created_at','desc')->limit(5)->get();
   /* $users_need = User::with('person')->whereHas('person', function ($query) {
   $query->where('help', 'need');
})->limit(10)->get();
*/
$users_need=Person::where('help', 'need')->orderBy('id','desc')->limit(10)->get();
  /*$users= User::with('person')->whereHas('person', function ($query) {
   $query->orderBy('created_at','desc');
})->limit(10)->get();*/
 $users=Person::orderBy('id','desc')->limit(10)->get();

    
    $st=SeoText::where('url','home')->first();
    
    
   $quest=$this->getQuest();
   
    return view('welcome',compact('users_wont','users_need','users','help_need','help_wont','help_search','delas','services','news','st','quest'));
}


public function ajax_get_country(){
    $countries=Country::orderBy('priority','DESC')->orderBy('name', 'ASC')->get();

    foreach($countries as $country){
      echo '<option value="' . $country->id. '">' . $country->name . '</option>';  
    }
    
}


public function error(){
    
    return view ('error');
}
   
   
public function errorBlock(){
    
    return view ('error_block');
}


public function errorUBlock(){
    
    return view ('error_ublock');
}


public function errorDelete(){
    
    return view ('error_delete');
}
public function checkAuth(){
    $resolt='';
    if(Auth::check()){
        $resolt=1;
    }
    else{
        $resolt=0;
    }
    return $resolt;
}

 public function ajax_get_city($region_id = 0) {
        
            $cities=City::where('region_id',$region_id)->orderBy('name', 'ASC')->get();
            foreach($cities as $city){
            echo '<option value="' . $city->id . '">' . $city->name . '</option>';
               }
}


public function parseHref(Request $request){
    
    $str =$request->data;
$result = substr(strstr($str, '?'), 1, strlen($str));
echo  $result;
      }


            public function about()
			{
				return view('about');
			}
          

           public function getQuest(){
               
               $qusts=SQuestions::where('is_open',1)->where('end_date','>',date('Y-m-d'))->get();
               if(count($qusts)>0){
               $index=rand ( 0 , count($qusts)-1);
               $output='';
               if($index>=count($qusts)){$index-1;}//проверяем если индек болше количества в массиве 
                $output='
           
            <input type="hidden" name="section_site_id" value="0">
            <input type="hidden" name="section_site_url" value="home">
            <input type="hidden" name="quest_id" value="'.$qusts[$index]->id.'">
            <input type="hidden" name="type_choice" value="'.$qusts[$index]->tip_id.'">
            

                <div class="q_loader"></div>
                <p class="q_text pollhead">'.$qusts[$index]->text.'</p>';
               if($qusts[$index]->tip_id==1){
                 
                  for($i=1;$i<=10;$i++){
                      if($qusts[$index]->{'variaant'.$i}){
                          $output.=' <p>
						<input class="radio"  type="radio" name="q_answers[]" value="variant_'.$i.'" id="poll-1">
						<label for="poll-1">'.$qusts[$index]->{'variaant'.$i}.'</label>
					</p>';
					   $output.='<button id="pollsbt" type="submit">Голосовать
                    </button><br>
                
                <div class="poll-voted">
                                    </div>

                
        </form>';
                      }
                  }
                  
                   $output.='<button id="pollsbt" type="submit">Голосовать
                    </button><br>
                
                <div class="poll-voted">
                                    </div>

                
        </form>';
              
               }
               
                if($qusts[$index]->tip_id==2){
                     for($i=1;$i<=10;$i++){
                     if($qusts[$index]->{'variaant'.$i}){
                          $output.=' <p>
						<input class="radio"  type="checkbox" name="q_answers[]" value="variant_'.$i.'" id="poll-1">
						<label for="poll-1">'.$qusts[$index]->{'variaant'.$i}.'</label>
					</p>';
				
                      }
                    
                }
                
                	   $output.='<button id="pollsbt" type="submit">Голосовать
                    </button><br>
                
                <div class="poll-voted">
                                    </div>

                
        </form>';
                }
                
                if($qusts[$index]->tip_id==3){
                   $output.='
                    <li  style="text-decoration: none">
					<input  class="qa_button" type="submit" value="да"   id="but_yes">
					<input  class="qa_button" type="submit" value="нет">
					<input class="get_button_2" id="but_answer_var3" type="hidden"  id="but_not" name="q_answers[]" value="">
				</li>';
                
                } 
                return $output;
               }
               else{
                   
               }
               
              return null;
               
               
           }


  public function ajax_get_region($country_id = 0) {
        // 404-errors
        $regions =Region::where('country_id',$country_id)->get();
        foreach ($regions as $reg) {
            echo '<option value="' . $reg->id . '">' . $reg->name . '</option>';
        }
    }
    
    public function getUser(){
        $count=User::where('id','>',0)->count();
        $users=User::orderBy('id','desc')->paginate(20);
        return view('users.users',compact('users','count'));
    }
    public function filter(Request $request){
        
         $this->req=$request;
         if(!empty($request->serch_by_name)){
              $query=User::where('id','>',0);
             $query->where('name','like','%'.$request->serch_by_name.'%');
              $users=$query->orderBy('id','desc')->paginate(20);
              $count=count($users);
              return view('users.users',compact('users','count'));
             
             
             
         }
        /* $users= User::with('pepole')->whereHas('pepole', function ($query) {
  

          if(!empty($request->country_id)){
             $query->where('country',$request->country_id);
         }
         if(!empty($request->region_id)){
             $id=City::select('id')->where('region_id',$request->region_id)->get();
            
             $query->whereIn('city_id',$id);
         }
         if(!empty($request->city_id)){
            
             $query->where('city_id',$request->city_id);
         }
           })->get*/
          
           $users = User::with('person')->whereHas('person', function ($query) {
                
        if(!empty($this->req->country_id)){
            
             $query->where('country',$this->req->country_id);
         }
         if(!empty($this->req->region_id)){
             $id=City::select('id')->where('region_id',$this->req->region_id)->get();
            
             $query->whereIn('city_id',$id);
         }
         if(!empty($this->req->city_id)){
            
             $query->where('city_id',$this->req->city_id);
         }
         
})->get();

          $count=count($users);
          return view('users.search_users',compact('users','count'));
       
     }
     public function getOnline(){
         $users=User::where('id','>',0)->get();
         $count=0;
         foreach($users as $user){
             if($user->isOnline()){
                $count++;  
             }
             
         }
         
         return view('users.online',compact('users','count'));
     }
     
    public function getUserIndex($id)
    {
        
     $user=User::findOrFail($id);
     $delas=Dela::where('user_id',$id)->get();
     $services=Service::where('user_id',$id)->get();
     $helps=Help::where('user_id',$id)->get();
     $frends=Frend::where('user_id',$id)->get();
    
      return view('users.index',compact('helps','user','services','delas','frends'));   
    }
    
    /*
    *поиск по сайту по всем основным сущьностям
    */
    public function search(Request $request)
    {
        
        $output='';
        $count=1;
        $skey=$request->s;
        $deles=Dela::where('nazva','like','%'.$request->s.'%')->orWhere('opisanie','like','%'.$request->s.'%')->get();
    foreach($deles as $delo)
        {
            $output.=" 
             <span style='display: inline-block; margin-right: 5px'>$count</span>

                                            <a href='/delo/$delo->id/'
                           style='color:#5aaaa5;'>$delo->nazva....</a>
                    
                    <p style='margin: 4px 0 4px 18px'>Раздел: Дела</p>

                    <p style='margin: 4px 0 4px 18px;'>".substr($delo->opisanie, 0, 80)."...</p><br>";
                    $count++;
        }
        
        $helps=Help::where('title','like','%'.$request->s.'%')->orWhere('description','like','%'.$request->s.'%')->get();
        foreach($helps as $help)
        {
            $type="";
            if($help->type==1)$type="hochu_pom";
            if($help->type==2)$type="poiski";
            if($help->type==3)$type="naxodki";
            
            $output.=" 
             <span style='display: inline-block; margin-right: 5px'>$count</span>

                                            <a href='/searche/$help->id'
                           style='color:#5aaaa5;'>$help->title....</a>
                    
                    <p style='margin: 4px 0 4px 18px'>Раздел: Взаимопомощь</p>

                    <p style='margin: 4px 0 4px 18px;'>".substr($help->description, 0, 80)."...</p><br>";
                      $count++;
        }
        
        $sevices=Service::where('title','like','%'.$request->s.'%')->orWhere('description','like','%'.$request->s.'%')->get();
    foreach($sevices as $serv)
        {
            $output.=" 
             <span style='display: inline-block; margin-right: 5px'>$count</span>

                                            <a href='/usluga/$serv->id/'
                           style='color:#5aaaa5;'>$serv->title....</a>
                    
                    <p style='margin: 4px 0 4px 18px'>Раздел: Обьявления</p>

                    <p style='margin: 4px 0 4px 18px;'>".substr($serv->description, 0, 80)."...</p><br>";
                    $count++;
        }
        $newses=News::where('title','like','%'.$request->s.'%')->orWhere('description','like','%'.$request->s.'%')->get();
    foreach($newses as $news)
        {
            $output.=" 
             <span style='display: inline-block; margin-right: 5px'>$count</span>

                                            <a href='/news/item/$news->id/'
                           style='color:#5aaaa5;'>$news->title....</a>
                    
                    <p style='margin: 4px 0 4px 18px'>Раздел: Новости</p>

                    <p style='margin: 4px 0 4px 18px;'>".substr($news->description, 0, 80)."...</p><br>";
                    $count++;
        }
        
        return view ('/search',compact('output','skey'));
    }
	
	public function site_rules()
	{
		return view('site_rules');
	}
    public function checkEmail(Request $request)
	{
		$user_count=User::where('email',$request->email)->count();
		
		if($user_count>0)
		{
			echo 'bad';
		}
		else
		{
			echo 'ok';
		}
	}
	public function testSend()
	{
	$comment = 'Это сообщение отправлено из формы обратной связи';
    $toEmail = "konderson97@gmail.com";
	$comment="<a href='/coment'>Подтвердить</a>";
    Mail::to($toEmail)->send(new TestMaail($comment));
    //return 'Сообщение отправлено на адрес '. $toEmail;
	}
	
	public function notifyChengePass()
	{
		return view('notify_pass');
	}
	public function ChengePassForm($userId,$token)
	{
		$user = User::findOrFail($userId);
		if (md5($user->email) == $token) 
		{
		   return view('new_password',compact('user'));
		}
		else{
		         return view('error');
		    }

	}
	public function newPassword(Request $request)
	{
		
          $validator = Validator::make($request->all(), [
           
            'pass1'=>'required|min:8',
            
            
        ]);
		if ($validator->passes()) {
		$user=User::findOrFail($request->user_id);
		$user->password=Hash::make($request->pass1);
		$user->old_auth=0;
		$user->save();
		Auth::login($user);
		return redirect('/');
		}
	      else
			{
       return response()->json(['errors'=>$validator->errors()->all()]);
     }
		   	
		}
		
	
	public function chengeAvatar()
	{
		$users=User::all();
		foreach($users as $user)
		{
			$person=Person::where('user_id',$user->id)->first();
			if(isset($person)){
			if($person->avatar==null)
			{
				$person->avatar='default.png';
				$person->save();
			}	
			}
			
		}
		
	}
	
	
}