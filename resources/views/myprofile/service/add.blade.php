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
        <li><a href="/">Главная</a></li><li><a href="/profile/index">Профиль</a></li><li class="active">Добавить объявление</li>    </ol>
</div>
        <script src="{{asset('asset/front/js/profile/add_delo.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/front/js//jquery/ajaxupload.3.5.js')}}"></script>
<script>
  
</script>
<!-- AjaxUpload -->

<!-- jQuery Masked Input Plugin -->



<script type="text/javascript">
    $(document).ready(function () {
        $("#cenarub").hide();
        $("#cena").change(function () {
            if ($("#cena").val() == 0) {
                $("#cenarub").hide();
                $("#cenarub_input").val("0");
                
            } else {
                $("#cenarub").show();
            }
        });
        $("#cenarub_input").bind('change keyup mouseleave', function () {
            var name = $("#cenarub_input").val();
            $("#cenarub_input").val(name.replace(/[^\1-9]/ig, ""));
            name = $("#cenarub_input").val();

        });
      
      
        
       
       var user_country = 0;
        var user_region = 0;
        var user_city = 0;
        var exists_image = 0;
        $("#country").empty();
        $.ajax({
            type: "GET",
            url: "/ajax_get_country",
            dataType: "html",
            success: function(msg){
                $("#country").append('<option value="">Страна</option>'+msg).data("selectBox-selectBoxIt").refresh();
                if(user_country > 0) {
                    $('#country option[value="'+user_country+'"]').prop('selected', true).change();
                    user_country = 0;
                }
            }
        });
        $.ajax({
            type: "GET",
            url: "/ajax_get_city/0",
            dataType: "html",
            success: function(msg){
                $("#city").append('<option value="">Город</option>'+msg).data("selectBox-selectBoxIt").refresh();
            }
        });
        $('select[name=country]').change(function(){
            
            $("#region").empty();
            $.ajax({
                type: "GET",
                url: "/ajax_get_region/"+$(this).val(),
                dataType: "html",
                success: function(msg){
                    $("#region").append('<option value="">Регион</option>'+msg).data("selectBox-selectBoxIt").refresh();
                    if(user_region > 0) {
                        $('#region option[value="'+user_region+'"]').prop('selected', true).change();
                        user_region = 0;
                    }
                }
            });
            $("#city").empty();
            $.ajax({
                type: "GET",
                url: "/ajax_get_city/"+$(this).val(),
                dataType: "html",
                success: function(msg){
                    $("#city").append('<option value="">Город</option>'+msg).data("selectBox-selectBoxIt").refresh();
                }
            });
        });

        $('select[name=region]').change(function(){
            $("#city").empty();
           console.log($('#region').val())
            $.ajax({
                type: "GET",
                url: "/ajax_get_city/"+$('#region').val(),
                dataType: "html",
                success: function(msg){
                    console.log(msg)
                    $("#city").append('<option value="">Город</option>'+msg).data("selectBox-selectBoxIt").refresh();
                    if(user_city > 0) {
                        $('#city option[value="'+user_city+'"]').prop('selected', true).change();
                        user_city = 0;
                    }
                    // $('.selectpicker').selectpicker('refresh');
                }
            });
        });
   
        $('#change_city').click(function(){
            $('#hid_pole').show('slow');
        });

       
       
       
       
       
       

        $('.form_submit').click(function () {
            msg = "";
            city = 0;
            razdel_id = 0;
            tema = 0;
            opisanie = 0;
            if ($('select[name=city]').val() == 0) {
                $('select[name=country]').css("border-color", "#D93600");
                msg += 'Выберите страну \n';
                city = 1;
            }
            if ($('select[name=region]').val() == 0) {
                $('select[name=region]').css("border-color", "#D93600");
                msg += 'Выберите регион \n';
                city = 1;
            }
            if ($('select[name=city]').val() == 0) {
                $('select[name=city]').css("border-color", "#D93600");
                msg += 'Выберите город \n';
                city = 1;
            }
            if ($('select[name=razdel_id]').val() == 0) {
                $('select[name=razdel_id]').css("border-color", "#D93600");
                msg += 'Выберите раздел \n';
                razdel_id = 1;
            }
            if ($("textarea[name=tema]").val() == '') {
                $("textarea[name=tema]").css("border-color", "#D93600");
                msg += 'Заполните поле "Тема" \n';
                tema = 1;
            } else {
                if ($("textarea[name=tema]").val().length < 3) {
                    $("textarea[name=tema]").css("border-color", "#D93600");
                    msg += 'Поле "Тема" должно быть не короче 3 символов\n';
                    tema = 1;
                }
            }
            if ($("#opisanie").val() == '') {
                $("#opisanie").css("border-color", "#D93600");
                msg += 'Заполните поле "Описание" \n';
                opisanie = 1;
            }
            //if($("select[name=city]").val() != 0 & $("input[name=tema]").val() !='' & $("#opisanie").val() !='' & $('select[name=razdel_id]').val() != 0) {
            if (city == 0 | tema == 0 | opisanie == 0 | razdel_id == 0) {
                
                $('#hashAddUslugaID').val($.cookie('hash_cookie_id'));
                $('#add_uslugi_true').trigger('submit');	// підтвердження форми
            }
        });

    });

