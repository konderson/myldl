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
           
            <a href="/uslugi">Объявления</a>
         
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


<section>
    <div class="advert advert-inner">
        <div class="left">
            <div class="date"><span>{{ Carbon\Carbon::parse($serv->created_at)->format('d.m.Y') }}</span></div>
            <h1 class="title">{{$serv->title}}</h1>

            <div class="adv-inner-body news-inner-body searches">
                                <div class="adv-inner-right inner-100">
                    <div class="awa-226 " style="background-image: url(/storage/help/{{$serv->getPhoto($serv->images)}});"></div>
                    <p class="profile-info-p" style="margin-bottom: 8px; margin-top: 0;"><span>Дата публикации:</span> {{ Carbon\Carbon::parse($serv->created_at)->format('d.m.Y') }}</p>
                    <p class="profile-info-p" style="margin-bottom: 8px;"><span>Количество просмотров:</span> <span id="view_c">9</span></p>
                    <p class="profile-info-p" style="margin-bottom: 8px;"><span>Автор:</span> <a href="/user/{{$serv->user->id}}">{{$serv->user->name}}</a></p>
                    <p class="profile-info-p" style="margin-bottom: 8px;"><span>Город:</span> {{$serv->city}}</p>
                    <p class="profile-info-p" style="margin-bottom: 8px;">Раздел: 
                                                   <?php if($serv->razdel_id==1) echo 'Транспорт' ?>      
                                                     <?php if($serv->razdel_id==2) echo 'Недвижимость' ?>  
													 <?php if($serv->razdel_id==3) echo 'Работа' ?>  
													 <?php if($serv->razdel_id==4) echo 'Вещи' ?>  
													 <?php if($serv->razdel_id==5) echo 'Для быта' ?>  
                                                     <?php if($serv->razdel_id==6) echo 'Бытовая электроника' ?>  
													 <?php if($serv->razdel_id==7) echo 'Хобби и отдых' ?>  
													 <?php if($serv->razdel_id==8) echo 'Животные' ?> 
                                                     <?php if($serv->razdel_id==8) echo 'Бизнес' ?>  													 


												   </p>
                    <p class="profile-info-p" style="margin-bottom: 8px;">Телефон: <?php  if($serv->phone==null) echo('не указан')?>
                                                    {{$serv->phone}}                                           </p>
                    <p class="profile-info-p">Цена: <?php if($serv->price==0) echo('Бесплатно')?> {{$serv->price}}
                                                                                                </p>
                                    </div>
                <div class="adv-inner-desc">{{$serv->description}}</div>
                <ul class="gallery">
                                            <li>
                            <a
                                class="fancybox2 awa awa-201 awa-full"
                                href="{{asset('storage/help/'.$serv->getPhoto($serv->images))}}"
                                rel="gallery1"
                                data-fancybox-group="gallery"
                                data-fancybox="gallery"
                                style="background-image: url(/storage/help/{{$serv->getPhoto($serv->images)}});"></a>
                        </li>
                                    </ul>

               
            </div>
        </div>

        <div class="right">
            <span class="title">Последние объявления</span>
            <div class="advert-body">
                @foreach($services as $lserv)
	                                <div class="article-info">
                        <div class="article-subtitle">
                            <div class="date"><span>{{ Carbon\Carbon::parse($lserv->created_at)->format('d.m.Y') }}</span></div>
                            <a href="/usluga/{{$lserv->id}}">{{$lserv->title}}</a>
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
      <div class="photo">
            <div class="ava" style="background-image: url(/storage/avatar/{{Auth::user()->person->avatar}})"></div>        </div>
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






              
                       
                  @push('js')
       
 @endpush
 @endsection