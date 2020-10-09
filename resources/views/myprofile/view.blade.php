     @extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
          <main class="col-xs-12">
              
              
              
        
        <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li><a href="/profile">Профиль</a></li><li class="active">Моя Анкета</li>    </ol>
</div>	

<section>
<div class="people-outside lenta-sobitii moya-anketa">
	
  @include('myprofile.left')
    <div class="right">
	    <p class="title">
		<span>{{Auth::user()->name}}</span>
		<span><span title='Рейтинг'  >0</span>
				<a href="{{route('profile.edit')}}"  class="hide-xs">Редактировать</a>
		</p>
		<a href="{{route('profile.edit')}}"  class="show-xs"style="font-weight: 400;margin-top: 6px; float: left; color: grey; font-size: 14px; text-decoration: none;">Редактировать</a>
        <div class="upper-anketa">
            <span style="color: darkred; font-weight: 700; display: block;" class="user-status">{{ Auth::user()->person->help==='want' ? 'Хочу помогать': 'Мне нужна помощь' }}  </span>
			<div style="width:230px;padding-bottom:15px;">
			<img src="{{asset('storage/avatar/'.Auth::user()->person->avatar)}}">
			</div>
            <div class="anketa-right">
			<p>О себе: <span>{{isset(Auth::user()->person->about) ? mb_substr(Auth::user()->person->about, 0, 50): ''}}</span></p>
                 @if(Auth::user()->person->help==='need')
					<p>Мне нужна помощь:<span>Да</span></p> 
				 @else
					 <p>Хочу помогать:
				 <span> <ul style="
                                display: grid;
                                grid-template-columns: repeat(2, 1fr);
                                grid-gap: 0.5rem;
                                list-style-type: none;
                                float: left;
                                width: 100%;
                                margin: 0px;
                                font-weight: normal;
                                letter-spacing: 0.1px;
                                margin-bottom: 20px;
                                word-break: break-all;">
								@if($userNeed->where('user_id',Auth::user()->id)->where('need_id',1)->count()>0)
								<li><label class="radio-label"><input type="checkbox" checked disabled/> принимать участие в поисках пропавшего</label>
								</li>
								@endif
								@if($userNeed->where('user_id',Auth::user()->id)->where('need_id',2)->count()>0)	
								<li>
								<label class="radio-label"><input type="checkbox" checked disabled/> есть автомобиль</label>
								</li>
								@endif
								@if($userNeed->where('user_id',Auth::user()->id)->where('need_id',3)->count()>0)	
								<li><label class="radio-label"><input type="checkbox" checked disabled/> об звон больниц</label>
								</li>
								@endif
								@if($userNeed->where('user_id',Auth::user()->id)->where('need_id',4)->count()>0)
								<li><label class="radio-label"><input type="checkbox" checked disabled/> есть Квадроцикл / Cнегоход</label>
								</li>
								@endif
								@if($userNeed->where('user_id',Auth::user()->id)->where('need_id',5)->count()>0)
								<li><label class="radio-label"><input type="checkbox" checked disabled/> печать ориентировок</label>
								</li>
								@endif
								@if($userNeed->where('user_id',Auth::user()->id)->where('need_id',6)->count()>0)
								<li><label class="radio-label"><input type="checkbox" checked disabled/> мелкий ремонт</label>
								</li>
								@endif
								@if($userNeed->where('user_id',Auth::user()->id)->where('need_id',7)->count()>0)
								<li><label class="radio-label"><input type="checkbox" checked disabled/> можно переночевать на 1 ночь</label>
								</li>
								@endif
								@if($userNeed->where('user_id',Auth::user()->id)->where('need_id',8)->count()>0)
								<li><label class="radio-label"><input type="checkbox" checked disabled/> есть работа, не требующая специальной квалификации</label></li>
							    @endif
								@if($userNeed->where('user_id',Auth::user()->id)->where('need_id',9)->count()>0)
									<?php $text=$userNeed->where('user_id',Auth::user()->id)->where('need_id',9)->first() ?>
								<li><label class="radio-label"><input type="checkbox" checked disabled/><?php  echo $text->text; ?></label></li></ul></span></p>
							     @endif
				 @endif
				
            </div>
        </div>

        <div class="lower-anketa">
            <p>Пол: <span>
                @if(isset(Auth::user()->person->pol))
               @if(Auth::user()->person->pol==1)
               {{'Мужской'}}
               @else
                {{'Женский'}}
               @endif
                
              @endif
            </span></p>
            <p>Статус: <span>{{isset(Auth::user()->person->status_str) ? mb_substr(Auth::user()->person->status_str,0,50) : '---'}}</span></p>
			<p>E-mail: {{Auth::user()->email}}</p>
            <p>Skype/ICQ: <span>{{isset(Auth::user()->person->skype) ? mb_substr(Auth::user()->person->skype,0,50) : ''}}</span></p>
            <p>Сайт: <span>{{isset(Auth::user()->person->site) ? mb_substr(Auth::user()->person->site,0,50) : ''}}</span></p>
            <p>Должность: <span>{{isset(Auth::user()->person->dolznost) ? mb_substr(Auth::user()->person->dolznost,0,50) : ''}}</span></p>
            <p>Доход в месяц: <span>{{isset(Auth::user()->person->dohod) ? mb_substr(Auth::user()->person->dohod,0,50) : ''}}</span></p>
            <p>Увлечения: <span>{{isset(Auth::user()->person->hobbi) ? mb_substr(Auth::user()->person->hobbi,0,50) : ''}}</span></p>
        </div>

    </div>
</div>
</section>        

 @push('js')
        
         @endpush

@endsection