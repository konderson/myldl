         @extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
          <main class="col-xs-12">
        

    <script>
    $( document ).ready(function() {
	var type='';
	var count=1;
		$('#frendLenta').click(function(){
		getLentaFilter('frendLenta');
		});
		
		$('#alldLenta').click(function(){
		type='alldLenta';
		getLentaFilter(type);
		});
		
		$('#myDeladLenta').click(function(){
			type='myDeladLenta'
		   getLentaFilter(type);
		    count=1;
		});
		
		$('#izbDelodLenta').click(function(){
			type='izbDelodLenta';
		getLentaFilter(type);
            count=1;
		});
		
		function getLentaFilter(type)
		{
		 $.ajax(

        {
            url: '/profile/getLenta?type=' +type ,

            type: "get",

            datatype: "html"

        }).done(function(data){
            $('.table tbody').empty();
			$('.table tbody').append(data);

            location.hash = count;
            
        

        }).fail(function(jqXHR, ajaxOptions, thrownError){

              alert('No response from server');

        });
		}
		
		
    
		
		
		
		
		
       
		
    $('#more_all').click(function(){
        count++;
        $('#counter').empty();
         $.ajax(

        {

            url:'/profile/getLenta?type='+type+'&page='+count+'&more=1',

            type: "get",

            datatype: "html"

        }).done(function(data){

            //$("#datapost").html(data);
			
             //$('.table tbody').append(data);
             $('#myTableId').after(data);
            //location.hash = count;
            
        

        }).fail(function(jqXHR, ajaxOptions, thrownError){

              alert('No response from server');

        });
      
    });
   });
   </script>

<div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li class="active">Профиль</li>    </ol>

<style>
    .selected{
        font-weight:600;
    }
</style>

<section>
    <div class="people-outside lenta-sobitii">
	    
    @include('myprofile.left')
       <div class="right">
            <h1 class="title">Лента событий</h1>
            <div class="lenta-options subtab-menu filter-list">
                <label data-filter="all" class="checked"><span id="alldLenta">Все</span></label>
                <label data-filter="lync"><span id="frendLenta">Мои связи</span></label>
                <label data-filter="business"><span id="myDeladLenta">Мои дела</span></label>
                <label data-filter="faworites"><span id='izbDelodLenta'>Избранные дела</span></label>
                <label data-filter="notshow"><span>Непрочитанные </span></label>
            </div>
            <div class="layer">                <div class="lenta-table">
                    <table class="table">
                        <tbody id="myTableId"><tr>
                            <th>Фото:</th>
                            <th>Название события:</th>
                            <th>Раздел:</th>
                            <th>Дата:</th>
                        </tr>
                        @foreach($events as $event)
                            <tr>
                            <td><img src="{{asset('storage/avatar/'.$event->user->person->avatar)}}" style="max-width: 100px;"></td>
                            <td>{!!$event->title!!}</td>
                            <td><span class="table-span-bold">Мои связи</span></td>
                            <td><span class="table-span-bold">{{$event->created_at}}</span></td>
                        </tr>
                        @endforeach
                         <p style="display:none" id="counter">1</p>
                </tbody> 
                </table><button id="more_all" style="background-color: #89bc28;color:#fff;border:none;padding:5px;">Показать еще</button>
               
                </div>

	            	            </div>
    </div>
</section>        
 @push('js')
        
         @endpush

@endsection