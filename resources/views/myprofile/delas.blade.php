    @extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')
<style>
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
        <li><a href="/">Главная</a></li><li style="color: #8e8e8e;">Дела</li>    </ol>
</div><script type="text/javascript">
    $(document).ready(function(){


          $('.likebut').click(function(){
         
      var delo_id=$(this).attr('post_id');
    $.ajax({
   url:"/like/store",
   method:"POST",
   
   data:{'post_id':delo_id,'type_id':'1'},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
       
       if(data.error){
        alert(data.error)
        
       }
       else{
              
           $('#like_c'+delo_id).html(data.count);
       }
    
   }
  
  });
  
          });

 $('.dislikebut').click(function(){
         
      var delo_id=$(this).attr('post_id');
    $.ajax({
   url:"/like/store/dislike",
   method:"POST",
   
   data:{'post_id':delo_id,'type_id':'1'},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
       
       if(data.error){
        alert(data.error)
        
       }
       else{
              
           $('#dislike_c'+delo_id).html(data.count);
       }
    
   }
  
  });
  
          });




        $('select[name=country]').change(function(){
            $("#city").empty();
            $.ajax({
                type: "GET",
                url: "https://myldl.ru/main/ajax_get_city/"+$(this).val(),
                dataType: "html",
                success: function(msg){
                    $("#city").append('<option value="">Город</option>'+msg);
                }
            });
            country_id=$('select[name=country]').val(); // для підсввітки вибраної
            tip=$('select[name=tip]').val();
            if($('input[name=status]:checked').val() == "online") {
                status="online";
            } else {
                status="";
            }
            window.location.href="https://myldl.ru/affairs?country_id="+country_id+"&tip="+tip+"&status="+status;
        });


        $('select[name=city]').change(function(){
            country_id=$('select[name=country]').val(); // для підсввітки вибраної
            city_id=$(this).val();
            tip=$('select[name=tip]').val();
            status=$('select[name=status]').val();
            window.location.href="https://myldl.ru/affairs?country_id="+country_id+"&city_id="+city_id+"&tip="+tip+"&status="+status;
        });

        $('select[name=tip]').change(function(){
            country_id=$('select[name=country]').val(); // для підсввітки вибраної
            city_id=$('select[name=city]').val();
            tip=$(this).val();
            status=$('select[name=status]').val();
            window.location.href="https://myldl.ru/affairs?country_id="+country_id+"&city_id="+city_id+"&tip="+tip+"&status="+status;
        });

        $('select[name=status]').change(function(){
            country_id=$('select[name=country]').val(); // для підсввітки вибраної
            city_id=$('select[name=city]').val();
            tip=$('select[name=tip]').val();
            status=$(this).val();
            window.location.href="https://myldl.ru/affairs?country_id="+country_id+"&city_id="+city_id+"&tip="+tip+"&status="+status;
        });

        $(document).on('submit', '.search', function (e) {
            e.preventDefault();
            window.location.href = "https://myldl.ru/affairs?country_id=&city_id=&tip=&status=&serch_by_name=" + $('.ufilter').val();
        });

    });

</script>

