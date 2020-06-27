@extends('layouts.frontend.app')


@section('title',"Опрос")

@push('css')

@endpush
@section('content')
          <main class="col-xs-12">
              
              
   <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li><a href="/poll">Опросы</a></li><li class="active">{{$quest->name}}</li>    </ol>
</div>
 <section>
        <div class="advert advert-inner">
            {!!$result!!}
                    
    
    
    
        
            
        

	    
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
                <input type="hidden" id="q_id" name="q_id" value="{{$quest->id}}"/>
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


          

      
        load_comment();
        



  $('#comment_form').on('submit', function(e){
    e.preventDefault();
    var $that = $(this),
    formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    
    
    $.ajax({
        url:'/poll/coment',
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


  

    
    
    
 function load_comment()
 {
     var q_id=$('#q_id').val();
  $.ajax({
   url:"/poll/coment/get",
   method:"POST",
   
   data:{'q_id':q_id},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
  $.ajax({
   url:"/poll/coment/getcount",
   method:"POST",
   
   data:{'q_id':q_id},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
    $('#display_count').html(data);
    
   }
  })
  
  
  
 }
        
    



          



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