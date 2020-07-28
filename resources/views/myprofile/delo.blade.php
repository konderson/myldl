    @extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')
<style>
    
    .btn_rep {
    background-color:#89bc28;
        display: inline-block;
cursor: pointer;
padding: 5px 10px;
background-color: #99ca3d;
color: #fff;
font-size: 13px;
font-weight: 700;
letter-spacing: 0.1px;
text-transform: uppercase;
margin-bottom: 5px;
margin-right: 5px;
border: 0px;
transition: .3s;
    }
</style>
@endpush
@section('content')
          <main class="col-xs-12">
              
              <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li><a href="/affairs">Дела</a></li><li class="active">{{$delo->nazva}}</li>    </ol>
</div><!-- діалог -->
<link href="{{asset('asset/front/datepicker/jquery-ui.css')}}" rel="stylesheet">
<script src="{{asset('asset/front/datepicker/jquery-ui.js')}}"></script>
<!-- діалог end -->

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="{{asset('asset/front/fancy_box/jquery.fancybox.js?v=2.1.5')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('asset/front/fancy_box/jquery.fancybox.css?v=2.1.5')}}" media="screen" />


<script>




     $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_content').focus();
 });
</script>
<script>
    $(document).ready(function() {
        
        viewStore();
        countLike(); 
        countDisLike();
        load_comment();
		countView();
        



  $('#comment_form').on('submit', function(e){
    e.preventDefault();
    var $that = $(this),
    formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    
    
    $.ajax({
        url:'/test/coment',
      type: 'POST', 
      contentType: false, // важно - убираем форматирование данных по умолчанию
      processData: false, // важно - убираем преобразование строк по умолчанию
   
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        data: formData,
      success: function(data){
        if($.isEmptyObject(data.errors)){
           $('#comment_form')[0].reset();
           $('#comment_id').val('0');
             load_comment();
  
                    }else{
                       

     alert('Произошла ошибка')

                    }
      },
       
    });
    
   


  });

/* 
  ***
  Функция +  количесво like
  ***
    */
  
  
    function countLike(){
   var delo_id=$('#delo_id').val();  
   
          $.ajax({
   url:"/like/count/like",
   method:"POST",
   
   data:{'post_id':delo_id,'type_id':'1'},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
    
        $('#like_c').html(data.count);
    }
  });
    }
  
  /* 
  ***
 Конец Функция количество + like
  ***
    */
	
	
	
	/* 
  ***
  Функция +  количесво view
  ***
    */
  
  
    function countView(){
   var delo_id=$('#delo_id').val();  
   
          $.ajax({
   url:"/view/count/view",
   method:"POST",
   
   data:{'post_id':delo_id,'type_id':'1'},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
    
        $('#view_c').html(data.count);
    }
  });
    }
  
  /* 
  ***
 Конец Функция количество + like
  ***
    */
  
    
    
    /* 
  ***
  Функция +  количесво like
  ***
    */
  
  
    function countDisLike(){
   var delo_id=$('#delo_id').val();     
          $.ajax({
   url:"/like/count/dis",
   method:"POST",
   
   data:{'post_id':delo_id,'type_id':'1'},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
    
        $('#dislike_c').html(data.count);
    }
  });
    }
  
  /* 
  ***
 Конец Функция количество + like
  ***
    */
    
    
    
    
    
  /* 
  ***
  Функция + like
  ***
    */
  
  $('#like').click(function(){
      var delo_id=$('#delo_id').val();
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
              
           $('#like_c').html(data.count);
       }
    
   }
  })
  });
  
/* 
  ***
  Конец Функция + like
  ***
    */
    
    
    
    /* 
  ***
  Функция + dis like
  ***
    */
  
  $('#dislike').click(function(){
      var delo_id=$('#delo_id').val();
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
              
           $('#dislike_c').html(data.count);
       }
    
   }
  })
  });
  
