@extends('layouts.frontend.app')
@section('title','Главная Помощь')
<meta name="description" content="{{$st->description}}">
        <meta name="keywords" content="{{$st->keyw}}">
@push('css')

@endpush
@section('content')

            <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="https://myldl.ru/application/views/front/fancy_box/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="https://myldl.ru/application/views/front/fancy_box/jquery.fancybox.css?v=2.1.5" media="screen" />

    <div id="showcontact">
        <h2 class="text-center">Авторизируйтесь для<br>просмотра данных</h2>
        <form action="https://myldl.ru/auth/login?backurl=profile/vzaimopomoshi" class="form" role="form" method="post" accept-charset="UTF-8" id="login-nav LoginForm">
            <input name="email" type="email" class="form-control email" id="exampleInputEmail2" placeholder="| Логин / E-mail" required>
            <input name="passw" type="password" class="form-control password" id="exampleInputPassword2" placeholder="| Пароль" required>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Запомнить меня
                </label>
            </div>
            <input type="hidden" id="hashLoginID" name="ci_csrf_token" value="">
            <button type="submit" class="btn btn-success btn-block">Войти</button>
            <a class="text-center btn-reg a-btn" href="/auth/register">Новый пользователь?</a>
        </form>
    </div>
<section>
        <div class="last-section" style="float: none;">
        <a href="https://myldl.ru/users?sh=need" class="title">Мне нужна помощь</a>
        <div class="slider">
            <div class="button">
                <button id="owl-person-left-need_help"><</button>
            </div>
            <div class="slider-body">
                <div class="owl-carousel owl-theme" id="owl-person-need_help">
                              @foreach($users_need as $us_n )            
                                <div class="person">
                            <a href="/user/{{$us_n->user_id}}">
                                <div class="img" style="background-image: url(/storage/avatar/{{$us_n->avatar}})"></div>
                                <span class="job">{{$us_n->user->name}}</span>
                                <span title="Рейтинг" class="job" style="background-color: #3389bb; max-width: 20%;">0</span>
                            </a>
                            <!-- <span class="person-name"></span> -->
                        </div>
                                 @endforeach           
                                    </div>
            </div>
            <div class="button">
                <button id="owl-person-right-need_help">></button>
            </div>
        </div>
    </div>
    
   <!--mytarget-->
<div style="clear: both"></div>
<script async src="https://ad.mail.ru/static/ads-async.js"></script>
<ins class="mrg-tag" style="display:inline-block;width:320px;height:50px" data-ad-client="ad-423503" data-ad-slot="423503"></ins>  
<script>(MRGtag = window.MRGtag || []).push({})</script> 
    

    <div id="yandex_rtb_R-A-285233-1"></div>
    <script type="text/javascript">
        (function(w, d, n, s, t) {
            w[n] = w[n] || [];
            w[n].push(function() {
                Ya.Context.AdvManager.render({
                    blockId: "R-A-285233-1",
                    renderTo: "yandex_rtb_R-A-285233-1",
                    async: true
                });
            });
            t = d.getElementsByTagName("script")[0];
            s = d.createElement("script");
            s.type = "text/javascript";
            s.src = "//an.yandex.ru/system/context.js";
            s.async = true;
            t.parentNode.insertBefore(s, t);
        })(this, this.document, "yandexContextAsyncCallbacks");
    </script>

    <div class="last-section"><!-- TODO ValenokPC™-->
        <a href="https://myldl.ru/users?sh=want" class="title">Я хочу помогать</a>
        <div class="slider">
            <div class="button">
                <button id="owl-person-left-want_help"><</button>
            </div>
            <div class="slider-body">
                <div class="owl-carousel owl-theme" id="owl-person-want_help">
                      @foreach($users_wont as $us_w  )            
                                <div class="person">
                            <a href="/user/{{$us_w->user_id}}">
                                <div class="img" style="background-image: url(/storage/avatar/{{$us_w->avatar}})"></div>
                                <span class="job">{{$us_w->user->name}}</span>
                                <span title="Рейтинг" class="job" style="background-color: #3389bb; max-width: 20%;">0</span>
                            </a>
                            <!-- <span class="person-name"></span> -->
                        </div>
                                 @endforeach                   
                                     
                                          
                    </div>
            </div>
            <div class="button">
                <button id="owl-person-right-want_help">></button>
            </div>
        </div>
    </div>
	
	<div class="about-us">
        <div class="left">
            <div class="article" id="main_text">
                     {!!$st->text!!}


