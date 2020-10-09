@extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')
<style>
.profile-info-p{
	font-size:16px;
}
</style>
@endpush
 
@section('content')
<script type="text/javascript" src="{{asset('asset/front/fancy_box/jquery.fancybox.js?v=2.1.5')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('asset/front/fancy_box/jquery.fancybox.css?v=2.1.5')}}" media="screen" />
 <main class="col-xs-12">
              
              
              
              <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li>
           
            <a href="/services">Объявления</a>
         
            </li><li class="active">{{$serv->title}}</li>    </ol>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#show').click(function(){
            $('#show_tel').show();
            $('#show').hide();
            return false;
        });

        // удаления услугу
        $('.del_usluga').click(function(){
            if (confirm("Удалить эту услугу?")) {
                document.location.href = "https://myldl.ru/main/del_usluga/"+$(this).attr("usluga_id");
            }
            return false;
        });
    });
</script>

<div id="showcontact">
        <h2 class="text-center">Авторизируйтесь для<br>просмотра данных</h2>
        <form action="{{route('login')}}" class="form" role="form" method="post" accept-charset="UTF-8" id="login-nav LoginForm">
		{{ csrf_field() }}
            <input name="email" type="email" class="form-control email" id="exampleInputEmail2" placeholder="| Логин / E-mail" required>
            <input name="passw" type="password" class="form-control password" id="exampleInputPassword2" placeholder="| Пароль" required>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Запомнить меня
                </label>
            </div>
            <input type="hidden" id="hashLoginID" name="ci_csrf_token" value="">
            <button type="submit" class="btn btn-success btn-block">Войти</button>
            <a class="text-center btn-reg a-btn" href="/register">Новый пользователь?</a>
        </form>
    </div>
<section>
    <div class="advert advert-inner">
        <div class="left">
            <div class="date"><span>{{ Carbon\Carbon::parse($serv->created_at)->format('d.m.Y') }}</span></div>
            <h1 class="title">{{$serv->title}}</h1>

            <div class="adv-inner-body news-inner-body searches">
                                <div class="adv-inner-right inner-100">
                    <div class="awa-226 " style="background-image: url(/storage/upload/uploads/{{$serv->getPhoto($serv->images)}});"></div>
                    <p class="profile-info-p" style="margin-bottom: 8px;"><span>Автор:</span> <a href="/user/{{$serv->user->id}}"><b>{{$serv->user->name}}</b></a></p>
                    <p class="profile-info-p" style="margin-bottom: 8px; margin-top: 0;"><span>Дата публикации:</span><b> {{ Carbon\Carbon::parse($serv->created_at)->format('d.m.Y') }}</b></p>
                    <p class="profile-info-p" style="margin-bottom: 8px;"><span>Количество просмотров:</span> <b><span id="view_c">0</span></b></p>
                    <p class="profile-info-p" style="margin-bottom: 8px;"><span>Город:</span> <b>{{$serv->city}}</b></p>
                    <p class="profile-info-p" style="margin-bottom: 8px;">Раздел: 
                                                   <?php if($serv->razdel_id==1) echo '<b>Транспорт</b>' ?>      
                                                     <?php if($serv->razdel_id==2) echo '<b>Недвижимость</b>' ?>  
													 <?php if($serv->razdel_id==3) echo '<b>Работа</b>' ?>  
													 <?php if($serv->razdel_id==4) echo '<b>Вещи</b>' ?>  
													 <?php if($serv->razdel_id==5) echo '<b>Для быта</b>' ?>  
                                                     <?php if($serv->razdel_id==6) echo '<b>Бытовая электроника</b>' ?>  
													 <?php if($serv->razdel_id==7) echo '<b>Хобби и отдых</b>' ?>  
													 <?php if($serv->razdel_id==8) echo '<b>Животные</b>' ?> 
                                                     <?php if($serv->razdel_id==8) echo '<b>Бизнес</b>' ?>  													 


												   </p>
					@if(Auth::check())
                    <p class="profile-info-p" style="margin-bottom: 8px;">Телефон:{{$serv->phone }}  <?php  if($serv->phone==null) echo('<b>не указан</b>')?></p>
				     @else
                    <p class="profile-info-p" style="margin-bottom: 8px;">Телефон:
				        @if($serv->phone==null)
							<span><b>не указан</b></span>
						@else
						
						<span>+8 .... </span><a href="#showcontact" id="write_message" class="fancybox mbtn"  ><strong>Показать</strong></a>
						@endif
						@endif
                                                        
                    <p class="profile-info-p">Цена: <?php if($serv->price==0) echo('<b>Бесплатно</b>')?> 
					                                 <?php if($serv->price!=0) echo '<b>'.$serv->price.'</b>' ?> 
					                            
                                                                                                </p>
                                    </div>
                <div class="adv-inner-desc">{{$serv->description}}</div>
                

               
            </div>
        </div>

        <div class="right">
            <span class="title">Последние объявления</span>
            <div class="advert-body">
                @foreach($services as $lserv)
	                                <div class="article-info">
                        <div class="article-subtitle">
                            <div class="date"><span>{{ Carbon\Carbon::parse($lserv->created_at)->format('d.m.Y') }}</span></div>
                            <a href="/usluga/{{$lserv->id}}">{{mb_substr($lserv->title,0,15)}}</a>
                        </div>
                    </div>
                  @endforeach
	                                
                
                                <div class="article-info">
                    <a href="/services" class="page-button">Показать еще</a>
                </div>
	                            
            </div>
        </div>

	    
