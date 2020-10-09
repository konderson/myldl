@extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')
<style>


#fade { 
    display: none;/*--по умолчанию скрыто--*/ 
    background: rgba(7, 87, 207, 0.8);
    position: fixed; left: 0; top: 0;
    width: 100%; height: 100%;
    opacity: .80; 
    z-index: 9999;
}
.popup_block {
    display: none; /*--по умолчанию скрыто--*/
    background: #fff;
    padding: 20px;
    border: 8px solid rgb(134, 134, 134);
    float: left;
    font-size: 85%;
    position: fixed;
    top: 50%; left: 50%;color: #000;
    max-width: 750px;
    min-width: 320px;
    height: auto;
    z-index: 99999;
    /*--CSS3 тень блока--*/
    -webkit-box-shadow: 0px 0px 20px #000;
    -moz-box-shadow: 0px 0px 20px #000;
    box-shadow: 0px 0px 20px #000;
    /*--CSS3 скругление углов--*/
    -webkit-border-radius: 12px;
    -moz-border-radius: 12px;
    border-radius: 12px;
}
.popup_block p {	
    font-weight: 400;
    padding: 0;
    margin: 0;
    color: #000;
    line-height: 1.6;}
.popup_block h2 {
    margin: 0px 0 10px;
    color: rgb(43, 43, 43);
    font-weight: 400;
    text-align: center;
    
}	
/* формируем кнопку закрытия */
.close {
    background-color: rgba(61, 61, 61, 0.8);
    border: 2px solid #ccc;
    height: 25px;
    line-height: 20px;
    position: absolute;
    right: -17px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;padding: 0;
    top: -17px;
    width: 25px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    -moz-box-shadow: 1px 1px 3px #000;
    -webkit-box-shadow: 1px 1px 3px #000;
    box-shadow: 1px 1px 3px #000;
}
.close:before {
    color: rgba(255, 255, 255, 0.9);
    content: "X";
    font-size: 12px;
    text-shadow: 0 -1px rgba(0, 0, 0, 0.9);
}
.close:hover {
    background-color: rgba(252, 20, 0, 0.8);
}
.shadow {
    box-shadow:4px 4px 10px #857373;
   -webkit-box-shadow:4px 4px 10px #857373;
   -moz-box-shadow:4px 4px 10px #857373;
    padding:0;
}
/*--фиксированное позиционирование для IE6--*/
*html #fade {
    position: absolute;
}
*html .popup_block {
    position: absolute;
}
    .pagination li{
    list-style-type: none;
    float: left;
    margin-left: 10px;
}
.pagination li span {
    color: #000;
}

.active{
    display: inline-block;
    cursor: pointer;
    padding: 5px 10px;
    background-color: #99ca3d;
    color: #fff;
    font-weight: 700;
    letter-spacing: 0.1px;
    margin-right: 3px;
    text-decoration: none;
    text-transform: uppercase;
    margin-bottom: 5px;
}
.pagination li span{
    color:#fff;
}

.pagination li a {
    margin-left:-8px;
    color: #000;
    text-decoration: none;
}

</style>
@endpush
@section('content')
          <main class="col-xs-12">
              
              
              
              <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li>
       </li><li style="color:#8e8e8e">Пользоватетели</li>
    </ol>
