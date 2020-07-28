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
use App\News;
use App\CommentNews;
use App\Help;
use App\CommentHelp;
use App\Diary;
use App\CommentDiary;
use App\Project;
use App\CommentProject;
use App\Interview;
use App\CommentInter;
use App\SeoText;
use App\SQuestions;
use App\Answer;
use App\Tag;


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

	public function comentImportServ()
	{
		
		$coments = DB::connection('mysql2')->select('select * from comments  where section_id in ( SELECT id FROM sections_site where controllers="usluga")');
		
		foreach($coments as $cm)
		{
			$nc=new ComentService();
			$nc->id=$cm->id;
			$nc->user_id=$cm->user_id;
			$nc->text=$cm->texts;
			$nc->service_id=$cm->post_id;
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
	
	public function importNews()
	{
		
		$news = DB::connection('mysql2')->select('select * from news where id>82');
		
		foreach($news as $nw)
		{
			$nn=new News();
			$nn->id=$nw->id;
			$nn->name=$nw->mtitle;
			$nn->title=$nw->title;
			$nn->description=$nw->description;
			$nn->keyw=$nw->keywords;
			$nn->flag=$nw->flag;
			$nn->text=$nw->texts;
			

			if($nw->dates==null)
		{
		$nn->created_at='2020-01-01 00:00:00';
		}
		else{
		$nn->created_at=$nw->dates;
		}
		$nn->save();
		 for($i=0;$i<$nw->viewings;$i++)
			  {
				$view=new View();
			    $view->type_id=4;
				$view->ip=5555;
				$view->ip=5555;
				$view->post_id=$nw->id;
				$view->save();
				
			  }
		}
		
	}
	
public function comentImportNews()
	{
		
		$coments = DB::connection('mysql2')->select('select * from comments where section_id=18  ');
		
		foreach($coments as $cm)
		{
			$nc=new CommentNews();
			$nc->id=$cm->id;
			$nc->user_id=$cm->user_id;
			$nc->text=$cm->texts;
			$nc->news_id=$cm->post_id;
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
	
	public function likeImportNews()
	{
		$likes=DB::connection('mysql2')->select('select * from likes where section_id=18;  ');
		
		foreach($likes as $lk)
		{
			$like=new Like();
			$like->id=$lk->id;
			$like->type_id=3;
			$like->user_id=$lk->user_id;
			$like->ip=$lk->user_ip;
			if($lk->likes==1)
			{
				$like->dis_like=0;
			}
			else{
				$like->dis_like=1;
			}
			
			
			
			$like->post_id=$lk->post_id;
			$like->save();
			
		}
	}
	
	
	public function importHelp()
	{
		
		$helps = DB::connection('mysql2')->select('select * from vzaimopomoshi   ');
		
		foreach($helps as $help)
		{
			try{
			$nh=new Help();
			$nh->id=$help->id;
			$nh->user_id=$help->user_id;
			$nh->title=$help->tema;
			$nh->type=$help->type;
			$nh->description=$help->opisanie;
			$nh->email=$help->email;
			$nh->phone=$help->phone;
			$nh->cocial=$help->social;
			$nh->city_id=$help->city_id;
			$nh->country_id=$help->country_id;
			$nh->city=$help->city;
			$nh->status=$help->status;
			$nh->age=$help->age;
			$nh->wheres=$help->where;
			$nh->primeti=$help->primeti;
			$nh->name=$help->name;
			$nh->images=$help->images;
		
			
			
			if($help->date==null)
		{
		$nh->created_at='2020-01-01 00:00:00';
		}
		else{
		$nh->created_at=$help->date;
		}
		$nh->save();
		
			  }catch (QueryException $e) {
				  if($e->getCode()==23000){continue;}
               
}
		}
		
	}
	
	
	public function importHelpView()
	{
		$helps = DB::connection('mysql2')->select('select * from vzaimopomoshi   where id>="1865" ');
		
		foreach($helps as $help)
		{
			for($i=0;$i<$help->prosmotrov;$i++)
			{
		        $view=new View();
			    $view->type_id=3;
				$view->ip=5555;
				$view->ip=5555;
				$view->post_id=$help->id;
				$view->save();
			}
	}
	}
	 public function importHelpComent()
	 {
	    
		$coments = DB::connection('mysql2')->select('select * from comments  where section_id in ( SELECT id FROM sections_site where controllers="searche")');
		
		foreach($coments as $cm)
		{
			$nc=new CommentHelp();
			$nc->id=$cm->id;
			$nc->user_id=$cm->user_id;
			$nc->text=$cm->texts;
			$nc->help_id=$cm->post_id;
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
	 
	 public function importDiary()
	{
		
		$diaries = DB::connection('mysql2')->select('select * from dnevnik   ');
		
		foreach($diaries as $dir)
		{
			try{
			$nd=new Diary();
			$nd->id=$dir->id;
			$nd->user_id=0;
			$nd->name=$dir->nazva;
			$nd->text=$dir->texts;
		
			
			
			if($dir->date_create==null)
		{
		$nd->created_at='2020-01-01 00:00:00';
		}
		else{
		$nd->created_at=$dir->date_create;
		}
		$nd->save();
		
			  }catch (QueryException $e) {
				  if($e->getCode()==23000){continue;}
               
}
		}
		
	}
	 
	public function  importDiaryLike()
	{
				$likes=DB::connection('mysql2')->select('select * from likes where section_id=276;  ');
		
		foreach($likes as $lk)
		{
			$like=new Like();
			
			$like->type_id=6;
			$like->user_id=$lk->user_id;
			$like->ip=$lk->user_ip;
			if($lk->likes==1)
			{
				$like->dis_like=0;
			}
			else{
				$like->dis_like=1;
			}
			
			
			
			$like->post_id=$lk->post_id;
			$like->save();
			
		}
		
	}
	
	public function importDiaryComent()
	 {
	    
		$coments = DB::connection('mysql2')->select('select * from comments  where section_id=276 ');
		foreach($coments as $cm)
		{
			$nc=new CommentDiary();
			$nc->id=$cm->id;
			$nc->user_id=$cm->user_id;
			$nc->text=$cm->texts;
			$nc->diary_id=$cm->post_id;
			if($cm->user_name==null)
			{
			$nc->author_name="not";
			}
			else{
				$nc->author_name=$cm->user_name;
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
	 
	  public function importProject()
	{

		$progects = DB::connection('mysql2')->select('select * from projects');
		
		
		foreach($progects as $pr)
		{
		
			$np=new Project();
			$np->id=$pr->id;
			$np->user_id=0;
			$np->view=0;
			$np->name=$pr->nazva;
			$np->images='none.jpg';
			$np->text=$pr->texts;
		
			
			
			if($np->date_create==null)
		{
		$np->created_at='2020-01-01 00:00:00';
		}
		else{
		$np->created_at=$pr->date_create;
		}
		$np->save();
	dd('on3');
		}
		
	}
	
	public function  importProjectLike()
	{
				$likes=DB::connection('mysql2')->select('select * from likes where section_id=52818 ');
		
		foreach($likes as $lk)
		{
			$like=new Like();
			
			$like->type_id=5;
			$like->user_id=$lk->user_id;
			$like->ip=$lk->user_ip;
			if($lk->likes==1)
			{
				$like->dis_like=0;
			}
			else{
				$like->dis_like=1;
			}
			
			
			
			$like->post_id=$lk->post_id;
			$like->save();
			
		}
		
	}
	
	public function importProjectComent()
	 {
	    
		$coments = DB::connection('mysql2')->select('select * from comments where section_id=52818 ');
		foreach($coments as $cm)
		{
			$nc=new CommentProject();
			$nc->id=$cm->id;
			$nc->user_id=$cm->user_id;
			$nc->text=$cm->texts;
			$nc->project_id =$cm->post_id;
			if($cm->user_name==null)
			{
			$nc->author_name="not";
			}
			else{
				$nc->author_name=$cm->user_name;
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
	  public function importInterview()
	{

		$intervs = DB::connection('mysql2')->select('select * from interview');
		
		
		foreach($intervs as $intr)
		{
		
			$ni=new Interview();
			$ni->id=$intr->id;
			$ni->user_id=0;
			$ni->name=$intr->nazva;
			$ni->image=$intr->images;
			$ni->tex=$intr->texts;
		    $ni->name_i=$intr->name;
			$ni->dostijenia=$intr->progress;
			$ni->age=$intr->old;
			$ni->work=$intr->job;
			$ni->hobbi=$intr->interests;
			
			
			
		
			
			
			if($intr->date_create==null)
		{
		$ni->created_at='2020-01-01 00:00:00';
		}
		else{
		$ni->created_at=$intr->date_create;
		}
		$ni->save();

		}
		
	}
	
	public function  importInterviewLike()
	{
				$likes=DB::connection('mysql2')->select('select * from likes where section_id=22 ');
		
		foreach($likes as $lk)
		{
			$like=new Like();
			
			$like->type_id=2;
			$like->user_id=$lk->user_id;
			$like->ip=$lk->user_ip;
			if($lk->likes==1)
			{
				$like->dis_like=0;
			}
			else{
				$like->dis_like=1;
			}
			
			
			
			$like->post_id=$lk->post_id;
			$like->save();
			
		}
		
	}
	
	public function importInterviewComent()
	 {
	    
		$coments = DB::connection('mysql2')->select('select * from comments where section_id=22 ');
		foreach($coments as $cm)
		{
			$nc=new CommentInter();
			$nc->id=$cm->id;
			$nc->user_id=$cm->user_id;
			$nc->text=$cm->texts;
			$nc->interview_id =$cm->post_id;
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
	
	
	public function importSeoText()
	{
		$texts=DB::connection('mysql2')->select('select * from seo_texts ');
		
		foreach($texts as $text)
		{
			$s=new  SeoText();
			$s->id=$text->id;
			$s->name=$text->title_page;
			$s->title=$text->title;
			$s->text=$text->text;
			$s->description=$text->description;
			$s->keyw=$text->keywords;
			$s->url=$text->page;
			$s->save();
			
		}
	}
	
	public function importSQuest()
	{
		$questions=DB::connection('mysql2')->select('select * from social_questions ');
		
		foreach($questions as $q)
		{
			$nc=new SQuestions();
			$nc->id=$q->id;
			if($q->type_choice='one_choice')
			{
				$nc->tip_id=1;
			}
			if($q->type_choice='multi_choice')
			{
				$nc->tip_id=2;
			}
			$nc->is_open=$q->is_open;
			$nc->text=$q->texts;
			$nc->razdel_id=$q->section_id;
			$nc->variaant1=$q->variant_1;
			$nc->variaant2=$q->variant_2;
			$nc->variaant3=$q->variant_3;
			$nc->variaant4=$q->variant_4;
			$nc->variaant5=$q->variant_5;
			$nc->variaant6=$q->variant_6;
			$nc->variaant7=$q->variant_7;
			$nc->variaant8=$q->variant_8;
			$nc->variaant9=$q->variant_9;
			$nc->variaant10=$q->variant_10;
			$nc->end_date=$q->dates_end;
			$nc->save();
			
		}
		
	}
	
	public function importAnswer()
	{
		$answers=DB::connection('mysql2')->select('select * from social_questions_answers ');
		
		foreach($answers as $a)
		{
			$na=new Answer();
			$na->id=$a->id;
			$na->user_id=$a->user_id;
			$na->ip=$a->user_ip;
			$na->section_id=$a->section_site_id;
			if($a->type_choice==='one_choice')
			{
				$na->type_q=1;
			}
			if($a->type_choice==='multi_choice')
			{
				$na->type_q=2;
			}
			else{
				$na->type_q=1;
			}
			$na->q_id=$a->question_id;
			if($a->choice==='variant_1')
			{
				$na->variant_1=1;
			}
			
			if($a->choice==='variant_2')
			{
				$na->variant_2=1;
			}
			if($a->choice==='variant_3')
			{
				$na->variant_3=1;
			}
			if($a->choice==='variant_4')
			{
				$na->variant_4=1;
			}
			if($a->choice==='variant_5')
			{
				$na->variant_5=1;
			}
			if($a->choice==='variant_6')
			{
				$na->variant_6=1;
			}
			if($a->choice==='variant_7')
			{
				$na->variant_7=1;
			}
			if($a->choice==='variant_8')
			{
				$na->variant_8=1;
			}
			if($a->choice==='variant_9')
			{
				$na->variant_9=1;
			}
			if($a->choice==='variant_10')
			{
				$na->variant_10=1;
			}
			$na->save();
			
		}
		
	}
	public function importTagNews()
	{
		$tags=DB::connection('mysql2')->select('select * from materials_tags');
		
		foreach($tags as $tag)
		{
			DB::connection('mysql')->table('news_tag')->insert([
    [ 'news_id' => $tag->post_id,'tag_id'=>$tag->tag_id,]]);
	    }
	 }
}
