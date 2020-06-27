<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Dela;
use App\City;
use Auth;
use App\User;
use App\Event;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\DeloFeatured;
use Storage;
use Illuminate\Http\Request;

class DelaController extends Controller
{
    

    
    public function all(){
         $lastdelas=Dela::orderBy('id', 'desc')->limit(5)->get();
      $delas=Dela::orderBy('id', 'desc')->paginate(5);  
        return view('myprofile.delas',compact('delas','lastdelas'));
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

            Storage::disk('public')->put('delo/' . $imagename, $img);
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
        

        
        $query =Dela::query();
        $query->where('user_id','=',Auth::user()->id);

if (isset($request->choice_2)) {
    $query=$query->orWhere('status','=' ,0);
    
}
if (isset($request->choice_3)) {
    $query=$query->orWhere('status','=',1);
    
}
if (isset($request->choice_4)) {
   $query=$query->orWhere('tip','=',2);
    
}
if (isset($request->choice_5)) {
   $query= $query->orWhere('tip','=',1);
   
}
$results=$query->get();




       foreach ($results as $row) {
            echo '
		<tr>
			<td>' . date('d.m.Y', strtotime($row->dates)) . '</td>
			<td><a href="mydela/'.$row->id.'"  " title="' . ($row->status == 1 ? 'Открыто' : 'Закрыто') . '" >' . ((mb_strlen($row->nazva) > 20) ? mb_substr($row->nazva, 0, 20) : $row->nazva) . '</a></td>
			<td>' . $row->city . '</td>
			<td>' . 1 . '</td>';
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
            echo '
            <td>
            <a class="del del_delo" href="' . site_url("main/del_delo/" . $row->id) . '" onclick="return confirm(\'Удалить дело «'. $row->nazva. '»?\')" title="Удалить"> <i class="remove"></i></a>
            </td>
		</tr>';
        }
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
        if($delo->user_id==Auth::user()->id)
        {
        $delo=Dela::findOrFail($id);
        }    
       return redirect()->route('profile.mydelo');
    }
    
    public function upload(Request $request){
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
    
  
    
}