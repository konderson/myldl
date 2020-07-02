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
        <li><a href="/">Главная</a></li><li><a href="/profile/index">Профиль</a></li><li class="active">Настройки</li>    </ol>
</div>
<style>
    #change_city {
        cursor: pointer;
    }

    .add-button a {
        text-decoration: none;
    }
</style>


<script type="text/javascript">
    $(document).ready(function () {
       

       
       

        $('.del_profile').click(function () {
            if (confirm("Вы хотите удалить свой профиль?")) {
                document.location.href = "/profile/del_profile";
                //alert("Профиль уничтожен!");
            }
        });

        $('.edit_profile').click(function () {
            document.location.href = "/profile/profile_edit";
        });

        $('#block-profile').click(function (e) {
            e.preventDefault();
//				if (confirm("Вы хотите заблокировать свой профиль?")) {
            if (confirm('Вы уверены, что хотите заблокировать свою страницу? Все преимущества личного кабинета станут недоступны, и ваш профиль будет скрыт из поиска и недоступен для других участников портала.')) {
                $('#block-profile-form').submit();
            }
        });
        $('#delete-profile').click(function (e) {
            e.preventDefault();
//				if (confirm("Вы хотите заблокировать свой профиль?")) {
            if (confirm('Вы уверены, что хотите удалить свою страницу? Все преимущества личного кабинета станут недоступны, и ваш профиль будет удалён из поиска и недоступен для других участников портала.')) {
                $('#delete-profile-form').submit();
            }
        });

        $('.close').click(function () {
            //alert($('#kartinka').attr("nazva"));
            avatar = $('#kartinka').attr("nazva");
            if (confirm("Вы действительно хотите удалить аватар?")) {
                document.location.href = "/profile/del_avatar/" + avatar;
            }
        });

    });

    
</script>

<script>
    $(function () {
        var error_pass_orig = 1;
        var error_pass_2 = 1;
        var error_pass_1 = 1;
       
      


     $("#pass_orig").blur(function(){
         var data=$("#pass_orig").val();
        $.ajax({
        url :'/profile/settings/check_psw',
      type: 'POST', 
     headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        data: {data:data},
      success: function(data){
      
    alert('ff')
    
       } 
         })
     })
 
        $("#pass_1").bind('change keyup', function () {
            var pass_1 = $("#pass_1").val();
            $("#len").text(pass_1.length);

            var count_spaces = 0;

            for (var i = 0; i < pass_1.length; i++) {
                if (pass_1.charAt(i) === " ") {
                    count_spaces++;
                }
            }

            if (pass_1.length < 6 || (pass_1.length - count_spaces) <= 3) {
                //$(this).css({ "border-color": "red" });
                $("#valid_pass_1").css({"background-image": "url('/asset/front/images/validno.png')"});
                error_pass_1 = 1;
            } else {
                //$(this).css({ "border-color": "green" });
                $("#valid_pass_1").css({"background-image": "url('/asset/front/images/validyes.png')"});
                error_pass_1 = 0;
            }
        });


        $("#pass_2").bind('change keyup', function () {
            var pass1 = $("#pass_1").val();
            var pass2 = $("#pass_2").val();

            console.log(pass1, pass2);

            var count_spaces = 0;

            for (var i = 0; i < pass2.length; i++) {
                if (pass2.charAt(i) === " ") {
                    count_spaces++;
                }
            }

            if (pass1 !== pass2 ||
                pass2.length < 6 || (pass2.length - count_spaces) <= 3) {
//                    $("#text_error_pass").text('пароль введен неверно');
                //$(this).css({ "border-color": "red" });
                $("#valid_pass_2").css({"background-image": "url('/asset/front/images/validno.png')"});
                error_pass_2 = 1;
            } else {
                $("#text_error_pass").text('');
                //$(this).css({ "border-color": "green" });
                $("#valid_pass_2").css({"background-image": "url('/asset/front/images/validyes.png')"});
                error_pass_2 = 0;
            }
        });

        $("#password_change_form").submit(function (e) {
            if (error_pass_orig == 1) {
                alert('Введите текущий пароль !');
                //$("#pass_1").css({ "border-color": "red" });
                //$("#pass_2").css({ "border-color": "red" });
                $("#valid_pass_orig").css({"background-image": "url('/asset//front/images/validno.png')"});
                e.preventDefault();
                return;
            }
            if (error_pass_1 == 1) {
                alert('Введите новый валидный пароль !');
                //$("#pass_1").css({ "border-color": "red" });
                //$("#pass_2").css({ "border-color": "red" });
                $("#valid_pass_1").css({"background-image": "url('/asset//front/images/validno.png')"});
                $("#valid_pass_2").css({"background-image": "url('/asset//front/images/validno.png')"});
                e.preventDefault();
                return;
            }
            if (error_pass_2 == 1) {
                alert('Пароли не совпадают !');
                //$("#pass_1").css({ "border-color": "red" });
                //$("#pass_2").css({ "border-color": "red" });
//                        $("#valid_pass_1").css({"background-image": "url('//application/views/front/images/validno.png')"});
                $("#valid_pass_2").css({"background-image": "url('/asset/front/images/validno.png')"});
                e.preventDefault();
            }
        });

    });
</script>

<style>
    #valid_name, #validEmail, #valid_pass_orig, #valid_pass_1, #valid_pass_2, #valid_captcha {
        margin-top: 8px;
        margin-left: 5px;
        position: absolute;
        width: 16px;
        height: 16px;
    }
</style>