</div>
<script>
    $( document ).ready(function() {
     
        //window.history.pushState({}, document.title, "/" + "hochu_pom");
        
        $("#online").click(function() {
    
    if(this.checked) {
        
      $.ajax({
                type: "GET",
                url: "/users/online",
                dataType: "html",
                success: function (data) {
                   $("#datapost").empty().html(data);
                        var scrollTop = $('#datapost').offset();
                        val=$("#cf").text();
            
             $(".status").text(val);
            $(document).scrollTop(scrollTop);
            window.history.pushState({}, document.title, "/" + "users");
                        
                    
                    
                }
      });
    }
    else{
        window.location.href = "/users";
    }
});
        
        
                $('select[name=country]').change(function () {
            $("#region").empty();
            $.ajax({
                type: "GET",
                url: "/ajax_get_region/" + $(this).val(),
                dataType: "html",
                success: function (msg) {
                   $("#region").append('<option value="">Регион</option>'+msg).data("selectBox-selectBoxIt").refresh();
                   
                        
                        
                    
                    
                }
            });
            country_id=$('select[name=country]').val(); // для підсввітки вибраної
            region=$('select[name=region]').val();
            sity=$('select[name=sity]').val();
            name=$('.ufilter').val();
                  
				  
				  str=document.location.search;
				  sh='';
				 if( str.indexOf('need') !== -1)
				 {
					 sh='need';
				 }
				if( str.indexOf('want') !== -1)
					 {
						sh='want';
					 }
            
            
             $.ajax(

        {

            url:"/search/user?country_id="+country_id+"&sh="+sh+'&serch_by_name='+name,

            type: "get",

            datatype: "html"

        }).done(function(data){

            $("#datapost").empty().html(data);
            val=$("#cf").text();
            
             $(".status").text(val);
           
            var scrollTop = $('#datapost').offset();
            $(document).scrollTop(scrollTop);
            window.history.pushState({}, document.title, "/" + "users");

        }).fail(function(jqXHR, ajaxOptions, thrownError){

              alert('Нет данных');

        });
            
            
            
            
        });
		
		
		$('select[name=types]').change(function () {
		 country_id=$('select[name=country]').val(); // для підсввітки вибраної
            region=$('select[name=region]').val();
            city=$('select[name=city]').val();
             region_id=$('select[name=region]').val();
			 types=$('select[name=types').val();
             name=$('.ufilter').val();
			 //window.location.search="?sh="+types;
			  $.ajax({

            url:"/search/user?country_id="+country_id+"&region_id="+region+"&city_id="+city+"&sh="+types+'&serch_by_name='+name,

            type: "get",

            datatype: "html"

        }).done(function(data){

            $("#datapost").empty().html(data);
             val=$("#cf").text();
            
             $(".status").text(val);
           
            var scrollTop = $('#datapost').offset();
            $(document).scrollTop(scrollTop);
             window.history.pushState({}, document.title, "/" + "users");

        }).fail(function(jqXHR, ajaxOptions, thrownError){

              alert('Нет данных');

        });
           
			 
			 
		})
		
		
		
      /**
       * код при выборе региона + фильтр по region_id
       ***/
      $('select[name=region]').change(function () {
            $("#city").empty();
            $.ajax({
                type: "GET",
                url: "/ajax_get_city/" + $(this).val(),
                dataType: "html",
                success: function (msg) {
                  $("#city").append('<option value="">Город</option>'+msg).data("selectBox-selectBoxIt").refresh();
                    
                }
            });
            country_id=$('select[name=country]').val(); // для підсввітки вибраної
            region=$('select[name=region]').val();
            city=$('select[name=city]').val();
             region_id=$('select[name=region]').val();
             name=$('.ufilter').val();

              
				  str=document.location.search;
				  sh='';
				 if( str.indexOf('need') !== -1)
				 {
					 sh='need';
				 }
				if( str.indexOf('want') !== -1)
					 {
						sh='want';
					 }
                 

    $.ajax(

        {

            url:"/search/user?country_id="+country_id+"&region_id="+region+"&sh="+sh+'&serch_by_name='+name,

            type: "get",

            datatype: "html"

        }).done(function(data){

            $("#datapost").empty().html(data);
              val=$("#cf").text();
            
             $(".status").text(val);
           
            var scrollTop = $('#datapost').offset();
            $(document).scrollTop(scrollTop);
             window.history.pushState({}, document.title, "/" + "users");

        }).fail(function(jqXHR, ajaxOptions, thrownError){

              alert('Нет данных');

        });
            



            
        });
     
            
            $('select[name=city]').change(function(){
            country_id=$('select[name=country]').val(); // для підсввітки вибраної
            region=$('select[name=region]').val();
            sity=$('select[name=city]').val();
            name=$('.ufilter').val();
            
            
    $.ajax(

        {

            url:"/search/user?country_id="+country_id+"&region_id="+region+"&city_id="+sity+'&serch_by_name='+name,

            type: "get",

            datatype: "html"

        }).done(function(data){

            $("#datapost").empty().html(data);
             val=$("#cf").text();
            
             $(".status").text(val);
           
            var scrollTop = $('#datapost').offset();
            $(document).scrollTop(scrollTop);
             window.history.pushState({}, document.title, "/" + "users");

        }).fail(function(jqXHR, ajaxOptions, thrownError){

              alert('Нет данных');

        });
           
        });    
        $('#write_message').click(function(evt){
                var popID = $(this).attr('rel'); //получаем имя окна, важно не забывать при добавлении новых менять имя в атрибуте rel ссылки
		var popURL = $(this).attr('href'); //получаем размер из href атрибута ссылки
            
            
              $.ajax({
                
   url:"/ajax/check_auth",
   method:"POST",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(msg)
   {
      
  if(msg==1){ 
          
                 window.location.href = "/profile/vzaimopomoshi";evt.preventDefault();
            }
           else{
               
               
           
				
		//запрос и переменные из href url
		var query= popURL.split('?');
		var dim= query[1].split('&');
		var popWidth = dim[0].split('=')[1]; //первое значение строки запроса
 
		//Добавляем к окну кнопку закрытия
		$('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" title="Закрыть" class="close"></a>');
		
        //Определяем маржу(запас) для выравнивания по центру (по вертикали и горизонтали) - мы добавляем 80 к высоте / ширине с учетом отступов + ширина рамки определённые в css
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;
		
		//Устанавливаем величину отступа
		$('#' + popID).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		//Добавляем полупрозрачный фон затемнения
		$('body').append('<div id="fade"></div>'); //div контейнер будет прописан перед тегом </body>.
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //полупрозрачность слоя, фильтр для тупого IE
		
           }

	
       
           }
                
      })
  
  });
  
  
  
    $('.search-magnify').click(function (e) {
            e.preventDefault();
			 e.preventDefault();
            country_id=$('select[name=country]').val(); // для підсввітки вибраної
            region=$('select[name=region]').val();
            city=$('select[name=city]').val();
             region_id=$('select[name=region]').val();
             str=document.location.search;
             name=$('.ufilter').val();
             sh='';
                 if( str.indexOf('need') !== -1)
                 {
                     sh='need';
                 }
                if( str.indexOf('want') !== -1)
                     {
                        sh='want';
                     }
                    $.ajax(

        {

            url:"/search/user?country_id="+country_id+"&region_id="+region+"&sh="+sh+'&serch_by_name='+name+"&city_id="+city,

            type: "get",

            datatype: "html"

        }).done(function(data){

            $("#datapost").empty().html(data);
            val=$("#cf").text();
            
             $(".status").text(val);
           
            var scrollTop = $('#datapost').offset();
            $(document).scrollTop(scrollTop);
            window.history.pushState({}, document.title, "/" + "users");

        }).fail(function(jqXHR, ajaxOptions, thrownError){

              alert('Нет данных');
        });
         
        });
     $('.close_btn_filter').click(function(){
		 $('.filterss').css('display','none');
		 $('.close_btn_filter').css('display','none');
	 });
	 $('.filter').click(function(){
		 $('.filterss').css('display','flex');
		 $('.close_btn_filter').css('display','block');
	 });
            
});
</script>
<script>
    $(document).on('submit', '.search', function (e) {
           e.preventDefault();
            country_id=$('select[name=country]').val(); // для підсввітки вибраної
            region=$('select[name=region]').val();
            city=$('select[name=city]').val();
             region_id=$('select[name=region]').val();
             str=document.location.search;
             name=$('.ufilter').val();
             sh='';
                 if( str.indexOf('need') !== -1)
                 {
                     sh='need';
                 }
                if( str.indexOf('want') !== -1)
                     {
                        sh='want';
                     }
                    $.ajax(

        {

            url:"/search/user?country_id="+country_id+"&region_id="+region+"&sh="+sh+'&serch_by_name='+name+"&city_id="+city,

            type: "get",

            datatype: "html"

        }).done(function(data){

            $("#datapost").empty().html(data);
            val=$("#cf").text();
            
             $(".status").text(val);
           
            var scrollTop = $('#datapost').offset();
            $(document).scrollTop(scrollTop);
            window.history.pushState({}, document.title, "/" + "users");

        }).fail(function(jqXHR, ajaxOptions, thrownError){

              alert('Нет данных');
        });
         
        });