<!-- ---------------- Comments ---------------- -->

<div class="adv-comments">
    <div class="title">Комментарии  <span id="display_count"></span></div>
        <br />
  <br />
  <div class="add-comment">
      <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
   @if(Auth::check())
      <div class="photo">
            <div class="ava" style="background-image: url(/storage/avatar/{{Auth::user()->person->avatar}})"></div>       
			</div>
			@else
				      <div class="photo">
            <div class="ava" style="background-image: url(/storage/avatar/noimg.png)"></div>       
			</div>
			@endif
             <form  id="comment_form">
        <div class="adv-comment wmCommentMes">
                     @guest
	                    <input type="text" class="login" name="comment_name" id="comment_name" placeholder=" Ваше имя"/>
	                    @endguest
	                    
	                    <div class="wmCommentMesBlock">
                <textarea class="input-comment"    name="comment_content" id="comment_content"    placeholder="  Коментарии ..."></textarea>
                <input type="hidden" name="comment_id" id="comment_id" value="0" />
                <input type="hidden" id="serv_id" name="serv_id" value="{{$serv->id}}"/>
            </div>
            <input type="submit" value="Комментировать" name="send_comment"/>
        </div>
        </form>
        
        
    </div>

</div>

</section>




<script>




     $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_content').focus();
 });
</script>
<script>
    $(document).ready(function() {
        
       
        countView();
        load_comment();
        viewStore();



  $('#comment_form').on('submit', function(e){
    e.preventDefault();
    var $that = $(this),
    formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    
    
    $.ajax({
        url:'/service/coment',
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
  Функция +  количесво view
  ***
    */
    
	/* 
  ***
  Функция + view
  ***
    */
  
      function viewStore(){
      var serv_id=$('#serv_id').val();
    $.ajax({
   url:"/view/store",
   method:"POST",
   
   data:{'post_id':serv_id,'type_id':'2'},
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
	
  
    function countView(){
	
   var serv_id=$('#serv_id').val();  
   
          $.ajax({
   url:"/view/count/view",
   method:"POST",
   
   data:{'post_id':serv_id,'type_id':'2'},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
	   
	
    
        $('#view_c').html(data.count);
    }
  });
    }
  
   
  
  
  
    

 function load_comment()
 {
     var serv_id=$('#serv_id').val();
  $.ajax({
   url:"/service/coment/get",
   method:"POST",
   
   data:{'serv_id':serv_id},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
	   
    $('#display_comment').html(data);
   }
  })
  $.ajax({
   url:"/service/coment/getcount",
   method:"POST",
   
   data:{'serv_id':serv_id},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
	   
    $('#display_count').html(data);
   }
  })
  
  
  
 }
        
        
        
        //Media helper. Group items, disable animations, hide arrows, enable media and button helpers.

         
        //$('#action').hide(0);
        $('#show_hide').click(function(event){
            $('#action').slideToggle('slow');
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