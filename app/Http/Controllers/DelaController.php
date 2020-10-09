<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Dela;
use App\City;
use Auth;
use App\User;
use App\Event;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\DeloFeatured;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DelaController extends Controller
{
    

    
    public function all(){
         $lastdelas=Dela::orderBy('id', 'desc')->limit(5)->get();
		 $count_dela=Dela::count();
      $delas=Dela::orderBy('id', 'desc')->paginate(5);  
        return view('myprofile.delas',compact('delas','lastdelas','count_dela'));
    }
    
    
    
    
    public function addDelo(){
        //$user=User::findOrFail(244);
        //dd($user->delo[0]->nazva);
       //$delo=Dela::findOrFail(111);
//dd($delo->user->count());

        return view('myprofile.adddelo');
    }
    
   public function  ajax_upload_avatar(Request $request){
       
        if (isset($request->userfile)) {
          $image=$request->userfile;
              $currentData = Carbon::now()->toDateString();
            $imagename =$currentData . '-' . uniqid() . '-' . $image->getClientOriginalName(); 
            
            $img = Image::make($image->getRealPath());
            $img->resize(360, 320, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            Storage::disk('public')->put('upload/uploads/' . $imagename, $img);
            //Storage::disk('local')->put('images/1/smalls'.'/'.$fileName, $img, 'public');
        
            
                echo $imagename;
      }
   }
    
    
    
    
    public function mydelo(){
        $mydelas=Dela::where('user_id',Auth::user()->id)->get();
        
        
        return view('myprofile.mydelo',compact('mydelas'));
    }
    
    
        public function ajaxDela(Request $request) {
        // 404-errors
      

   
$results=$this->ajaxFilter($request);



       foreach ($results as $row) {
            echo '
		<tr>
			<td>' . date('d.m.Y', strtotime($row->dates)) . '</td>
			<td><a href="/delo/'.$row->id.'"  " title="' . ($row->status == 1 ? 'Открыто' : 'Закрыто') . '" >' . ((mb_strlen($row->nazva) > 20) ? mb_substr($row-nazva, 0, 20) : $row->nazva) . '</a></td>
			<td>' . $row->city . '</td>
			<td>' . $row->getCountUser($row->id) . '</td>';
            if ($row->status == 0) {
                echo '
			<td>
			   Закрыт
			</td>';
            } else {
                echo '
			<td>
			    Открыт
			</td>';
            }
			echo '<td> 
            <a href="edit/delo/'.$row->id.'" ><img src="'.asset('asset/front/images/edit.png').'"><a></td>
             <td> <a class="del del_delo" href="/delo/'.$row->id.'" onclick="return confirm(\'Удалить дело «'. $row->nazva. '»?\')" title="Удалить"><img src="'.asset('asset/front/images/close.png').'"></i></a>';
            echo '
            <td>
            <a class="del del_delo" href="' ."/delo/" . $row->id. '" onclick="return confirm(\'Удалить дело «'. $row->nazva. '»?\')" title="Удалить"> <i class="remove"></i></a>
            </td>
		</tr>';
        }
    }

    
    public function ajaxFilter($request)
    {
	 //$results = DB::select("select * from dela where id =".Auth::user()->id."");
	
		
        $results=Dela::where('user_id',Auth::user()->id);
        
        if( $request->has( 'choice_2' ) && !$request->has('choice_3')){
            $results->where( 'status' ,'=', 1);
            //array_push($array,['status','=',1]);
        }
        if( $request->has( 'choice_3' ) && !$request->has('choice_2')){
            $results->where('status' ,'=', 0);
            //array_push($array,['status','=',0]);
        }
        if( $request->has( 'choice_4' ) && !$request->has('choice_5')){
            $results->where( 'tip' ,'=', 1);
            //array_push($array,['status','=',1]);
        }
        if( $request->has( 'choice_5' ) && !$request->has('choice_4')){
            $results->where('tip' ,'=', 2);
            //array_push($array,['status','=',0]);
        }
         // $array[]=[$array];
        return $results->get();
		//return $results;
    }
    
    public function addStore(Request $request)
    {
       
     $dela=new Dela();
     $dela->user_id=Auth::user()->id;
     $dela->nazva=$request->nazva;
     $dela->tip=$request->tip;
     $dela->vhod_v_delo=$request->vhod_v_delo;
     $dela->comment_k_delu=$request->comment_k_delu;
     $dela->status=$request->status;
     $dela->opisanie=$request->opisanie;
     $dela->country_id=$request->country;
	 $city=City::findOrFail($request->city);
     $dela->tekuschiy_status=$request->tekuschiy_status;
     $dela->city_id =$request->city;
     $dela->city=$city->name;
     if(!empty($request->str_images)){
         $dela->images=$request->str_images;
     }
     $dela->bydzet=$request->bydzet;
     $dela->vremya=$request->vremya;
     $dela->effekt=$request->effekt;
     $dela->dlya_chego=$request->dlya_chego;
     $dela->blagodarnost=$request->blagodarnost;
     $dela->vhod_v_delo=$request->vhod_v_delo;
     $dela->save();
     $event=new Event();//add event data
     $event->type_id=1;//id delo_type
     $event->title=Auth::user()->name.' добавил новое дело - '.$dela->nazva;
     $event->user_id=Auth::user()->id;
     $event->save();
      return redirect()->route('profile.mydelo');
    // dd ($request);
        
    }
    
    public function deleteFeatured($id){
        
        $delo=DeloFeatured::findOrFail($id);
        if($delo->user_id==Auth::user()->id)
        {
              $delo->delete();
        }
        
        return redirect()->route('delo.featureds');
    }
    public function delete($id){
		$delo=Dela::findOrFail($id);
        if($delo->user_id==Auth::user()->id)
        {
        $delo->delete();
        }    
       return redirect()->route('profile.mydelo');
    }
    
    public function update(Request $request){
        $dela=Dela::findOrFail($request->id);
        $dela->nazva=$request->nazva;
     $dela->tip=$request->tip;
     $dela->vhod_v_delo=$request->vhod_v_delo;
     $dela->comment_k_delu=$request->comment_k_delu;
     $dela->status=$request->status;
     $dela->opisanie=$request->opisanie;
     $dela->country_id=$request->country;
     $city=City::findOrFail($request->city);
     $dela->tekuschiy_status=$request->tekuschiy_status;
     $dela->city_id =$request->city;
     $dela->city=$city->name;
     if(!empty($request->str_images)){
         $dela->images=$request->str_images;
     }
     $dela->bydzet=$request->bydzet;
     $dela->vremya=$request->vremya;
     $dela->effekt=$request->effekt;
     $dela->dlya_chego=$request->dlya_chego;
     $dela->blagodarnost=$request->blagodarnost;
     $dela->vhod_v_delo=$request->vhod_v_delo;
     $dela->save();
        return redirect()->route('profile.mydelo');
    }
    //сисок избраных дел
    public function featureds(){
        $features=DeloFeatured::where('user_id',Auth::user()->id)->get();
        
        return view('myprofile.izbranniye',compact('features'));
    }
    
    public function addFeatureds(Request $request){
        if(!Auth::check()){
            echo 'auth';
        }
        else{
        $feature=DeloFeatured::where('user_id',Auth::user()->id)->where('delo_id',$request->delo_id)->count();
        if($feature>0){
            echo('error');
        }
        else{
        $featureds=new DeloFeatured();
        $featureds->user_id=Auth::user()->id;
         $featureds->delo_id=$request->delo_id;
         $featureds->save();
            $event=new Event();//add event data
            $event->type_id=7;//id delo_type
            $event->title=Auth::user()->name.' добавил в избаное дело - <a href="/delo/'
                .$request->delo_id.'">'.$featureds->delo->nazva.'</a>';
            $event->user_id=Auth::user()->id;
            $event->save();
          echo 'ok';
        }
        }
    }
  public function  getDelo($id){
      $delo=Dela::findOrFail($id);
       // $delo->user[0]->person;
        //dd($delo->user[0]->person->id);
        $delas=Dela::orderBy('id', 'desc')->limit(5)->get();

      return view('myprofile.delo',compact('delo','delas'));
      
  }
    
	
	public function edit($id)
	{
		$delo=Dela::findOrFail($id);
	    return view('myprofile.delo.edit',compact('delo'));
    }
	
}