// Масив картинок
    var my_mas1 = new Array();
// Видалення картинок
    function remove_img(id, nazva) {
        var el = document.getElementById('img_' + id);
        el.parentNode.removeChild(el);
        // шукаємо вибране значення в масиві, видаляємо його
        for (var i = 0; i < my_mas1.length; i++) {
            if (my_mas1[i] == nazva) {
                my_mas1.splice(i, 1)
            }
            //alert(my_mas1[i]);
        }
        document.getElementById('str_images').value = my_mas1;
        $.get("https://myldl.ru/profile/ajax_del_img_delo/" + nazva);
    }

// Загрузка картинок
   $(function () {
                                img = 1 + my_mas1.length;
                                var btnUpload = $('#upload');
                                var status = $('#status');
                                $.ajaxSetup({
    
});
                                new AjaxUpload(btnUpload, {
                                    action: '/help/ajax_upload',
                                    name: 'userfile',
                                    data: {
                                         _token: $('meta[name="csrf-token"]').attr('content'),
                                         
                                    },
                                    onSubmit: function (file, ext) {
                                        if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                                            // extension is not allowed 
                                            status.text('Поддерживаемые форматы JPG, JPEG, PNG или GIF');
                                            return false;
                                        }
                                        status.text('Загружается...');
                                    },
                                    onComplete: function (file, response) {
                                        //On completion clear the status
                                        status.text('');
                                        //Add uploaded file to list
                                        if (response === "error") {
                                            $('<li></li>').appendTo('#files').text('Файл не загружен ' + file).addClass('error');
                                        } else {
                                            // response - назва зменшеного файлу
                                            orig_name = response.replace("_thumb", "");
                                            $("#files").append('<li id="img_' + img + '"><figure><img class="thumb" src="{{asset('storage/help')}}/' + response + '" alt="' + file + '" title="' + file + '" /><figcaption>' + (file.length > 10 ? file.substr(0, 8) + '..' : file) + '</figcaption></figure><a class="close" onclick="remove_img(' + img + ', \'' + orig_name + '\')"><img src="{{asset('asset/front/images/close-2.png')}}" alt="" /></a></li>');
                                            my_mas1.push(orig_name);
                                            document.getElementById('str_images').value = my_mas1;
                                            img++;
                                        }
                                    }
                                });

                            });

</script>



<section>
    <div class="people-outside lenta-sobitii moya-anketa">
	    
