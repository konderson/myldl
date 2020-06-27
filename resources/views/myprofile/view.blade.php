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
        <li><a href="https://myldl.ru/">Главная</a></li><li><a href="https://myldl.ru/profile">Профиль</a></li><li class="active">Моя Анкета</li>    </ol>
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
		<a href="https://myldl.ru/profile/profile_edit"  class="show-xs"style="font-weight: 400;margin-top: 6px; float: left; color: grey; font-size: 14px; text-decoration: none;">Редактировать</a>
        <div class="upper-anketa">
            
            <div class="anketa-right">
                <p>О себе: <span>{{isset(Auth::user()->person->about) ? Auth::user()->person->about : ''}}</span></p>
				<p>Мне нужна помощь:<span> 	{{Auth::user()->person->help!=='nedd' ? 'Да' : 'Нет'}}			</span></p>
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
            <p>Статус: <span>{{isset(Auth::user()->person->status_str) ? Auth::user()->person->status_str : '---'}}</span></p>
            <p>E-mail: {{Auth::user()->email}}</p>
            <p>Skype/ICQ: <span>{{isset(Auth::user()->person->skype) ? Auth::user()->person->skype : ''}}</span></p>
            <p>Сайт: <span>{{isset(Auth::user()->person->site) ? Auth::user()->person->site : ''}}</span></p>
            <p>Должность: <span>{{isset(Auth::user()->person->dolznost) ? Auth::user()->person->dolznost : ''}}</span></p>
            <p>Доход в месяц: <span>{{isset(Auth::user()->person->dohod) ? Auth::user()->person->dohod : ''}}</span></p>
            <p>Увлечения: <span>{{isset(Auth::user()->person->hobbi) ? Auth::user()->person->hobbi : ''}}</span></p>
        </div>

    </div>
</div>
</section>        

 @push('js')
        
         @endpush

@endsection