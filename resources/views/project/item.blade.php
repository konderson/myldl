@extends('layouts.frontend.app')

<?$title="$project->name"?>
@section('title',"$title")
<meta name="description" content="">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
          <main class="col-xs-12">
              
              
   <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li><a href="/project">
Наши проекты</a></li><li class="active">{{$project->name}}</li>    </ol>
</div>
 <section>
        <div class="advert advert-inner">
            <div class="left">
                <div class="date"><span>{{ Carbon\Carbon::parse($project->created_at)->format('d.m.Y') }}</span></div>
                <h1 class="title">{{$project->name}}</h1>

                <div class="adv-inner-body news-inner-body">
                    <div class="text">
					{!!$project->text!!}	
                  </div>
                        <div class="news-views">
						
<img src="{{asset('asset/front/images/like.png')}}" class="stat-item thumbs-up likebut" section_id="12" post_id="{{$project->id}}"/>
<span id="like_c{{$project->id}}">{{$project->likeCount($project->id)}}</span>
<img src="{{asset('asset/front/images/like.png')}}" class="stat-item thumbs-down dislikebut" section_id="12" post_id="{{$project->id}}"/>
<span id="dislike_c{{$project->id}}">{{$project->dislikeCount($project->id)}}</span>                        
                        <img src="{{asset('asset/front/images/comments.png')}}"/>
                        <span id="count_com" >{{$project->getCount($project->id)}}</span>
                    <img src="{{asset('asset/front/images/views.png')}}"/>
                    <span>0</span>
                        
						</div>
                   <ul class="soc-links">
                    <li>
                        <a onclick="window.open('https://connect.mail.ru/share?url=https://myldl.ru/','sharer','toolbar=0,status=0,width=700,height=400');" href="javascript: void(0)">
                            <img src="{{asset('asset/front/images/mailru.png')}}" alt="socials">
                        </a>
                    </li>
                    <li>
                        <a onclick="window.open('https://ok.ru/dk?st.cmd=addShare&amp;st.s=1&amp;st._surl=https://myldl.ru/','sharer','toolbar=0,status=0,width=700,height=400');" href="javascript: void(0)">
                            <img src="{{asset('asset/front/images/ok.png')}}" alt="socials">
                        </a>
                    </li>
                    <li>
                        <a onclick="window.open('https://vkontakte.ru/share.php?url=https://myldl.ru/','sharer','toolbar=0,status=0,width=700,height=400');" href="javascript: void(0)">
                            <img src="{{asset('asset/front/images/vk2.png')}}" alt="socials">
                        </a>
                    </li>
                    <li>
                        <a onclick="window.open('https://twitter.com/intent/tweet?text=Люди для людей https://myldl.ru/','sharer','toolbar=0,status=0,width=700,height=400');" href="javascript: void(0)">
                            <img src="{{asset('asset/front/images/twit.png')}}" alt="socials">
                        </a>
                    </li>
                    <li>
                        <a onclick="window.open('https://plus.google.com/share?url=https://myldl.ru/','sharer','toolbar=0,status=0,width=700,height=400');" href="javascript: void(0)">
                            <img src="{{asset('asset/front/images/goog.png')}}" alt="socials">
                        </a>
                    </li>
                </ul>
                </div>
            </div>
                    
    
    
    
        <div class="right">
            <span class="title">Популярные</span>
            <div class="advert-body">
                
                @foreach($lprojects as $pj)
              
	                                <div class="article-info">
                        <div class="article-subtitle">
                            <div class="date"><span>{{ Carbon\Carbon::parse($pj->created_at)->format('d.m.Y') }}</span></div>
                            <a href="/project/item/{{$pj->id}}">{{$pj->name}}</a>
                        </div>
                    </div>
                    @endforeach
	                                
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
                <input type="hidden" id="pj_id" name="pj_id" value="{{$project->id}}"/>
            </div>
            <input type="submit" value="Комментировать" name="send_comment"/>
        </div>
        </form>
        
        
    </div>




   </div>
   </div>
</section>

             <script type="text/javascript">
    $(document).ready(function(){


          

        countLike(); 
        countDisLike();
        load_comment();
        



  $('#comment_form').on('submit', function(e){
    e.preventDefault();
    var $that = $(this),
    formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    
    
    $.ajax({
        url:'/project/coment',
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
          var span_value= $('#count_com').text();
$('#count_com').text( parseInt(span_value)+1)
          
           
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
   var inter_id=$('#inter_id').val();  
   
          $.ajax({
   url:"/like/count/like",
   method:"POST",
   
   data:{'post_id':inter_id,'type_id':'5'},
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
  Функция +  количесво like
  ***
    */
  
  
    function countDisLike(){
   var inter_id=$('#inter_id').val();     
          $.ajax({
   url:"/like/count/dis",
   method:"POST",
   
   data:{'post_id':inter_id,'type_id':'5'},
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
    
    
    
 function load_comment()
 {
     var pj_id=$('#pj_id').val();
  $.ajax({
   url:"/project/coment/get",
   method:"POST",
   
   data:{'pj_id':pj_id},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
  $.ajax({
   url:"/pj/coment/getcount",
   method:"POST",
   
   data:{'pj_id':pj_id},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
    $('#display_count').html(data);
    
   }
  })
  
  
  
 }
        
    



          $('.likebut').click(function(){
         
      var delo_id=$(this).attr('post_id');
    $.ajax({
   url:"/like/store",
   method:"POST",
   
   data:{'post_id':delo_id,'type_id':'5'},
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
   
   data:{'post_id':delo_id,'type_id':'5'},
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

});
       </script>

<script>




     $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_content').focus();
 });
</script>

              
                       
                  @push('js')
       
 @endpush
 @endsection