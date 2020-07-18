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
        <li><a href="/">Главная</a></li><li>
            @if($help->type==1)
            <a href="/hochu_pom">Хочу помочь</a>
            @endif
              @if($help->type==2)
            <a href="/poiski">Нужна помощь</a>
            @endif
            @if($help->type==3)
            <a href="/naxodki">Ищу человека</a>
            @endif
            </li><li class="active">{{$help->title}}</li>    </ol>
</div><script type="text/javascript" src="{{asset('asset/front/js/jquery.fancybox.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('asset/front/js/jquery.fancybox.min.css')}}" media="screen" />

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
                document.location.href = "/del_usluga/"+$(this).attr("usluga_id");
            }
            return false;
        });
    });
</script>


<section>
    <div class="advert advert-inner">
        <div class="left">
            <div class="date"><span>{{ Carbon\Carbon::parse($help->created_at)->format('d.m.Y') }}</span></div>
            <h1 class="title">{{$help->title}}</h1>

            <div class="adv-inner-body news-inner-body searches">
                                <div class="adv-inner-right inner-100">
                    <div class="awa-226 " style="background-image: url(/storage/help/{{$help->images}});"></div>
                    <p class="profile-info-p" style="margin-bottom: 8px; margin-top: 0;"><span>Дата публикации:</span> {{ Carbon\Carbon::parse($help->created_at)->format('d.m.Y') }}</p>
                    <p class="profile-info-p" style="margin-bottom: 8px;"><span>Количество просмотров:</span> <span id="view_c">9</span></p>
                    <p class="profile-info-p" style="margin-bottom: 8px;"><span>Автор:</span> <a href="/user/{{$help->user->id}}">{{$help->user->name}}</a></p>
                    <p class="profile-info-p" style="margin-bottom: 8px;"><span>Город:</span> {{$help->city}}</p>
                    <p class="profile-info-p" style="margin-bottom: 8px;">E-mail: ...
                                                    {{$help->email}}                     </p>
                    <p class="profile-info-p" style="margin-bottom: 8px;">Телефон: ...
                                                    {{$help->phone}}                                           </p>
                    <p class="profile-info-p">Соц.сети: ... {{$help->cocial}}
                                                                                                </p>
                                    </div>
                <div class="adv-inner-desc">{{$help->description}}</div>
                <ul class="gallery">
                                            <li>
                            <a
                                class="fancybox2 awa awa-201 awa-full"
                                href=""
                                rel="gallery1"
                                data-fancybox-group="gallery"
                                data-fancybox="gallery"
                                style="background-image: url(/storage/help/{{$help->images}});"></a>
                        </li>
                                    </ul>

                <ul class="soc-links">
                    <li>
                        <a onclick="window.open('https://connect.mail.ru/share?url=/','sharer','toolbar=0,status=0,width=700,height=400');" href="javascript: void(0)">
                            <img src="{{asset('asset/front/images/mailru.png')}}" alt="socials">
                        </a>
                    </li>
                    <li>
                        <a onclick="window.open('https://ok.ru/dk?st.cmd=addShare&amp;st.s=1&amp;st._surl=/','sharer','toolbar=0,status=0,width=700,height=400');" href="javascript: void(0)">
                            <img src="{{asset('asset/front/images/ok.png')}}" alt="socials">
                        </a>
                    </li>
                    <li>
                        <a onclick="window.open('https://vkontakte.ru/share.php?url=/','sharer','toolbar=0,status=0,width=700,height=400');" href="javascript: void(0)">
                            <img src="{{asset('asset/front/images/vk2.png')}}" alt="socials">
                        </a>
                    </li>
                    <li>
                        <a onclick="window.open('https://twitter.com/intent/tweet?text=Люди для людей /','sharer','toolbar=0,status=0,width=700,height=400');" href="javascript: void(0)">
                            <img src="{{asset('asset/front/images/twit.png')}}" alt="socials">
                        </a>
                    </li>
                    <li>
                        <a onclick="window.open('https://plus.google.com/share?url=/','sharer','toolbar=0,status=0,width=700,height=400');" href="javascript: void(0)">
                            <img src="{{asset('asset/front/images/goog.png')}}" alt="socials">
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="right">
            <span class="title">Нужна помощь</span>
            <div class="advert-body">
                @foreach($helps as $lhelp)
	                                <div class="article-info">
                        <div class="article-subtitle">
                            <div class="date"><span>{{ Carbon\Carbon::parse($lhelp->created_at)->format('d.m.Y') }}</span></div>
                            <a href="/searche/{{$lhelp->id}}">{{$lhelp->title}}</a>
                        </div>
                    </div>
                  @endforeach
	                                
                
	                            <div class="article-info">
                    <a href="/poiski" class="page-button">Показать еще</a>
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
            <div class="ava" style="background-image: url(asset/front/images/noimg.png)"></div>        </div>
             <form  id="comment_form">
        <div class="adv-comment wmCommentMes">
                     @guest
	                    <input type="text" class="login" name="comment_name" id="comment_name" placeholder=" Ваше имя"/>
	                    @endguest
	                    
	                    <div class="wmCommentMesBlock">
                <textarea class="input-comment"    name="comment_content" id="comment_content"    placeholder="  Коментарии ..."></textarea>
                <input type="hidden" name="comment_id" id="comment_id" value="0" />
                <input type="hidden" id="help_id" name="help_id" value="{{$help->id}}"/>
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
     
        
        viewStore();
        load_comment();
        countView();
        
        
		
		
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
      var help_id=$('#help_id').val();
    $.ajax({
   url:"/view/store",
   method:"POST",
   
   data:{'post_id':help_id,'type_id':'3'},
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
	
   var help_id=$('#help_id').val();  
   
          $.ajax({
   url:"/view/count/view",
   method:"POST",
   
   data:{'post_id':help_id,'type_id':'3'},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
	   
	
    
        $('#view_c').html(data.count);
    }
  });
    }
  
   
		
		



  $('#comment_form').on('submit', function(e){
    e.preventDefault();
    var $that = $(this),
    formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    
    
    $.ajax({
        url:'/help/coment',
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
  
  
   
  
  
  
    

 function load_comment()
 {
     var help_id=$('#help_id').val();
  $.ajax({
   url:"/help/coment/get",
   method:"POST",
   
   data:{'help_id':help_id},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
  $.ajax({
   url:"/help/coment/getcount",
   method:"POST",
   
   data:{'help_id':help_id},
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

        
    });
</script>






              
                       
                  @push('js')
       
 @endpush
 @endsection