/* 
  ***
  Конец Функция + dis  like
  ***
    */
    
    
	/* 
  ***
  Функция + view
  ***
    */
  
      function viewStore(){
      var delo_id=$('#delo_id').val();
    $.ajax({
   url:"/view/store",
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
              
           $('#view_c').html(data.count);
       }
    
   }
  })
  };
	
	/* 
  ***
  Конец Функция + dis  like
  ***
    */
	
	
	
	

 function load_comment()
 {
     var delo_id=$('#delo_id').val();
  $.ajax({
   url:"/test/coment/get",
   method:"POST",
   
   data:{'delo_id':delo_id},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
  $.ajax({
   url:"/test/coment/getcount",
   method:"POST",
   
   data:{'delo_id':delo_id},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
    $('#display_count').html(data);
   }
  })
  
  
  
 }
        
        
        $('.fancybox').fancybox();
        //Media helper. Group items, disable animations, hide arrows, enable media and button helpers.

         $('.fancybox-media').attr('rel', 'media-gallery').fancybox({
             openEffect : 'none',
             closeEffect : 'none',
             prevEffect : 'none',
             nextEffect : 'none',
             arrows : false,
             helpers : {
             media : {},
             buttons : {}
             }
         });

        //$('#action').hide(0);
        $('#show_hide').click(function(event){
            $('#action').slideToggle('slow');
        });

        $('.del').click(function(){
            $.ajax({
                type:"POST",
                url: "/main/ajax_del_uchasnik_delo",
                data: {
                    delo_id : delo_id,
                    user:$(this).attr('user_id'),
                    tkn_name : $.cookie(tkn_val)
                },
                dataType: "html",
                success: function(msg){
                    alert(msg);
                    location.reload(0);
                }
            });
            return false;
        });

        // удаления запрашиваемое Дело
        $('.del_delo').click(function(){
            if (confirm("Удалить это дело?")) {
                document.location.href = "/main/del_delo/"+$(this).attr("delo_id");
            }
            return false;
        });

    });
</script>

<div id="dialog2" title="Пожаловаться на дело" style="display: none">
    Вы можете отправить администратору жалобу на дело :<br /><br />
    <div class="row">
        <label>Текст жалобы</label>
        <textarea id="text_appeal"></textarea>
		
    </div>
    <div class="btn-group">
        <button type="button" class="btn add btn-green">Отправить</button>
        <a class="a-btn" onclick="$.fancybox.close();">Закрыть</a>
    </div>
</div>
<script>
    $('#dialog2 button').click(function () {
        var delo_id=$('#delo_id').val();
		var text=$("#text_appeal").val();
    $.ajax({
   url:"/appeal/add",
   method:"POST",
   
   data:{'delo_id':delo_id,'text':text,'type':1},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            dataType: "html",
			success: function(msg){
				
                  $('#dialog2').html("<center><br /><br /><h3>Ваша жалоба отправлена администратору !</h3><br /><br /></center>");
        setTimeout(function() {
            $.fancybox.close();
            location.reload(0);
        },
        800);  
                }
       
    })
	});
</script>
<div id="dialog3" title="Стать учасником" style="display: none">
    Вы хотите стать участником данного дела?<br /><br />
    <div class="btn-group">
        <button type="button" class="btn add btn-green">Да</button>
        <a class="a-btn" onclick="$.fancybox.close();">Нет</a>
    </div>
</div>
<script>
    $('#dialog3 button').click(function () {
        $.ajax({
            type: "POST",
            url: "/main/ajax_stat_uchasnikom_delo",
            data: {
                delo_id : delo_id,
                tkn_name : $.cookie(tkn_val)
            },
            dataType: "html",
            success: function(msg){
                if(msg=="ok") {
                    $('#dialog3').html("<center><br /><br /><h3>Вы добавлены как участник !</h3><br /><br /></center>");
                }
                if(msg=="error") {
                    $('#dialog3').html("<center><br /><br /><h3>Вы уже являетесь участником этого дела !</h3><br /><br /></center>");
                }
                if(msg=="auth") {
                    $('#dialog3').html("<center><br /><br /><h3>Войдите на сайт под своей учетной записью !</h3><br /><br /></center>");
                }
            }
        });
        setTimeout(function() {
            $.fancybox.close();
            location.reload(0);
        },
        800);
    });
</script>
<div id="dialog4" title="Избранное" style="display: none">
    Добавить это дело в избранные дела?<br /><br />
    <div class="btn-group">
        <button type="button" class="btn add btn-green">Да</button>
        <a class="a-btn" onclick="$.fancybox.close();">Нет</a>
    </div>
</div>
<script>
    $('#dialog4 button').click(function () {
         var delo_id=$('#delo_id').val();
    $.ajax({
   url:"/profile/izbranniye_dela/add",
   method:"POST",
   
   data:{'delo_id':delo_id},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            dataType: "html",
            success: function(msg){
                if(msg=="ok") {
                    $('#dialog4').html("<center><br /><br /><h3>Дело добавлено в избранное !</h3><br /><br /></center>");
                }
                if(msg=="error") {
                    $('#dialog4').html("<center><br /><br /><h3>Это дело уже в избранном !</h3><br /><br /></center>");
                }
                if(msg=="auth") {
                    $('#dialog4').html("<center><br /><br /><h3>Войдите на сайт под своей учетной записью !</h3><br /><br /></center>");
                }
            }
        });
        
    });
