    @extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
@endpush
@section('content')

<br />
  <h2 align="center"><a href="#">Comment System using PHP and Ajax</a></h2>
  <br />
  <div class="container" style="width:80%">
      
   <form  id="comment_form">
    @guest
    <div class="form-group">
     <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
    </div>
    @endguest
    <div class="form-group">
     <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input type="hidden" name="comment_id" id="comment_id" value="0" />
     <input type="hidden" id="delo_id" name="delo_id" value="1"/>
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
    </div>
   </form>
   <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
  </div>

<script>
$(document).ready(function(){
load_comment();

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
 }

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
    
   

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
  });

</script>

   @push('js')
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
         @endpush

@endsection