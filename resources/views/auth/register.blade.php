@extends('layouts.frontend.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
    <main class="col-xs-12">
        

        
<div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li class="active">Регистрация</li>    </ol>
</div><script src="{{asset('asset/front/js/jquery.form.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
		
		var name_error=1;
		var email_error=1;
		var pass_1_error=1;
		var pass_2_error=1
		var rules=1;
		
		
		$("#check-2").change(function(){
		    if(this.checked!=true)
    {
         rules=1;
    }
	else{
	rules=0;
	}
	})
		
		$('#name').blur(function(){
			var name = $("#name").val();
            $("#name").val(name.replace(/[^\w]/ig, ""));
            name = $("#name").val();
            if (name.length < 3 || name.length > 30) {
                $("#valid_name").html('<span style="color:red">Не соотвествие имени</span> ');
              name_error = 1;
            } else {
                 $("#valid_name").html('<span style="color:green">OK</span> ');
                name_error = 0;
            }
		});
		
		$('#email').blur(function(){
			
    var email = $("#email").val();
		if(isValidEmailAddress(email))
		{
			$.ajax({
        url:'/check/email',
      type: 'POST', 
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        data: {'email':email},
      success: function(data){
        if(data==='ok'){
           
  $("#validEmail").html('<span style="color:green">OK</span> ');
			email_error=0;
                    }else{
    $("#validEmail").html('<span style="color:red">Данный emal уже используется системой</span> ');
  
                   email_error=1; 
                        }
      },
       
    });
			
		}
		else{
		$("#validEmail").html('<span style="color:red">Не соотвествие email</span> ');
		email_error=1;
		}
		});
		
		function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
    }
		
		$('#pass_1').blur(function(){
		var pass1=$("#pass_1").val();
		
		if (pass1.length < 6 ) {
                $("#valid_pass_2").html('<span style="color:red">Не соотвествие пароля - пароль должен содержать больше 6 цифр</span> ');
               pass_1_error = 1;
            } else {
                 $("#valid_pass_2").html('');
                pass_1_error = 0;
            }
			
			var pass2 = $("#pass_2").val();
			var pass1 = $("#pass_1").val();
			if(pass1==pass2)
			{
				if(pass_1_error==0){
				$("#valid_pass_2").html('<span style="color:green">OK</span> ');
				 pass_1_error=0;
		         pass_2_error=0;
				}
			}
		});
		
		$('#pass_2').blur(function(){
			
			if(pass_1_error==1)
			{
		      $("#valid_pass_2").html('<span style="color:red">Не соотвествие пароля - пароль должен содержать больше 6 цифр</span> ');
			}
			var pass2 = $("#pass_2").val();
			var pass1 = $("#pass_1").val();
			if(pass1==pass2)
			{
				if(pass_1_error==0){
				$("#valid_pass_2").html('<span style="color:green">OK</span> ');
				 pass_1_error=0;
		         pass_2_error=0;
				}
			}
			else
			{
				 $("#valid_pass_2").html('<span style="color:red">Пороли не совподают</span> ');
				
		         pass_2_error=1;
			}
		});
		
		   
		
		$("#reg_form").submit(function( event ) {
           if(name_error==1)
		   {
			   alert('Ошибка в поле логин');
			   event.preventDefault();
		   }
		   if(email_error==1)
		   {
			   alert('Ошибка в поле E-Mail');
			   event.preventDefault();
		   }
		   if(pass_1_error==1)
		   {
			    alert('Ошибка пороля');
			   event.preventDefault();
		   }
		   if(pass_2_error==1)
		   {
			   alert('Ошибка пороля');
			   event.preventDefault();
		   }

		   if(rules==1)
		   {
			  alert('Пожалуйста, приймите условия соглашения !');
			   event.preventDefault();
		   }

    
		           
});
		
		

    });
</script>
<style>
	.rules-checkbox a:link,a:visited {
		text-decoration: underline;
	}
	.rules-checkbox a:hover {
		text-decoration: none;
	}
</style>

<section style="padding-right: 0; padding-left: 0;">
	<form action="{{route('register')}}" method="POST"  id="reg_form"  class="signup">
	     {{ csrf_field() }}
		<span class="reg-title">Регистрация пользователя</span>
		<div class="reg">
			<span class="reg-head">Придумайте логин <i id="valid_name"></i></span>
			<input type="text" class="login" placeholder="| Логин" required  id="name" name="username"/>
			<span class="reg-desc">(От 3 до 30 символов. Только латинские буквы, цифры и знак "_")<span class="star">*</span></span>
		</div>
		<div class="reg">
			<span class="reg-head">Ваш E-Mail <i id="validEmail"></i></span>
			<input type="text" class="email" placeholder="| E-Mail" name="email1" id="email" required/>
		</div>
		<div class="reg">
			<span class="reg-head">Придумайте пароль <i id="valid_pass_2"></i></span>
			<input type="password" placeholder="| Пароль" class="password" style="margin-bottom: 25px;" id="pass_1" name="password" required>
			<input type="password" placeholder="| Повторите пароль" class="password" id="pass_2" name="pass_confirm" required/>
		</div>
	
	<div class="reg" style="text-align: center;">
			<input type="checkbox" id="check-2" name="check-2"/>
	    	<span class="rules"> Я принимаю условия </span> <a href="/site_rules" target="_blank">Пользовательского соглашения</a><span class="rules"> и даю своё согласие Myldl.ru на обработку моей персональной информации на условиях, определенных</span> <a href="/site_ confidential " target="_blank">Политикой конфиденциальности.</a>
			<span class="star">*</span>
		</div>
		<input type="hidden" name="ref_url" value="https://myldl.ru/">
		<input type="hidden" id="hashRegisterID" name="ci_csrf_token"
		       value="">
		<div class="reg" style="text-align: center;">
			<input type="submit" value="Зарегестрироваться"/>
		</div>
	</form>
</section>

<div style="clear: both"></div>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Регистрация -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1014859909801067"
     data-ad-slot="6754311854"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
  @push('js')
        
         @endpush

@endsection