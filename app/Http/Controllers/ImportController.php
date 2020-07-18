<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\User;
use App\Person;
use App\Dela;
use App\CommentDele;
use App\Like;
use App\DeloFeatured;
use App\View;
use App\Service;
use App\ComentService;

class ImportController extends Controller
{
    public function importUser()
	{
		$users = DB::connection('mysql2')->select('select * from users  where id > 18763');
		
		foreach($users as $user)
		{
			try {
	    $n_user=new User();
		$n_user->id=$user->id;
		$n_user->name=$user->login;
		$n_user->email=$user->email;
		$n_user->password=$user->pass;
		if($user->active==2)
		{
		$n_user->verified=1;
		$n_user->token=555555;
		}
		else
		{
			$n_user->verified=0;
		}
		if($user->last_visit==null)
		{
		$n_user->updated_at='2020-01-01 00:00:00';
		}
		else{
			$n_user->updated_at=$user->last_visit.' 00:00:00';
		}
		if($user->date_reg==null)
		{
		$n_user->created_at='2020-01-01 00:00:00';
		}
		else{
		$n_user->created_at=$user->date_reg.' 00:00:00';
		}
		
		$n_user->save();
		
		$ps=new Person();
		$ps->user_id=$n_user->id;
		$ps->tel=$user->tel_mob;
		$ps->chel_org=$user->chel_org;
        $ps->help=$user->help;	
		$ps->help_additional=$user->help_additional;
		$ps->reputation=$user->reputation;
		$ps->birthday=$user->birthday;
		$ps->pol=$user->pol;
		$ps->city=$user->city;
		$ps->city_id=$user->city_id;
		$ps->country=$user->country;
        $ps->street=$user->ulica;
        $ps->house=$user->dom;
        $ps->apartment=$user->kvartira;
        $ps->subscribed=$user->subscribed;
        $ps->status_str=$user->status_str;
        if($user->active==2)
		{
		$ps->active=1;
		
		}
		else
		{
		$ps->active=0;
		}
		
		$ps->site=$user->site;
		$ps->skype=$user->skype;
		$ps->dolznost=$user->dolzhnost;
		$ps->dohod=$user->dohod;
		$ps->about=$user->about;
   		$ps->hobbi=$user->uvlecheniya;
   		$ps->avatar=$user->avatar;
   		$ps->ip=$user->ip;
   		$ps->hobbi=$user->uvlecheniya;
   		$ps->hobbi=$user->uvlecheniya;
		$ps->save();
			
			} catch (QueryException $e) {
               continue;
}
		}
		
        
	}
	
	public function importDela()
	{
		$delas = DB::connection('mysql2')->select('select * from dela  ');
		foreach($delas as $dela)
		{
			$delo=new Dela();
			$delo->id=$dela->id;
			$delo->user_id=$dela->user_id;
			$delo->nazva=$dela->nazva;
			$delo->tip=$dela->tip;
			$delo->vhod_v_delo=$dela->vhod_v_delo;
			$delo->comment_k_delu=$dela->comment_k_delu;
			$delo->uslovia_vhoda=$dela->uslovia_vhoda;
			$delo->opisanie=$dela->opisanie;
			$delo->country_id=$dela->country_id;
			$delo->city_id=$dela->city_id;
			$delo->city=$dela->city;
			$delo->status=$dela->status;
			$delo->tekuschiy_status=$dela->tekuschiy_status;
			$delo->bydzet=$dela->bydzet;
			$delo->vremya=$dela->vremya;
			$delo->effekt=$dela->effekt;
			$delo->dlya_chego=$dela->dlya_chego;
			$delo->blagodarnost=$dela->blagodarnost;
			$delo->images=$dela->images;
			if($dela->dates==null)
		{
		$delo->created_at='2020-01-01 00:00:00';
		}
		else{
		$delo->created_at=$dela->dates.' 00:00:00';
		}
			
			$delo->save();
			
	}
	}
	