@include('myprofile.left')

      <form class="right" action="/service/save" method="post" id="add_uslugi_true">
          {{ csrf_field()}}
            <p class="title">Добавить объявление</p>
            

            <div class="field-for-edit">
                <span class="edit-label">Заголовок</span>
                <input type="text" placeholder="Заголовок..." id="tema" name="tema" />
            </div>

            <div class='field-for-edit'>
                <span class="edit-label">Раздел</span>
                <div class="custom-select" style="width: 100%; margin: 0;">
                    <select class="form-control selectb" id="razdel_id" name="razdel_id">
                        <option value="0">Раздел</option>
		                                            <option value="1">Транспорт</option>
		                                            <option value="2">Недвижимость</option>
		                                            <option value="3">Работа</option>
		                                            <option value="4">Вещи</option>
		                                            <option value="5">Для быта</option>
		                                            <option value="6">Бытовая электроника</option>
		                                            <option value="7">Хобби и отдых</option>
		                                            <option value="8">Животные</option>
		                                            <option value="9">Бизнес</option>
		                                    </select>
                </div>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Описание</span>
                <textarea placeholder="Описание..." id="opisanie" name="description"></textarea>
            </div>

            <div class="field-for-edit" style="width: 47.5%; margin-right: 5%;">
                <span class="edit-label">Цена</span>
                <select class="form-control selectb" id="cena" name="cena">
                    <option value="0">Бесплатно</option>
                    <option value="1">Своя цена</option>
                </select>
                <input type="text" placeholder="Цена..." id="cenarub" name="cenarub" />
            </div>

            <div class="field-for-edit" style="width: 47.5%;">
                <span class="edit-label">Телефон</span>
                <input type="text" placeholder="Телефон..." name="phone" id="tel" />
            </div>

            <div class='field-for-edit' style="width: 47.5%; margin-right: 5%;">
                <span class="edit-label">Срок размещения объявления</span>
                <div class="custom-select" style="width: 100%; margin: 0px">
                    <select class="selectb" id="srok" name="srok">
                        <option value="0">1 неделя</option>
                        <option value="1">2 недели</option>
                        <option value="2">1 месяц</option>
                    </select>
                </div>
            </div>

            <div class='field-for-edit for-edit-b'  style="width: 47.5%;">
                <span class="edit-label">Статус</span>
                <div class="custom-select" style="width: 100%; margin: 0px">
                    <select class="selectb" name="status">
                        <option value="1">Открыто</option>
                        <option value="0">Закрыто</option>
                    </select>
                </div>
            </div>

            <div class='field-for-edit'>
                <span class="edit-label">Местоположение</span>
                <div class="custom-select">
                    <select id="country" name="country" class="selectb">
                        <option value="">Страна</option>
                    </select>
                </div>

                <div class="custom-select">
                    <select name="region" id="region" class="selectb">
                        <option value="">Регион</option>
                    </select>
                </div>

                <div class="custom-select">
                    <select name="city" id="city" class="selectb">
                        <option value="">Город</option>
                    </select>
                </div>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Добавить фото</span>
                <div class="input-group" id="mediaFile">
                    <input class="upload-photo-input" type="text" style="height: 40px;"/>
                    <button class="upload-photo" id="upload" type="button"><img src="{{asset('asset/front/images/photo-camera.png')}}"/></button>
                    <span id="status" ></span>
                    <ul class="thumb-photos mclearfix" id="files"></ul>
                </div>
            </div>

            <div class="lenta-options">
                <input name="flag_comment"   value='1' type="checkbox" id="option1" class="checkbox" checked="checked">
                <span>Разрешить добавлять комментарии</span>
            </div>

            <div class="lenta-options" style="margin-top: 10px;">
                <input name="flag_email" type="checkbox" id="option2" value="1"  class="checkbox">
                <span>Получать уведомления о новых сообщениях на почту</span>
            </div>
            <input type="hidden" name="str_images" id="str_images" />
            <input type="hidden" name="str_video" id="str_video" />

           <!-- <div class="field-for-edit" style="margin-top: 25px;">
                <input value="Сохранить" class="save" type="submit"/>
                <a href="https://myldl.ru/profile/uslugi" class="cancel">Отмена</a>
            </div>
            -->
        </form>
    </div>
</section> 
    @push('js')
       
 @endpush
 
 
 
@endsection