<section>
    <div class="advert">
        <div class="left">
            <div class="people-title">
                <h1 class="titles">Дела</h1>
                <span class="status">{{$count_dela}}</span>
            </div>

            <div class="advert-body">
                <div class="advert-search-row">
                    <div class="f1">
                        <form class="search search-people">
	                                                    <input type="text" placeholder="поиск..." value="" class="ufilter"/>
                            <input type="submit" class="search-magnify" value=""/>
                        </form>
                        <div class="filter filter-people"></div>
                    </div>
                    <div class="f2">
                        <div class="filterss">
                        <div>
                            <select class="selectb ufilter selectpicker form-control" name="country">
                                <option value="">Страна</option>
		                        			                        			                                                            <option value="3159" >
				                        Россия                                    </option>
		                        			                        			                                                            <option value="9908" >
				                        Украина                                    </option>
		                        			                        			                                                            <option value="248" >
				                        Беларусь                                    </option>
		                        			                        			                                                            <option value="1894" >
				                        Казахстан                                    </option>
		                        			                        			                                                            <option value="4" >
				                        Австралия                                    </option>
		                        			                        			                                                            <option value="63" >
				                        Австрия                                    </option>
		                        			                        			                                                            <option value="81" >
				                        Азербайджан                                    </option>
		                        			                        			                                                            <option value="173" >
				                        Ангуилья                                    </option>
		                        			                        			                                                            <option value="177" >
				                        Аргентина                                    </option>
		                        			                        			                                                            <option value="245" >
				                        Армения                                    </option>
		                        			                        			                                                            <option value="7716093" >
				                        Арулько                                    </option>
		                        			                        			                                                            <option value="401" >
				                        Белиз                                    </option>
		                        			                        			                                                            <option value="404" >
				                        Бельгия                                    </option>
		                        			                        			                                                            <option value="425" >
				                        Бермуды                                    </option>
		                        			                        			                                                            <option value="428" >
				                        Болгария                                    </option>
		                        			                        			                                                            <option value="467" >
				                        Бразилия                                    </option>
		                        			                        			                                                            <option value="616" >
				                        Великобритания                                    </option>
		                        			                        			                                                            <option value="924" >
				                        Венгрия                                    </option>
		                        			                        			                                                            <option value="971" >
				                        Вьетнам                                    </option>
		                        			                        			                                                            <option value="994" >
				                        Гаити                                    </option>
		                        			                        			                                                            <option value="1007" >
				                        Гваделупа                                    </option>
		                        			                        			                                                            <option value="1012" >
				                        Германия                                    </option>
		                        			                        			                                                            <option value="1206" >
				                        Голландия                                    </option>
		                        			                        			                                                            <option value="2567393" >
				                        Гондурас                                    </option>
		                        			                        			                                                            <option value="277557" >
				                        Гонконг                                    </option>
		                        			                        			                                                            <option value="1258" >
				                        Греция                                    </option>
		                        			                        			                                                            <option value="1280" >
				                        Грузия                                    </option>
		                        			                        			                                                            <option value="1366" >
				                        Дания                                    </option>
		                        			                        			                                                            <option value="2577958" >
				                        Доминиканская республика                                    </option>
		                        			                        			                                                            <option value="1380" >
				                        Египет                                    </option>
		                        			                        			                                                            <option value="1393" >
				                        Израиль                                    </option>
		                        			                        			                                                            <option value="1451" >
				                        Индия                                    </option>
		                        			                        			                                                            <option value="277559" >
				                        Индонезия                                    </option>
		                        			                        			                                                            <option value="277561" >
				                        Иордания                                    </option>
		                        			                        			                                                            <option value="3410238" >
				                        Ирак                                    </option>
		                        			                        			                                                            <option value="1663" >
				                        Иран                                    </option>
		                        			                        			                                                            <option value="1696" >
				                        Ирландия                                    </option>
		                        			                        			                                                            <option value="1707" >
				                        Испания                                    </option>
		                        			                        			                                                            <option value="1786" >
				                        Италия                                    </option>
		                        			                        			                                                            <option value="2163" >
				                        Камерун                                    </option>
		                        			                        			                                                            <option value="2172" >
				                        Канада                                    </option>
		                        			                        			                                                            <option value="582029" >
				                        Карибы                                    </option>
		                        			                        			                                                            <option value="2297" >
				                        Кипр                                    </option>
		                        			                        			                                                            <option value="2303" >
				                        Киргызстан                                    </option>
		                        			                        			                                                            <option value="2374" >
				                        Китай                                    </option>
		                        			                        			                                                            <option value="582040" >
				                        Корея                                    </option>
		                        			                        			                                                            <option value="2430" >
				                        Коста-Рика                                    </option>
		                        			                        			                                                            <option value="582077" >
				                        Куба                                    </option>
		                        			                        			                                                            <option value="2443" >
				                        Кувейт                                    </option>
		                        			                        			                                                            <option value="2448" >
				                        Латвия                                    </option>
		                        			                        			                                                            <option value="582060" >
				                        Ливан                                    </option>
		                        			                        			                                                            <option value="2505884" >
				                        Ливан                                    </option>
		                        			                        			                                                            <option value="2509" >
				                        Ливия                                    </option>
		                        			                        			                                                            <option value="2514" >
				                        Литва                                    </option>
		                        			                        			                                                            <option value="2614" >
				                        Люксембург                                    </option>
		                        			                        			                                                            <option value="582041" >
				                        Македония                                    </option>
		                        			                        			                                                            <option value="277563" >
				                        Малайзия                                    </option>
		                        			                        			                                                            <option value="582043" >
				                        Мальта                                    </option>
		                        			                        			                                                            <option value="2617" >
				                        Мексика                                    </option>
		                        			                        			                                                            <option value="582082" >
				                        Мозамбик                                    </option>
		                        			                        			                                                            <option value="2788" >
				                        Молдова                                    </option>
		                        			                        			                                                            <option value="2833" >
				                        Монако                                    </option>
		                        			                        			                                                            <option value="2687701" >
				                        Монголия                                    </option>
		                        			                        			                                                            <option value="582065" >
				                        Морокко                                    </option>
		                        			                        			                                                            <option value="277551" >
				                        Нидерланды                                    </option>
		                        			                        			                                                            <option value="2837" >
				                        Новая Зеландия                                    </option>
		                        			                        			                                                            <option value="2880" >
				                        Норвегия                                    </option>
		                        			                        			                                                            <option value="582051" >
				                        О.А.Э.                                    </option>
		                        			                        			                                                            <option value="582105" >
				                        Остров Мэн                                    </option>
		                        			                        			                                                            <option value="582044" >
				                        Пакистан                                    </option>
		                        			                        			                                                            <option value="582046" >
				                        Перу                                    </option>
		                        			                        			                                                            <option value="2897" >
				                        Польша                                    </option>
		                        			                        			                                                            <option value="3141" >
				                        Португалия                                    </option>
		                        			                        			                                                            <option value="3156" >
				                        Реюньон                                    </option>
		                        			                        			                                                            <option value="277555" >
				                        Румыния                                    </option>
		                        			                        			                                                            <option value="5647" >
				                        Сальвадор                                    </option>
		                        			                        			                                                            <option value="277565" >
				                        Сингапур                                    </option>
		                        			                        			                                                            <option value="582067" >
				                        Сирия                                    </option>
		                        			                        			                                                            <option value="5666" >
				                        Словакия                                    </option>
		                        			                        			                                                            <option value="5673" >
				                        Словения                                    </option>
		                        			                        			                                                            <option value="5678" >
				                        Суринам                                    </option>
		                        			                        			                                                            <option value="5681" >
				                        США                                    </option>
		                        			                        			                                                            <option value="9575" >
				                        Таджикистан                                    </option>
		                        			                        			                                                            <option value="277567" >
				                        Тайвань                                    </option>
		                        			                        			                                                            <option value="582050" >
				                        Тайланд                                    </option>
		                        			                        			                                                            <option value="582090" >
				                        Тунис                                    </option>
		                        			                        			                                                            <option value="9638" >
				                        Туркменистан                                    </option>
		                        			                        			                                                            <option value="277569" >
				                        Туркмения                                    </option>
		                        			                        			                                                            <option value="9701" >
				                        Туркс и Кейкос                                    </option>
		                        			                        			                                                            <option value="9705" >
				                        Турция                                    </option>
		                        			                        			                                                            <option value="9782" >
				                        Уганда                                    </option>
		                        			                        			                                                            <option value="9787" >
				                        Узбекистан                                    </option>
		                        			                        			                                                            <option value="10648" >
				                        Финляндия                                    </option>
		                        			                        			                                                            <option value="10668" >
				                        Франция                                    </option>
		                        			                        			                                                            <option value="277553" >
				                        Хорватия                                    </option>
		                        			                        			                                                            <option value="10874" >
				                        Чехия                                    </option>
		                        			                        			                                                            <option value="582031" >
				                        Чили                                    </option>
		                        			                        			                                                            <option value="10904" >
				                        Швейцария                                    </option>
		                        			                        			                                                            <option value="10933" >
				                        Швеция                                    </option>
		                        			                        			                                                            <option value="582064" >
				                        Эквадор                                    </option>
		                        			                        			                                                            <option value="10968" >
				                        Эстония                                    </option>
		                        			                        			                                                            <option value="3661568" >
				                        ЮАР                                    </option>
		                        			                        			                                                            <option value="11002" >
				                        Югославия                                    </option>
		                        			                        			                                                            <option value="11014" >
				                        Южная Корея                                    </option>
		                        			                        			                                                            <option value="582106" >
				                        Ямайка                                    </option>
		                        			                        			                                                            <option value="11060" >
				                        Япония                                    </option>
		                                                    </select>
                        </div>
                        <div>
                            <select class="selectb ufilter selectpicker form-control" name="city">
                                <option value="">Город</option>
		                                                    </select>
                        </div>
                        <div>
                            <select class="selectb ufilter selectpicker form-control" name="tip">
                                <option value="">Масштаб</option>
                                <option value="1" >индивидуальный</option>
                                <option value="2" >коллективный</option>
                            </select>
                        </div>
                        <div>
                            <select class="selectb ufilter selectpicker form-control" name="status">
                                <option value="">Статус</option>
                                <option value="1" >Открытые</option>
                                <option value="0" >Закрытые</option>
                            </select>
                        </div>
                        </div>
                        <div class="close"></div>
                    </div>
                </div>

                <!--<div class="deal-settings affair-heading">
                    <div class="left-set">
                        <div class="span">
                            <span>Описание дела</span>
                            <div class="arrows">
                                <img src="https://myldl.ru/static/images/arrow-up.png"/>
                                <img src="https://myldl.ru/static/images/arrow-down.png"/>
                            </div>
                        </div>
                    </div>

                    <div class="right-set">
                        <div class="span" style="margin-right: 15px;">
                            <span>Кол-во комментариев</span>
                            <div class="arrows">
                                <img src="https://myldl.ru/static/images/arrow-up.png"/>
                                <img src="https://myldl.ru/static/images/arrow-down.png"/>
                            </div>
                        </div>
                        <div class="span">
                            <span>Кол-во участников</span>
                            <div class="arrows">
                                <img src="https://myldl.ru/static/images/arrow-up.png"/>
                                <img src="https://myldl.ru/static/images/arrow-down.png"/>
                            </div>
                        </div>
                    </div>
                </div>-->
                  @foreach($delas as $delo)
	         
                <div class="advert-row">
                    <div class="date"><span>{{ Carbon\Carbon::parse($delo->created_at)->format('d.m') }}</span></div>
                        <a class="advert-row-body-title show-xs" href="https://myldl.ru/delo/104">{{$delo->nazva}}</a>

                    <div class="advert-row-body deal-row-body show-xs">
                    </div>
                    <div class="image show-xs" >
                                                    <img class="center-block" src="{{asset('storage/delo/'.$delo->images)}}" alt="" style="margin-left: auto; margin-right: auto;"/>
                                            </div>

                    <div class="image hide-xs">
					@if($delo->images!=null)
						<?php $img = strstr($delo->images, ',', true)?>
					    @if($img==null)
                           <img class="center-block" src="{{asset('storage/upload/uploads/'.$delo->images)}}" alt="" />
					      @else
							<img class="center-block" src="{{asset('storage/upload/uploads/'.$img)}}" alt="" />  
					     @endif
					   @else
						    <img class="center-block" src="{{asset('storage/delo/noimg.png')}}" alt="" />
					   @endif
                                            </div>

                    <div class="advert-row-body deal-row-body">
                        <a class="advert-row-body-title hide-xs" href={{'/delo/'.$delo->id}}>{{$delo->nazva}}</a>
                        <p class="adv-info hide-xs">{!!substr($delo->opisanie, 0, 150)!!}</p>
                    </div>
                    
                    <div class="deal-row-body2">
                        <div class="members">
                            <span class="member">Участников:</span>
                            <span class="member-quantity">3</span>
                        </div>
                        <div class="status-open">@if($delo->status==0)
                                            Закрыто
                                            @else
                                            Открыто
                                            @endif
                        </div>
                    </div>

                    <div class="advert-row-body deal-row-body  show-xs">
                        <p class="adv-info">&quot;Мы все обычные мамы, но для своих детей мы - смысл жизни! Меня зовут Наталья. Я мама чудесного и любимого мальчика - Демида. Такое редкое имя да...</p>
                    </div>

                    <div class="type-of-deal">
                        <p>Тип: <a>@if($delo->vhod_v_delo==1)
                        Индивидуальное
                        @else
                        Коллективное
                        @endif
                        </a></p>
                    </div>
                    
                    <div class="deal-views">
	                    