</script>
<div id="dialog5" title="Стать учасником" style="display: none">
    Для индивидуального дела не предполагается участие других людей<br /><br />
</div>
<script type="text/javascript">
    var delo_id = '27';
    var tkn_name = 'ci_csrf_token';
    var tkn_val  = 'hash_cookie_id';
</script>

<section>
    <div class="advert advert-inner">
        <div class="left">
            <div class="date"><span>{{ Carbon\Carbon::parse($delo->created_at)->format('d.m.Y') }}</span></div>
            <div class="title">
                <h1>{{$delo->nazva}}</h1>
            </div>

            <div class="adv-inner-body news-inner-body">
	                            <div class="adv-inner-left inner-100">
                    <div class="awa-226 bg" style="background-image: url(/asset/front/images/noimg.png);"></div>
                    <div class="deal-become-member show-xs">
                                                    <a href="#dialog5" data-height="160" class="fancybox mbtn to_relation green" style="font-size:14px;">Стать участником</a>
                            <a href="#dialog4" class="fancybox mbtn" data-width="363" data-height="150" style="font-size:14px;">В избранное</a>
                                                <a href="#dialog2" class="fancybox mbtn" style="font-size:14px;">Пожаловаться</a>
                    </div>

                    <div class="profile-info" style="float: left;">
                        <p><b>Инициатор</b>: <a href="/user/{{$delo->userOne->id}}">{{$delo->userOne->name}}</a></p>
                        <p><b>Дата открытия</b>: <span>{{ Carbon\Carbon::parse($delo->created_at)->format('d.m.Y') }}</span></p>
                        <p class="profile-info-p"><b>Тип</b>:{{$delo->status==1?'Индивидуальное':'Коллективное'}}</p>
                        <p><b>Текущий статус</b>:{{$delo->status==0?'Закрыто':'Открыто'}} <span></span></p>
                    </div>
                    <style>
                        .profile-info>p {
                            margin-bottom: 8px;
                            margin-top: 0;
                        }
                        .profile-info {
                            width: 100%;
                        }
                        @media (min-width: 470px) {
                            .profile-info {
                                width: calc(100% - 246px);
                            }
                        }
                        @media (max-width: 919px) {
                            section .advert-inner .left .news-inner-body .deal-become-member {
                                float: left;
                            }
                        }
                        @media (min-width: 920px) {
                            .profile-info {
                                width: calc(100% - 406px);
                            }
                        }
                    </style>
                @if(Auth::check())
                    <div class="deal-become-member hide-xs">
		                                            <a href="#dialog5" data-height="160" class="fancybox mbtn to_relation green" style="font-size:14px;">Стать участником</a>
                            <a href="#dialog4" class="fancybox mbtn" data-width="363" data-height="150" style="font-size:14px;">В избранное</a>
		                                        <a href="#dialog2" class="fancybox mbtn">Пожаловаться</a>
                    </div>
					@endif
                </div>

                <div class="adv-inner-desc">
                    <div class="profile-info2" style="margin-top: 0">
                        <p><b>Город</b>: <span>{{$delo->city}}</span></p>
                        <p><b>Бюджет</b>:{{$delo->bydzet}} <span></span></p>
                        <p><b>Затраченное время</b>: <span>{{$delo->vremya}}</span></p>
                    </div>
                    <b style="font-size: 16px">Описание</b>: {{$delo->opisanie}}
                    <div class="profile-info2">
                        <p><b>Участники</b>: <span>{{$delo->user->count()}}</span></p>
                        <p><b>Эффект</b>: <span>{{$delo->effekt}}</span></p>
                        <p><b>Для чего это делалось</b>: {{$delo->dlya_chego}}<span></span></p>
                                            </div>
                    <style>
                        section .advert-inner .left .adv-inner-body .adv-inner-desc .profile-info2 {
                            margin-top: 30px;
                        }
                        section .advert-inner .left .adv-inner-body .adv-inner-desc .profile-info2 p {
                            font-size: 16px;
                            margin-bottom: 0;
                        }
                    </style>
                </div>

                <div class="news-views" style="margin-top: 25px;">
	                