<section>
    <div class="people-outside lenta-sobitii moya-anketa">
        
       @include('myprofile.left')
      
      <form class="right" action="/profile/settings/password" method="post" id="password_change_form">
            <input type="hidden" name="ci_csrf_token" value="">
            <p class="title" style="width: 100%;">Изменение данных </p>

            <input type="hidden" name="ci_csrf_token"
                   value="">
            <h4>Смена пароля</h4>

            <div class="field-for-edit">
                <label for="pass_orig" class="edit-label">Старый пароль</label>
                <input class="form-control tfi" type="password" id="pass_orig" name="pass_orig"/>
                <span id="valid_pass_orig">&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>

            <div class="field-for-edit">
                <label for="pass_1" class="edit-label">Новый пароль (<span id="len">0</span>)<br> (можно вводить цифры и
                    специальные
                    <br> символы, кроме сплошных пробелов без <br>символов, длина пароля 6 и более
                    символов)</label>
                <input class="form-control tfi" type="password" id="pass_1" name="pass"/>
                <span id="valid_pass_1">&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>

            <div class="field-for-edit">
                <label for="pass_2" class="edit-label">Повторите пароль:</label>
                <input class="form-control tfi" type="password" id="pass_2" name="pass_confirm"/>
                <span id="valid_pass_2">&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>

            <div class="field-for-edit">
                <input
                        class="tab-btn btn btn-default half form_submit save"
                        style="margin-top: 10px;"
                        type="submit"
                        value="Сменить пароль"
                        id="check_before_send"/>
                <span id="text_last_error" style="color:red; visibility: hidden;">Ошибка!</span>
            </div>
			<div class="field-for-edit">
                <input
                        class="tab-btn btn btn-default half form_submit save"
                        style="margin-top: 10px;"
                        type="button"
                        value="Заблокированные пользователи"
                        id="ban_list"/>               
            </div>
			
		<style>
			.ban_list{
			 display:none;
			margin: 40px auto 0px 10%;
			width: 20%;
			max-height:500px;
			padding: 10px;
			background-color: #ebebeb;
			border-radius: 5px;
			box-shadow: 0px 0px 10px #000;
			position: fixed;
			z-index: 9;
			}
			.popupButton{
				float:right;
			}
			.popupTitle{
				text-align: -webkit-center;
			}
			.contact_list{
				display:inline-block;
				width:100%;
				border-bottom: 1px solid darkgray;
				margin-top: 15px;
			}
			.ban-avatar{
				width:30px;
				height:30px;
				border-radius: 70%;
				float:left;
			}
			.user_name{
				float:left;
				margin-left:15px;
				vertical-align:middle;
			}
		</style>
		<div class = "ban_list" >
				<div class= "popupTitle" >Заблокированные пользователи</div>
				<input type = "button"class="popupButton" id="buttonClose" value="Закрыть"/>
		</div>
				
			<script>
			var siteUrl=window.location.protocol+'//'+window.location.host;
			$(document).ready(function(){
				$('#ban_list').click(function(){
				$('.ban_list').show();
				if(!$('div').is('.contact_list') ){
					$('.popupTitle').after('<div class= "popupTitle2" style = "text-align: -webkit-center;">Пусто</div>');
				}					
			});
			$('#buttonClose').click(function(){
				$('.ban_list').hide();
				$('.popupTitle2').remove();
			});
			$('.ban_list').on('click', '.unban', function(){
				let user_id = $(this).parent('.contact_list').attr('id');
				let this_id = 20263;
				$.ajax({
					url:    siteUrl+"/main/add_ban",
					type:     'POST', //метод отправки
					dataType: "html", //формат данных
					data: { ban: 0, user_id: user_id},  
					success: function() {
										$('#'+user_id).empty();
										$('#'+user_id).remove();
										
										}
			});
			});
			});
			</script>
            <div class="row">
                <h4>Блокировка аккаунта</h4>
                <p>
                    Вы можете <a id="block-profile" href="#">Заблокировать свою страницу</a>
                </p>

                <p>
                    Вы можете <a id="delete-profile" href="#">Удалить свою страницу</a>
                </p>

                <form method="post" action="/profile/block_profile" id="block-profile-form">
                    <input type="hidden" name="ci_csrf_token"
                           value="">
                </form>

            </div>
        </form>

        <form method="post" action="/profile/delete_profile" id="delete-profile-form">
            <input type="hidden" name="ci_csrf_token"
                   value="">
        </form>
     <hr>
        <form method="post" action="/profile/email_settings" id="email-settings-form">
            <input type="hidden" name="ci_csrf_token"
                   value="">

                <input  type="checkbox"  name="email_notify"/>
                Хочу получать уведомления на электронную почту<br>
            <input  type="checkbox"  name="email_notify_dela"/>
            Хочу получать уведомления на электронную почту(Дела)<br>
            <input  type="checkbox"  name="email_notify_uslugi"/>
            Хочу получать уведомления на электронную почту(Услуги)<br>
            <input  type="checkbox"  name="email_notify_reviews"/>
            Хочу получать уведомления на электронную почту(Отзивы)<br>
            <input  type="checkbox"  name="email_notify_izbranniye_dela"/>
            Хочу получать уведомления на электронную почту(Избранные Дела)<br>
            <input  type="checkbox"  name="email_notify_vzaimopomoshi"/>
            Хочу получать уведомления на электронную почту(Взаимопомощь)<br>

            <div class="field-for-edit">
                <input
                        class="tab-btn btn btn-default half save"
                        style="margin-top: 10px;"
                        type="submit"
                        value="Сохранять"
                "/>
            </div>

        </form>
    </div>
</section>
  @push('js')
       
 @endpush
 
 
 
@endsection