	public function comentImportDela()
	{
		
		$coments = DB::connection('mysql2')->select('select * from comments where section_id=12  ');
		
		foreach($coments as $cm)
		{
			$nc=new CommentDele();
			$nc->id=$cm->id;
			$nc->user_id=$cm->user_id;
			$nc->text=$cm->texts;
			$nc->dela_id=$cm->post_id;
			if($cm->user_name==null)
			{
			$nc->name_author="not";
			}
			else{
				$nc->name_author=$cm->user_name;
			}
			
	
			$nc->parent_id=$cm->parent_id;
			if($cm->user_id!=0)
			{
				$nc->isauth=1;
			}
			else
			{
				$nc->isauth=0;
			}
			if($cm->dates==null)
		{
		$nc->created_at='2020-01-01 00:00:00';
		}
		else{
		$nc->created_at=$cm->dates;
		}
		$nc->save();
		}
		
	}
	public function likeImportDela()
	{
		$likes=DB::connection('mysql2')->select('select * from likes where section_id=12;  ');
		
		foreach($likes as $lk)
		{
			$like=new Like();
			$like->id=$lk->id;
			$like->type_id=1;
			$like->user_id=$lk->user_id;
			$like->ip=$lk->user_ip;
			$like->dis_like=$lk->likes;
			$like->post_id=$lk->post_id;
			$like->save();
			
		}
	}
	
	public function importFeaturedVsPartic()
	{
		/*$featureds=DB::connection('mysql2')->select('select * from izbranniye_dela');
		foreach($featureds as $fr)
		{
			$fn=new DeloFeatured();
			$fn->id=$fr->id;
			$fn->user_id=$fr->user_id;
			$fn->delo_id=$fr->delo_id;
			$fn->save();
		}*/
		  $paricepents=DB::connection('mysql2')->select('select * from delo_uchasniki');
		  
		  foreach( $paricepents as $pc)
		  {
			  
			  try{
			  
			 DB::connection('mysql')->table('user_dela')->insert([
    ['id' => $pc->id, 'user_id' => $pc->user_id,'delo_id'=>$pc->delo_id,'tip_id'=>$pc->tipi_svyazi]]);
			  }catch (QueryException $e) {
               continue;
}
		  }
		
		
	}

public function importSevices()
    {
	 $services=DB::connection('mysql2')->select('select * from uslugi');
	 
	 foreach($services as $sv)
	 {
		 try{
			 $ns=new Service();
			 $ns->id=$sv->id;
			 $ns->user_id =$sv->user_id;
			 $ns->title=$sv->tema;
			 $ns->razdel_id=$sv->razdel_id;
			 $ns->description=$sv->opisanie;
			 $ns->srok=$sv->srok;
			 $ns->price=$sv->cena;
			 $ns->phone=$sv->tel;
			 $ns->city_id=$sv->city_id;
			 $ns->city=$sv->city;
			 $ns->country_id =$sv->country_id;
			 $ns->status=$sv->status;
			 $ns->flag_email=$sv->flag_message;
			 $ns->flag_coment=$sv->flag_comment;
			 $ns->images=$sv->images;
			if($sv->date_create==null)
		      {
		      $ns->created_at='2020-01-01 00:00:00';
		      }
		      else{
		      $ns->created_at=$sv->date_create;
		      }
			  $ns->save();
			  for($i=0;$i<$sv->prosmotrov;$i++)
			  {
				$view=new View();
			    $view->type_id=2;
				$view->ip=5555;
				$view->ip=5555;
				$view->post_id=$sv->id;
				$view->save();
				
			  }
			  
			  }
			  
		 catch (QueryException $e) {
               continue;
                 }
				 }
				 
		
        	 
    }

	public function comentImportDela()
	{
		
		$coments = DB::connection('mysql2')->select('select * from comments where section_id=12  ');
		
		foreach($coments as $cm)
		{
			$nc=new CommentDele();
			$nc->id=$cm->id;
			$nc->user_id=$cm->user_id;
			$nc->text=$cm->texts;
			$nc->dela_id=$cm->post_id;
			if($cm->user_name==null)
			{
			$nc->name_author="not";
			}
			else{
				$nc->name_author=$cm->user_name;
			}
			
	
			$nc->parent_id=$cm->parent_id;
			if($cm->user_id!=0)
			{
				$nc->isauth=1;
			}
			else
			{
				$nc->isauth=0;
			}
			if($cm->dates==null)
		{
		$nc->created_at='2020-01-01 00:00:00';
		}
		else{
		$nc->created_at=$cm->dates;
		}
		$nc->save();
		}
		
	}

	
}