<img src="{{asset('asset/front/images/like.png')}}" class="stat-item thumbs-up " id="like"/>
<span class="like_c" id="like_c"></span>
<img src="{{asset('asset/front/images/dislike.png')}}" class="stat-item thumbs-down"  id="dislike" />
<span class="dislike_c" id='dislike_c'></span>                    <img src="{{asset('asset/front/images/comments.png')}}"/>
                    <span>{{$delo->getCount($delo->id)}}</span>
                    <img src="{{asset('asset/front/images/views.png')}}"/>
                    <span id="view_c" >0</span>
                </div>
            </div>
            <div class="info-block">
                <p><span>Фото:</span> 3</p>
		                             <!-- 3 -->
                    <div class="row container-fluid">
                        <div class="images clearfix">
                            <ul class="gallery">
						        							                                                <li>
                                            <a href="https://myldl.ru/images/uploads/ddba56784eb3987a2e1ce3730a794862.jpg" rel="gallery1" class="fancybox  awa awa-201 awa-full" style="background-image: url(https://myldl.ru/images/uploads/ddba56784eb3987a2e1ce3730a794862.jpg)"></a>
                                        </li>
							                                                <li>
                                            <a href="https://myldl.ru/images/uploads/b410307d59bb5972bf1e8eedb5a3a927.jpg" rel="gallery1" class="fancybox  awa awa-201 awa-full" style="background-image: url(https://myldl.ru/images/uploads/b410307d59bb5972bf1e8eedb5a3a927.jpg)"></a>
                                        </li>
							                                                <li>
                                            <a href="https://myldl.ru/images/uploads/428e7f9c73347968cd05a655aa5d1d6a.jpg" rel="gallery1" class="fancybox  awa awa-201 awa-full" style="background-image: url(https://myldl.ru/images/uploads/428e7f9c73347968cd05a655aa5d1d6a.jpg)"></a>
                                        </li>
							        						                                    </ul>
                        </div>
                    </div>
		                        <p><span>Видео:</span> 0</p>
                <div class="row container-fluid">
                    <div class="video clearfix">
                        <ul class="gallery">
					        						        					                                </ul>
                    </div>
                </div>
            </div>
        

        </div>

        <div class="right">
            <span class="title">Последние дела</span>
            <div class="advert-body">
                
                @foreach($delas as $delolast)
                
                
                
                <div class="article-info">
                        <div class="article-subtitle">
                            <div class="date"><span>{{ Carbon\Carbon::parse($delolast->created_at)->format('d.m') }}</span></div>
                            <a href="{{route('delo.get',$delolast->id)}}">{{substr($delolast->nazva, 0, 66)}}..</a>
                        </div>
                    </div>
                
                
                @endforeach
	                               
	                            <div class="article-info">
                    <a href="/affairs" class="page-button">Показать еще</a>
                </div>
            </div>
        </div>

        <div class="adv-comments last-section" style="margin-bottom: 25px;">
            <span class="title">Участники {{$delo->user->count()}}</span>
            <div class="slider">
                <div class="button">
                    <button id="owl-uchasniki-left"><</button>
                </div>
                <div class="slider-body">
                    <div class="owl-carousel owl-theme" id="owl-uchasniki">
	                                       @foreach($delo->user as $user)
	                                        <div class="person">
	                                            @if(isset($user->person->avatar))
                                                            <img src="{{asset('/storage/avatar/'.$user->person->avatar)}}"/>
                                                            @endif
                                                        <a href="/user/{{$user->id}}" class="person-name">{{$user->name}}</a>
                        </div>
                        @endforeach
                        
	                                    </div>
                </div>
                <div class="button">
                    <button id="owl-uchasniki-right">></button>
                </div>
            </div>
        </div>

	    
<!-- ---------------- Comments ---------------- -->









<div class="adv-comments">
    <div class="title">Комментарии <span id="display_count"></span></div>
        <br />
  <br />
  <div class="add-comment">
      <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
      <div class="photo">
            <div class="ava" style="background-image: url(/asset/front/images/noimg.png)"></div>        </div>
             <form  id="comment_form">
        <div class="adv-comment wmCommentMes">
                     @guest
	                    <input type="text" class="login" name="comment_name" id="comment_name" placeholder=" Ваше имя"/>
	                    @endguest
	                    
	                    <div class="wmCommentMesBlock">
                <textarea class="input-comment"    name="comment_content" id="comment_content"    placeholder="  Коментарии ..."></textarea>
                <input type="hidden" name="comment_id" id="comment_id" value="0" />
                <input type="hidden" id="delo_id" name="delo_id" value="{{$delo->id}}"/>
            </div>
            <input type="submit" value="Комментировать" name="send_comment"/>
        </div>
        </form>
        
        
    </div>
      
  
  
  
  
  
  


        
        
        
        
        
           </div>
</section>
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