<p>&nbsp;</p>                <a href="/about" id="show_more">Показать текст</a>
            </div>

            <div class="article">
                <a href="/affairs" class="article-title">Дела</a>
                <div class="article-container">
                    <div class="owl-carousel owl-theme" id="owl-dela">
                        @foreach($delas as $delo)
                                            <div class="item">
                            <a class="article-container-title" href="/delo/{{$delo->id}}">
                               {{$delo->nazva}}                         </a>
                            <p>&quot;{!!  strip_tags (substr($delo->description, 0, 150))!!}......</p>
                            <span class="subspan">Бюджет: <span>{{$delo->bydzet}}</span></span>
                            <span class="subspan">Город: <span>{{$delo->city}}</span></span>
                        </div>
                                   @endforeach         
                                        </div>
                    <div class="bottom">
                        <button id="owl-dela-left">></button>
                        <button id="owl-dela-right"><</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="article">
                <a href="/poiski" class="article-title">Нужна помощь</a>
                                @foreach($help_need as $hn)
                                <div class="article-info">
                    <div class="article-subtitle">
                        <div class="date"><span>{{ Carbon\Carbon::parse($hn->created_at)->format('d.m') }}</span></div>
                        <a href="/searche/{{$hn}}" class="title">{{$hn->title}}</a>
                    </div>
                    <p>{!!  strip_tags (substr($hn->description, 0, 150))!!}...</p>
                </div>
                               
                            @endforeach 
                    <a href="/profile/vzaimopomoshi" class="mbtn">Попросить помощь</a>
                            </div>
        </div>
    </div>

    <div class="want-to-help">
        <a href="/hochu_pom" class="article-title">Хочу помочь</a>
        
        <div class="left">
                           
                             @for($i=0; $i<count($help_wont);$i++ )
                             @if($i>2)
                             @break
                           @else
                             
                                <div class="article-info">
                    <div class="article-subtitle">
                        <div class="date"><span>{{ Carbon\Carbon::parse($help_wont[$i]->created_at)->format('d.m') }}</span></div>
                        <a href="/searche/{{$help_wont[$i]}}" class="title">{{$help_wont[$i]->title}}</a>
                    </div>
                    <p>{!!  strip_tags (substr($help_wont[$i]->description, 0, 150))!!}...</p>
                </div>
                             @endif    
                            @endfor
                           
                    </div>

        <div class="right">
                           @for($i=3; $i<count($help_wont);$i++ )
                             
                                <div class="article-info">
                    <div class="article-subtitle">
                        <div class="date"><span>{{ Carbon\Carbon::parse($help_wont[$i]->created_at)->format('d.m') }}</span></div>
                        <a href="/searche/{{$help_wont[$i]}}" class="title">{{$help_wont[$i]->title}}</a>
                    </div>
                    <p>{!!  strip_tags (substr($help_wont[$i]->description, 0, 150))!!}...</p>
                </div>
                                
                            @endfor  
                            
                            
                            <a href="/profile/vzaimopomoshi" class="mbtn">Оказать помощь</a>
                    </div>
    </div>

    <div class="third-section">
        <div class="left">
            <div class="advert">
                <a href="/services" class="title">Объявления</a>
                <div class="advert-body">
                    @foreach($services as $serv)
                     <div class="article-info">
                        <div class="article-subtitle">
                            <div class="date"><span>{{ Carbon\Carbon::parse($serv->created_at)->format('d.m') }}</span></div>
                            <a href="/usluga/{{$serv->id}}" class="name">{{$serv->title}}</a>
                        </div>
                        <div class="price-info">
                            <p><span>{{$serv->price}}Р</span></p>
                             <p>Город: <span>{{$serv->city}}</span></p>
                        </div>
                    </div>
                    @endforeach
                                    </div>
            </div>

            
    <!-- ---------------- Баннер Соц. Опросов ---------------- -->

    <script type="text/javascript">
        // Отправка настройки Опроса на сервер
        function set_answer_in_server(i_type, i_obj, i_val) { return;
            // добавляем "Value" в отправляемый input
            if (i_obj != '')
                $(i_obj).val(i_val);

            if (i_type == 'multi_choice') {
                var countCh = $("#q_get_submit input:checked").length;
                if (countCh == 0)
                    return false;
            }
            if (i_type == '.yes_no') {
                return $("#q_get_submit").submit();
            }

            // Объект Информера загрузки (лоадера)
            var objL = $('.q_loader');
            var objT = $('.q_text');
            var objV = $('.q_variant');
            objL.fadeIn(800);
            objT.fadeOut(800);
            objV.fadeOut(800);

            // Преобразуем форму в массив
            var form_data = $("#q_get_submit").serialize();
            form_data['ci_csrf_token'] = $.cookie('hash_cookie_id');

            // отправим запрос на сервер
            $.ajax({
                url: $("#q_get_submit").attr('action'),
                type: 'POST', // Делаем POST запрос
                data: form_data,
                dataType: "html",
                success: function (msg) {
                    window.location.href = $('#q_get_submit').data('result');
                    return;
                    // ОШИБКА
                    if (msg == 'error') {
                        objL.html('Ошибка...');
                        objL.css({'border': '1px solid #FF8123'});
                        return;
                    }
                    // УСПЕХ
                    if (msg == 'yes') {
                        objL.html('Спасибо за ответ :)');
                        objL.css({'border': '1px solid #18EE1E'});
                        return;
                    }
                    // ДРУГОЕ
                    objL.html('Неожиданная Ошибка...');
                    return;
                }
            });
        }
    </script>
    <style>
    .survey-body {
    float: left;
    width: 100%;
    border: 2px solid #99ca3d;
    padding: 30px;
}
        .q_loader {
            display: none;
            padding: 6px 4px;
            margin: 16px 0;
            text-align: center;
            border: 1px solid #ffdd16;
            border-radius: 5px;
        }

        .qa_textarea {
            min-width: 200px;
            min-height: 60px;
            padding: 4px 6px;
            resize: none;
            border-radius: 5px;
        }

        .qa_button {
            padding: 4px 10px;
            margin: 4px 2px;
        }

        .qa_button_mini {
            padding: 2px 6px;
            margin: 4px 2px;
        }
    </style>

 
        <a href="/poll" class="title">Опрос</a>
        <form class="survey-body" id="q_get_submit" action="/answer/add/" method="post">
            @csrf
        {!!$quest!!}
          </form>

    <!-- ---------------- END Баннер Соц. Опросов ---------------- -->

            </div>
        <div class="right">
          

            <div class="news">
                <a href="/news" class="title">Новости</a>
                        @foreach($news as $ns)
                    <div class="news-article">
                        <a href="/news/item/{{$ns->id}}"" class="news-article-img">
                            <img src="{{asset('storage/help/'.$ns->image)}}"/>
                            <span>{{ Carbon\Carbon::parse($ns->created_at)->format('d.m.Y') }}</span>
                        </a>
                        <a href="/news/item/{{$ns->id}}" class="news-article-title">{!!  strip_tags (substr($ns->name, 0, 50))!!}....</a>
                        <p>{!!  strip_tags (substr($ns->description, 0, 150))!!}....</p>
                    </div>
                                    
                   @endforeach
                
            </div>
			  <div class="search-person">
                <a href="/naxodki" class="title" style="padding-bottom: 0px; border-bottom: 0px;">Ищу человека</a>
                <div class="search-person-body">
				<div class="owl-carousel owl-theme" id="owl-search-person">
                    @foreach($help_search as $hs)
                    
                                                <div class="item">
                            <a href="/searche/{{$hs->id}}" class="subtitle">{{$hs->title}}</a>
                            <p>{!!  strip_tags (substr($hs->description, 0, 150))!!}...</p>
                            <span class="subspan">Телефон: <span>{{$hs->id}}</span></span>
							@if(isset($hs->City->name))
                            <span class="subspan">Город: <span>{{$hs->City->name}}</span></span>
						@endif
                            <span class="subspan">Статус: <span>Ведутся поиски</span></span>
                        </div> 
						
                         @endforeach                       
                     </div>
                    <div class="bottom">
                        <button id="owl-search-person-left">></button>
                        <button id="owl-search-person-right"><</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

<script>
    $(document).ready(function () {
       
       $('#but_yes').click(function(){
          $('#but_answer_var3').val('variant_1');
       });
       
        $('#but_not').click(function(){
            $('#but_answer_var3').val('variant_2');
       });
    });
</script>
    <script>
        $(document).ready(function () {
            $('.fancybox').fancybox({
                'width':500,
                'height': 400,
                'autoDimensions': false,
                'autoSize':false
            });
        });
    </script>
    
       
        
        
  @push('js')
        
         @endpush

@endsection