<img src="{{asset('asset/front/images/like.png')}}" class="stat-item thumbs-up likebut" section_id="12" post_id="{{$delo->id}}"/>
<span id="like_c{{$delo->id}}">{{$delo->likeCount($delo->id)}}</span>
<img src="{{asset('asset/front/images/like.png')}}" class="stat-item thumbs-down dislikebut" section_id="12" post_id="{{$delo->id}}"/>
<span id="dislike_c{{$delo->id}}">{{$delo->dislikeCount($delo->id)}}</span>                        
                        <img src="{{asset('asset/front/images/comments.png')}}"/>
                        <span>{{$delo->getCount($delo->id)}}</span>
                    </div>

                </div>
	                            <!-- _____________________________________________________________________________________________ -->
                @endforeach
<div class="advert-pages">	            
	            
{{ $delas->links('paginate') }}


</div>
	                       </div>
        </div>

         <div class="right">
            <span class="title">Последние дела</span>
            <div class="advert-body">
                
                @foreach($delas as $delo)
                
                
                
                <div class="article-info">
                        <div class="article-subtitle">
                            <div class="date"><span>{{ Carbon\Carbon::parse($delo->created_at)->format('d.m') }}</span></div>
                            <a href="{{route('delo.get',$delo->id)}}">{{substr($delo->nazva, 0, 66)}}..</a>
                        </div>
                    </div>
                
                
                @endforeach
	                               
	                            <div class="article-info">
                   
                </div>
            </div>
        </div>
    </div>
</section>
              
              
            @push('js')
        
         @endpush

@endsection