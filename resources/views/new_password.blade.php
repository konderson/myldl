@extends('layouts.frontend.app')
@section('title','Смена пароля')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
  <main class="col-xs-12">
<div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>    </ol>
</div><style>
    span.error p{ color: #FF0000 !important; font-size: 10px!important; }
    section.article{border:none;}
</style>
<section style="padding-right: 0; padding-left: 0;">
	<form action="{{route('new_password')}}" method="POST"  class="signup">
	     {{ csrf_field() }}
		<span class="reg-title">Сброс пароля</span></span>
		<div class="reg">
			<span class="reg-head">Новый пароль <i id="valid_pass_2"></i></span>
			<input type="password" class="password" placeholder="|Новый пароль" name="pass1" id="pass_1" required/>
		</div>
		<div class="reg">
			<span class="reg-head">Подтвердите пароль<i id="valid_pass_2"></i></span>
			<input type="password" placeholder="| Подтвердите" class="password" style="margin-bottom: 25px;" id="pass_2" name="passw" required>
		</div>
	
		
		<input type="hidden" name="user_id" value="{{$user->id}}">
		<div class="reg" style="text-align: center;">
			<input type="submit" value="Сохранить"/>
		</div>
	</form>
</section>

<script>
 $(document).ready(function () {
	 
	 $error_lenght=1;
	 
	  $('#pass_1').blur(function()
	  {
		  var pass2 = $("#pass_2").val();
		  var pass1 = $("#pass_1").val();
		
		
		if (pass1.length < 8 ) {
                $("#valid_pass_2").html('<span style="color:red">Не соотвествие пароля - пароль должен содержать больше 8 цифр</span> ');
               error_lenght=1
            } else {
                 $("#valid_pass_2").html('');
                error_lenght=0
            }
	  })
 
	 
  $('#pass_2').blur(function(){
			var pass2 = $("#pass_2").val();
			var pass1 = $("#pass_1").val();
			
			
			if(error_lenght==1)
			{
				 $("#valid_pass_2").html('<span style="color:red">Не соотвествие пароля - пароль должен содержать больше 8 цифр</span> ');
               error_lenght=1
			}
			else{
			if(pass1==pass2)
			{
			
				$("#valid_pass_2").html('<span style="color:green">OK</span> ');
			
		
			}
			else
			{
				 $("#valid_pass_2").html('<span style="color:red">Пороли не совподают</span> ');
				
		      
			}
			}
             });
		 
 });
</script>
  @push('js')
        
         @endpush

@endsection