</script>

<script>
     $("#online").click(function() {
            alert('j')
    if(this.checked) {
       window.location.href = "/users/online";
    }
    else{
        window.location.href = "/users";
    }
});
</script>
  <script type="text/javascript" src="{{asset('asset/front/fancy_box/jquery.fancybox.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('asset/front/fancy_box/jquery.fancybox.css')}}" media="screen" />
<section>
    <div class="advert">
        <div class="left">
            <div class="people-title">
                <h1 class="titles">Люди</h1>
                <span class="status">{{$count}}</span>
                <input type="checkbox" id="online" name="status" value="1">
                <span class="status2">Сейчас на сайте</span>
            </div>
            <div class="advert-body">
                <div class="advert-search-row">
                    <div class="f1">
                        <form class="search">
	                                                    <input type="text" placeholder="поиск..." value="" class="ufilter"/>
                            <input type="button" class="search-magnify" value="">
                        </form>
                        <div class="filter"></div>
                    </div>
                    <div class="f2">
                        <div class="filterss">
                        <div>
                            <select name="country" id="country" class="selectb form-control">
                                
                                             <option value="">Страна</option>
                                                                                                        <option value="3159" >Россия</option>
                                                                                                        <option value="9908" >Украина</option>
                                                                                                        <option value="248" >Беларусь</option>
                                                                                                        <option value="1894" >Казахстан</option>
                                                                                                        <option value="4" >Австралия</option>
                                                                                                        <option value="63" >Австрия</option>
                                                                                                        <option value="81" >Азербайджан</option>
                                                                                                        <option value="173" >Ангуилья</option>
                                                                                                        <option value="177" >Аргентина</option>
                                                                                                        <option value="245" >Армения</option>
                                                                                                        <option value="7716093" >Арулько</option>
                                                                                                        <option value="401" >Белиз</option>
                                                                                                        <option value="404" >Бельгия</option>
                                                                                                        <option value="425" >Бермуды</option>
                                                                                                        <option value="428" >Болгария</option>
                                                                                                        <option value="467" >Бразилия</option>
                                                                                                        <option value="616" >Великобритания</option>
                                                                                                        <option value="924" >Венгрия</option>
                                                                                                        <option value="971" >Вьетнам</option>
                                                                                                        <option value="994" >Гаити</option>
                                                                                                        <option value="1007" >Гваделупа</option>
                                                                                                        <option value="1012" >Германия</option>
                                                                                                        <option value="1206" >Голландия</option>
                                                                                                        <option value="2567393" >Гондурас</option>
                                                                                                        <option value="277557" >Гонконг</option>
                                                                                                        <option value="1258" >Греция</option>
                                                                                                        <option value="1280" >Грузия</option>
                                                                                                        <option value="1366" >Дания</option>
                                                                                                        <option value="2577958" >Доминиканская республика</option>
                                                                                                        <option value="1380" >Египет</option>
                                                                                                        <option value="1393" >Израиль</option>
                                                                                                        <option value="1451" >Индия</option>
                                                                                                        <option value="277559" >Индонезия</option>
                                                                                                        <option value="277561" >Иордания</option>
                                                                                                        <option value="3410238" >Ирак</option>
                                                                                                        <option value="1663" >Иран</option>
                                                                                                        <option value="1696" >Ирландия</option>
                                                                                                        <option value="1707" >Испания</option>
                                                                                                        <option value="1786" >Италия</option>
                                                                                                        <option value="2163" >Камерун</option>
                                                                                                        <option value="2172" >Канада</option>
                                                                                                        <option value="582029" >Карибы</option>
                                                                                                        <option value="2297" >Кипр</option>
                                                                                                        <option value="2303" >Киргызстан</option>
                                                                                                        <option value="2374" >Китай</option>
                                                                                                        <option value="582040" >Корея</option>
                                                                                                        <option value="2430" >Коста-Рика</option>
                                                                                                        <option value="582077" >Куба</option>
                                                                                                        <option value="2443" >Кувейт</option>
                                                                                                        <option value="2448" >Латвия</option>
                                                                                                        <option value="582060" >Ливан</option>
                                                                                                        <option value="2505884" >Ливан</option>
                                                                                                        <option value="2509" >Ливия</option>
                                                                                                        <option value="2514" >Литва</option>
                                                                                                        <option value="2614" >Люксембург</option>
                                                                                                        <option value="582041" >Македония</option>
                                                                                                        <option value="277563" >Малайзия</option>
                                                                                                        <option value="582043" >Мальта</option>
                                                                                                        <option value="2617" >Мексика</option>
                                                                                                        <option value="582082" >Мозамбик</option>
                                                                                                        <option value="2788" >Молдова</option>
                                                                                                        <option value="2833" >Монако</option>
                                                                                                        <option value="2687701" >Монголия</option>
                                                                                                        <option value="582065" >Морокко</option>
                                                                                                        <option value="277551" >Нидерланды</option>
                                                                                                        <option value="2837" >Новая Зеландия</option>
                                                                                                        <option value="2880" >Норвегия</option>
                                                                                                        <option value="582051" >О.А.Э.</option>
                                                                                                        <option value="582105" >Остров Мэн</option>
                                                                                                        <option value="582044" >Пакистан</option>
                                                                                                        <option value="582046" >Перу</option>
                                                                                                        <option value="2897" >Польша</option>
                                                                                                        <option value="3141" >Португалия</option>
                                                                                                        <option value="3156" >Реюньон</option>
                                                                                                        <option value="277555" >Румыния</option>
                                                                                                        <option value="5647" >Сальвадор</option>
                                                                                                        <option value="277565" >Сингапур</option>
                                                                                                        <option value="582067" >Сирия</option>
                                                                                                        <option value="5666" >Словакия</option>
                                                                                                        <option value="5673" >Словения</option>
                                                                                                        <option value="5678" >Суринам</option>
                                                                                                        <option value="5681" >США</option>
                                                                                                        <option value="9575" >Таджикистан</option>
                                                                                                        <option value="277567" >Тайвань</option>
                                                                                                        <option value="582050" >Тайланд</option>
                                                                                                        <option value="582090" >Тунис</option>
                                                                                                        <option value="9638" >Туркменистан</option>
                                                                                                        <option value="277569" >Туркмения</option>
                                                                                                        <option value="9701" >Туркс и Кейкос</option>
                                                                                                        <option value="9705" >Турция</option>
                                                                                                        <option value="9782" >Уганда</option>
                                                                                                        <option value="9787" >Узбекистан</option>
                                                                                                        <option value="10648" >Финляндия</option>
                                                                                                        <option value="10668" >Франция</option>
                                                                                                        <option value="277553" >Хорватия</option>
                                                                                                        <option value="10874" >Чехия</option>
                                                                                                        <option value="582031" >Чили</option>
                                                                                                        <option value="10904" >Швейцария</option>
                                                                                                        <option value="10933" >Швеция</option>
                                                                                                        <option value="582064" >Эквадор</option>
                                                                                                        <option value="10968" >Эстония</option>
                                                                                                        <option value="3661568" >ЮАР</option>
                                                                                                        <option value="11002" >Югославия</option>
                                                                                                        <option value="11014" >Южная Корея</option>
                                                                                                        <option value="582106" >Ямайка</option>
                                                                                                        <option value="11060" >Япония</option>                                                           
                         </select>
                        </div>
                        <div>
                            <select id="region" name="region" class="selectb form-control">
                                <option value="">Регион</option>
                                                            </select>
                        </div>
                        <div>
                            <select id="city" name="city" class="selectb form-control">
                                <option value="">Город</option>
                                                            </select>
                        </div>
						<div>
                            <select id="types" name="types" class="selectb form-control">
                                <option value="">Положение на сайте</option>
								 <option value="need">Мне нужна помощь</option>
								  <option value="want">Хочу помощь</option>
                                                            </select>
                        </div>
                        </div>
                        <div class="close_btn_filter"></div>
                    </div>
                </div>
               
                <div class="people-frame">
                    <div id="datapost">
                    @foreach($users as $user)
	                        <a href="/user/{{$user->user_id}}" class="person">
                        <div class="person-photo" style="background-image: url(/storage/avatar/{{$user->avatar}})">
                            @if(!$user->isOnline())
                            <span class="offline status" style="background-color: #ca3d3d;" title="Офлайн"></span>
                            @else
                            <span class="status" title="Онлайн"></span>
                            @endif
                            </div>
                        <span>{{$user->name}}</span>
                    </a>
	                             @endforeach
	                              <div class="advert-pages">
	            {{ $users->links('paginate') }}
</div>
	                            </div>
	                            </div>
            </div>
        </div>

	   </div>
        
        </div>
</section>
           @push('js')
       
 @endpush
 @endsection