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
           
            <a href="/profile/future_business">Будущие дела</a>
         
            </li><li class="active">{{$future->title}}</li>    </ol>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#show').click(function(){
            $('#show_tel').show();
            $('#show').hide();
            return false;
        });

       
    });
</script>


<section>
    <div class="advert advert-inner">
        <div class="left">
            <div class="date"><span>{{ Carbon\Carbon::parse($future->created_at)->format('d.m.Y') }}</span></div>
            <h1 class="title">{{$future->title}}</h1>

            <div class="adv-inner-body news-inner-body searches">
                                <div class="adv-inner-right inner-100">
                    
                    <p class="profile-info-p" style="margin-bottom: 8px; margin-top: 0;"><span>Дата публикации:</span> {{ Carbon\Carbon::parse($future->created_at)->format('d.m.Y') }}</p>
                    <p class="profile-info-p" style="margin-bottom: 8px;"><span>Количество просмотров:</span> 9</p>
                    <p class="profile-info-p" style="margin-bottom: 8px;"><span>Автор:</span> <a href="/user/{{$future->user->id}}">{{$future->user->name}}</a></p>
                    <p class="profile-info-p" style="margin-bottom: 8px;">Требуемые ресурсы: 
                                                    {{$future->resource}}                     </p>
                    <p class="profile-info-p" style="margin-bottom: 8px;">Планируемая дата: 
                                                    {{$future->f_data}}                                           </p></div>
                <div class="adv-inner-desc">{{$future->description}}</div>
                

               
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
            <div class="ava" style="background-image: url('/asset/front/images/noimg.png)"></div>        </div>
             <form  id="comment_form">
        <div class="adv-comment wmCommentMes">
                     @guest
	                    <input type="text" class="login" name="comment_name" id="comment_name" placeholder=" Ваше имя"/>
	                    @endguest
	                    
	                    <div class="wmCommentMesBlock">
                <textarea class="input-comment"    name="comment_content" id="comment_content"    placeholder="  Коментарии ..."></textarea>
                <input type="hidden" name="comment_id" id="comment_id" value="0" />
                <input type="hidden" id="future_id" name="serv_id" value="{{$future->id}}"/>
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
        
        
        
        load_comment();
        



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
  Функция +  количесво like
  ***
    */
  
  
   
  
  
  
    

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