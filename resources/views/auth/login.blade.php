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
</div><script src="{{asset('asset/front/js/js/jquery.form.js')}}"></script>

<style>
	.rules-checkbox a:link,a:visited {
		text-decoration: underline;
	}
	.rules-checkbox a:hover {
		text-decoration: none;
	}
</style>

<section style="padding-right: 0; padding-left: 0;">
	<form action=" action="{{route('login')}}"" method="POST"  class="signup">
	     {{ csrf_field() }}
		<span class="reg-title">Вход</span></span>
		<div class="reg">
			<span class="reg-head">Ваш E-Mail <i id="validEmail"></i></span>
			<input type="text" class="email" placeholder="| E-Mail" name="email" id="email" required/>
		</div>
		<div class="reg">
			<span class="reg-head">Пароль <i id="valid_pass_2"></i></span>
			<input type="password" placeholder="| Пароль" class="password" style="margin-bottom: 25px;" id="pass_1" name="passw" required>
		</div>
	
		
		<input type="hidden" name="ref_url" value="/">
		<input type="hidden" id="hashRegisterID" name="ci_csrf_token"
		       value="">
		<div class="reg" style="text-align: center;">
			<input type="submit" value="Войти"/>
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