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
</div><script src="https://myldl.ru/application/views/front/js/jquery.form.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var error_email = 1;
        var error_pass_1 = 1;
        var error_pass_2 = 1;
        var error_name = 1;

        var isCyrillic = function (text) {
            return /[а-я]/i.test(text);
        }

        $('.BDC_CaptchaImageDiv, .BDC_CaptchaDiv').removeAttr('style');
        $('#RegisterUserCaptcha_ReloadIcon').attr('src', 'asset/front/images/refresh.png');
        $('#RegisterUserCaptcha_SoundIcon').attr('src', 'asset/front/images/voice-recording.png');

        $("#email").bind('change input', function () {
            var email = $(this).val();
            $('input[name=check-2]').attr('checked', false);	//
            $('#text_error_email').css("visibility", "hidden");	//
            if (email != '') {
                if (isValidEmailAddress(email)) {
                    $("#validEmail").css({"background-image": "url('https://myldl.ru/application/views/front/images/validyes.png')"});
                    error_email = 0;
                } else {
                    $("#validEmail").css({"background-image": "url('https://myldl.ru/application/views/front/images/validno.png')"});
                    error_email = 1;
                }
            } else {
                $("#validEmail").css({"background-image": "none"});
            }
        });

        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
        }

        $("#name").bind('change input', function () {
            var name = $("#name").val();
            $("#name").val(name.replace(/[^\w]/ig, ""));
            name = $("#name").val();
            if (name.length < 3 || name.length > 30) {
                $("#valid_name").css({"background-image": "url('https://myldl.ru/application/views/front/images/validno.png')"});
                error_name = 1;
            } else {
                $("#valid_name").css({"background-image": "url('https://myldl.ru/application/views/front/images/validyes.png')"});
                error_name = 0;
            }
        });

        $("#pass_1").bind('change input', function () {
            var pass_1 = $("#pass_1").val();
            $("#len").text(pass_1.length);

            var count_spaces = 0;

            for (var i = 0; i < pass_1.length; i++) {
                if (pass_1.charAt(i) === " ") {
                    count_spaces++;
                }
            }

            if (pass_1.length < 6 || (pass_1.length - count_spaces) <= 3 || isCyrillic(pass_1)) {
                $("#valid_pass_1").css({"background-image": "url('https://myldl.ru/application/views/front/images/validno.png')"});
                error_pass_1 = 1;
            } else {
                $("#valid_pass_1").css({"background-image": "url('https://myldl.ru/application/views/front/images/validyes.png')"});
                error_pass_1 = 0;
            }
        });


        $("#pass_2").bind('change input', function () {
            var pass1 = $("#pass_1").val();
            var pass2 = $("#pass_2").val();

            var count_spaces = 0;

            for (var i = 0; i < pass2.length; i++) {
                if (pass2.charAt(i) === " ") {
                    count_spaces++;
                }
            }

            if (pass1 !== pass2 ||
                pass2.length < 6 || (pass2.length - count_spaces) <= 3) {
                $("#valid_pass_2").css({"background-image": "url('https://myldl.ru/application/views/front/images/validno.png')"});
                error_pass_2 = 1;
            } else {
                $("#text_error_pass").text('');
                $("#valid_pass_2").css({"background-image": "url('https://myldl.ru/application/views/front/images/validyes.png')"});
                error_pass_2 = 0;
            }
        });

        $("#kod").bind('change click input', function () {
            $("#valid_captcha").css({"background-image": "none"});
        });

        $("input[name=check-2]").click(function () {
            var errors = {},
                sendDataMailObj = {},
                sendDataNameObj = {},
                hashNameID = $('#hashRegisterID').attr('name'),
                hashID = $.cookie('hash_cookie_id');
            sendDataMailObj[hashNameID] = hashID;
            sendDataMailObj.email = $('input[name=email]').val();
            sendDataNameObj[hashNameID] = hashID;
            sendDataNameObj.name = $('input[name=name]').val();
            $.when(
                $.ajax({
                    type: "POST",
                    url: "https://myldl.ru/auth/ajax_check_email",
                    data: sendDataMailObj,
                    dataType: "html"
                }),
                $.ajax({
                    type: "POST",
                    url: "https://myldl.ru/auth/ajax_check_login",
                    data: sendDataNameObj,
                    dataType: "html"
                })
            ).done(function (r1, r2) {

                var res_email = r1[0];
                var res_login = r2[0];

                if (res_email == "y") {
                    errors.email = 'Такой e-mail уже есть в базе, используйте другой адрес, или воспользуйтесь восстановлением пароля';
                }
                if (res_email == "n") {
                    if ($('input[name=email]').val() != '') {
                        $('#text_error_email').css("visibility", "hidden");
                    }
                }


                if (res_login == "y") {
                    errors.login = 'Такой логин уже есть в базе, попробуйте другой!'
                }
                if (res_login == "n") {
                    if ($('input[name=name]').val() != '') {
                        $('#text_error_login').css("visibility", "hidden");
                    }
                }

                if (Object.keys(errors).length > 0) {
                    if ('login' in errors) {
                        $("#valid_name").css({"background-image": "url('https://myldl.ru/application/views/front/images/validno.png')"});
                        $('#text_last_error').html(errors.login);
                    } else {
                        $("#valid_name").css({"background-image": "url('https://myldl.ru/application/views/front/images/validyes.png')"});
                    }
                    if ('email' in errors) {
                        $("#validEmail").css({"background-image": "url('https://myldl.ru/application/views/front/images/validno.png')"});
                        $('#text_last_error').html(errors.email);
                    } else {
                        $("#validEmail").css({"background-image": "url('https://myldl.ru/application/views/front/images/validyes.png')"});
                    }
                    $('#text_last_error').css('visibility', 'visible');
                    $('input[name=check-2]').prop('checked', false);
                } else {
                    $('#text_last_error').css('visibility', 'hidden');
                    if ($('#name').val()) {
                        $("#valid_name").css({"background-image": "url('https://myldl.ru/application/views/front/images/validyes.png')"});
                    }
                    if ($('#email').val()) {
                        $("#validEmail").css({"background-image": "url('https://myldl.ru/application/views/front/images/validyes.png')"});
                    }
                }
            });


        });


        $("#check_before_send").click(function (e) {
            e.preventDefault();
            if ($("input[name=check-2]").prop("checked")) {
                if (error_name == 1) {
                    alert('Заполните поле "Имя" !');
                    $("#valid_name").css({"background-image": "url('https://myldl.ru/application/views/front/images/validno.png')"});
                    return;
                }
                if (error_email == 1 || $('input[name=email1]').val() == '') {
                    alert('Укажите валидный email !');
                    $("#validEmail").css({"background-image": "url('https://myldl.ru/application/views/front/images/validno.png')"});
                    return;
                }
                if (error_pass_1 == 1) {
                    alert('Введите валидный пароль !');
                    $("#valid_pass_1").css({"background-image": "url('https://myldl.ru/application/views/front/images/validno.png')"});
                    $("#valid_pass_2").css({"background-image": "url('https://myldl.ru/application/views/front/images/validno.png')"});
                    return;
                }
                if (error_pass_2 == 1) {
                    alert('Пароли не совпадают !');
                    $("#valid_pass_1").css({"background-image": "url('https://myldl.ru/application/views/front/images/validno.png')"});
                    $("#valid_pass_2").css({"background-image": "url('https://myldl.ru/application/views/front/images/validno.png')"});
                    return;
                }

                console.log(error_name)
                console.log(error_email)
                console.log(error_pass_1)
                console.log(error_pass_2)
                if (error_name == 0 & (error_email == 0 &&
                        $('input[name=email1]').val() != '') &&
                    error_pass_1 == 0 &&
                    error_pass_2 == 0
                ) {
                    $('#hashRegisterID').val($.cookie('hash_cookie_id'));
                    $('#register_form').ajaxSubmit({
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        method: 'POST',
                        success: function (res) {
                            var data = jQuery.parseJSON(res);
                            if (data.result) {
                                window.location = "https://myldl.ru/auth/registration_ok";
                            }
                        },
                        error: function (xhr) {
                            if (xhr.status == 400) {
                                var data = jQuery.parseJSON(xhr.responseText);
                                var keys = Object.keys(data.messages);
                                // Отображаем лишь первую ошибку (чтоб не завалить юзера)
                                var msg = data.messages[keys[0]][0];
                                alert(msg);
                            } else {
                                alert('Неизвестная ошибка!');
                            }
                            $('#RegisterUserCaptcha_ReloadLink').trigger('click');
                        }
                    });
                }
            } else {
                alert('Пожалуйста, приймите условия соглашения !');
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
	<form action="{{route('register')}}" method="POST"  class="signup">
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