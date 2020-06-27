@extends('layouts.frontend.app')


@section('title',"Опрос")

@push('css')

@endpush
@section('content')
          <main class="col-xs-12">
              
              
   <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li class="active">Опросы</li>    </ol>
</div>

    <section>
	    <script>
$(document).ready(function(){
    $("#search_word").bind('keyup', function(){
		$(".poll-list").empty();
		$(".poll-list").append('<p style="text-align:center;"><br><br><img src="https://myldl.ru/application/views/front/images/ajax-loader.gif" /></p>');
		
		$.ajax({
			type: "POST",
			url: "https://myldl.ru/poll/ajax_search_questions",
			data: {
				'search_word' : $("#search_word").val(),
				'ci_csrf_token' : $.cookie('hash_cookie_id')
			},
			dataType: "html",
			success: function(msg){
				$(".poll-list").empty();
				$(".poll-list").append(msg);
			}
		});
	});
});
</script>
<link rel="stylesheet" href="https://myldl.ru/application/views/front/css/poll.css">

<div class="col-lg-9 col-lg-offset-0 col-md-8 col-sm-12">

    <div class="content-wrap">
        <h1 class="uppercase">Опросы</h1>
<!--        <div class="row page-search">-->
<!--            <form>-->
<!--                <div class="form-group">-->
<!--                    <input type="search" placeholder="Поиск" class="form-control" id="search_word" />-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
        <section class="poll-shorts-list">
            @foreach($quests as $q)
            <div class="row poll-list">
        <div class="pol" style="margin-bottom: 20px">
            <div class="psli psli-list">
                <h3><a href="/poll/view/{{$q->id}}">{{$q->text}}</a></h3>
                <ul>
                    <li><span>Всего проголосовало: </span>{{$q->getCountAnswer($q->id)}}</li>
                    <li><span>Опрос начат: </span>{{$q->created_at}}</li>
                    @if($q->endDate($q->end_date))
                    <li><span> Опрос закончен:</span> {{$q->end_date}}</li>
                    @endif
                    
                                    </ul>
            </div>
        </div>
          
             <div style="clear: both"></div>


            </div>
            
            @endforeach
        </section>
    </div>
</div>

    </section>

 
                       
                  @push('js')
       
 @endpush
 @endsection