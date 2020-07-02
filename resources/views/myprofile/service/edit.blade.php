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
        <li><a href="/">Главная</a></li><li><a href="/profile">Профиль</a></li><li class="active">Редактировать объявление</li>    </ol>
</div>
<!-- AjaxUpload -->
<script type="text/javascript" src="{{asset('asset/front/js//jquery/ajaxupload.3.5.js')}}"></script>
<!-- jQuery Masked Input Plugin -->
<script src="{{asset('asset/front/js/js/jquery.maskedinput.js')}}"></script>
<script>
    $(function(){
        $("input[name=tel]").mask("+9 (999) 999-99-99");
    })
</script>
<style>
    .add-button a {
        text-decoration: none;
    }

    .error {
        color: #FF0000;
        font-size: 10px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        
        if(<?php echo $serv->price?>>0){
            $("#cenarub").show();
        }
        
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
           if(<?php echo $serv->price?>>0){
            $("#cenarub").show();
        }
      
        
      optionsText='';
optionsText += '<option value="{{($serv->City->id)}}" SELECTED>{{($serv->City->name)}}</option>';
                    $("#city")
                        .append(optionsText );
optionsText='';
optionsText += '<option value="{{($serv->City->Region->id)}}" SELECTED>{{($serv->City->Region->name)}}</option>';
                    $("#region")
                        .append(optionsText );

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
                //$("#country").append('<option value="">Страна</option>'+msg).data("selectBox-selectBoxIt").refresh();
                var optionsText = '';
                optionsText += '<option value="">Страна</option>';
                optionsText += '<option value="425" SELECTED>{{($serv->country->name)}}</option>';
                
                $("#country")
                    .append(optionsText + msg)
                    .data("selectBox-selectBoxIt").refresh();
                /*if(user_country > 0) {
                    $('#country option[value="'+user_country+'"]').prop('selected', true).change();
                    user_country = 0;
                }*/
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
                    
                    var optionsText = '<option value="">Регион</option>';
                    optionsText += '<option value="{{($serv->City->Region->id)}}" SELECTED>{{($serv->City->Region->name)}}</option>';
                    $("#region")
                        .append(optionsText + msg)
                        .data("selectBox-selectBoxIt").refresh();
                    
                   /* $("#region").append('<option value="">Регион</option>'+msg).data("selectBox-selectBoxIt").refresh();
                    if(user_region > 0) {
                        $('#region option[value="'+user_region+'"]').prop('selected', true).change();
                        user_region = 0;
                    }*/
                }
            });
            $("#city").empty();
            $.ajax({
                type: "GET",
                url: "/ajax_get_city/"+$(this).val(),
                dataType: "html",
                success: function(msg){
                    var optionsText = '<option value="">Город</option>';
                    optionsText += '<option value="{{($serv->City->id)}}" SELECTED>{{($serv->City->name)}}</option>';
                    $("#city")
                        .append(optionsText + msg)
                        .data("selectBox-selectBoxIt").refresh();
                    
                    
                //$("#city").append('<option value="">Город</option>'+msg).data("selectBox-selectBoxIt").refresh();
                   
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

        btn_text = 'Добавить фото';
        del_btn  = '';
        if(exists_image === 1) {
            btn_text = 'Изменить фото';
            del_btn  = '&nbsp;<a class=" btn btn-default tab-btn close" href="#">Удалить</a>';
        }

        $('.mediaform .close').click(function(e){
            e.preventDefault();
            //alert($('#kartinka').attr("nazva"));
            var avatar = $('#kartinka').attr("nazva");
            if (confirm("Вы действительно хотите удалить аватар?")) {
               

                $.ajax({
                    type: 'post',
                    url: '/profile/del_avatar',
                    data: {avatar: avatar},
                    success: function(){
                        location.reload(0);
                    }
                })

                //$(".mediaform").html('<div class="add-button"><a href="#" id="upload">Добавить фото</a></div><span id="status" ></span><ul class="thumb-photos mclearfix" id="files"></ul><input type="file" name="userfile" style="position: absolute; margin: -5px 0px 0px -175px; padding: 0px; width: 220px; height: 30px; font-size: 14px; opacity: 0; cursor: pointer; display: none; z-index: 2147483583; top: 1250px; left: 669px;">');
                //image_add();
                //$(".img-box").html('<img alt="" src="https://myldl.ru/application/views/front/images/no_logo.jpg">');
            }
        });


      
        


        

        $('.form_submit').click(function () {
            if ($('select[name=razdel_id]').val() == 0) {
                $('select[name=razdel_id]').css("border-color", "#D93600");
                alert('Выберите раздел');
            }
            if ($("textarea[name=tema]").val() == '') {
                $("textarea[name=tema]").css("border-color", "#D93600");
                alert('Заполните поле "Тема"');
            }
            if ($("#opisanie").val() == '') {
                $("#opisanie").css("border-color", "#D93600");
                alert('Заполните поле "Описание"');
            }
            if ($("textarea[name=tema]").val() != '' & $("#opisanie").val() != '' & $('select[name=razdel_id]').val() != 0) {
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
                                            $("#files").append('<li id="img_' + img + '"><figure><img class="thumb" src="{{asset('storage/help')}}/' + response + '" alt="' + file + '" title="' + file + '" /><figcaption>' + (file.length > 10 ? file.substr(0, 8) + '..' : file) + '</figcaption></figure><a class="close" onclick="remove_img(' + img + ', \'' + orig_name + '\')"><img src="https://myldl.ru/application/views/front/images/close-2.png" alt="" /></a></li>');
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
       <form class="right" action="/usluga/update/{{$serv->id}}" method="POST">
           {{ csrf_field() }}
             @method('PUT')
            <p class="title">Редактировать объявление</p>
            <input type="hidden" name="id"  value="{{$serv->id}}">

            <div class="field-for-edit">
                <span class="edit-label">Заголовок</span>
                <input type="text" placeholder="Заголовок..." id="tema" name="tema" value="{{$serv->title}}"/>
            </div>

            <div class='field-for-edit'>
                <span class="edit-label">Раздел</span>
                <div class="custom-select" style="width: 100%; margin: 0;">
                    <select class="selectb" id="razdel_id" name="razdel_id">
                        <option value="0" >Раздел</option>
	                    <option value="1" <?php if($serv->razdel_id==1) echo 'selected="selected"' ?>>Транспорт</option>
	                    <option value="2"  <?php if($serv->razdel_id==2) echo 'selected="selected"' ?>>Недвижимость</option>
	                    <option value="3" <?php if($serv->razdel_id==3) echo 'selected="selected"' ?>>Работа</option>
	                    <option value="4" <?php if($serv->razdel_id==4) echo 'selected="selected"' ?>>Вещи</option>
	                    <option value="5" <?php if($serv->razdel_id==5) echo 'selected="selected"' ?>>Для быта</option>
	                    <option value="6" <?php if($serv->razdel_id==6) echo 'selected="selected"' ?>>Бытовая электроника</option>
	                    <option value="7" <?php if($serv->razdel_id==8) echo 'selected="selected"' ?>>Хобби и отдых</option>
	                    <option value="8" <?php if($serv->razdel_id==9) echo 'selected="selected"' ?>>Животные</option>
	                    <option value="9" <?php if($serv->razdel_id==2) echo 'selected="selected"' ?>>Бизнес</option>  
	                    </select>
                </div>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Описание</span>
                <textarea placeholder="Описание..." id="opisanie" name="opisanie">{{$serv->description}}</textarea>
                <span class="error"></span>
            </div>

            <div class="field-for-edit" style="width: 47.5%; margin-right: 5%;">
                <span class="edit-label">Цена</span>
                <select class="selectb" id="cena" name="cena">
                    <option value="0" <?php if($serv->price<0)echo('selected="selected"')?>>Бесплатно</option>
                    <option value="1" <?php if($serv->price>0)echo('selected="selected"')?>>Своя цена</option>
                </select>
                <input type="text"    placeholder="Цена..." id="cenarub" name="cenarub" <?php if($serv->price>0)echo('style="display:block"')?> value="{{$serv->price}}"/>
            </div>

            <div class="field-for-edit" style="width: 47.5%;">
                <span class="edit-label">Телефон</span>
                <input type="text" placeholder="Телефон..." name="tel" id="tel" value=""/>
            </div>

            <div class='field-for-edit' style="width: 47.5%; margin-right: 5%;">
                <span class="edit-label">Срок размещения объявления</span>
                <div class="custom-select" style="width: 100%; margin: 0px">
                    <select class="selectb" id="srok" name="srok">
                        <option value="0"></option>
                        <option value="0" <?php if($serv->srok==0)echo'selected="selected"' ?> >
                            1 неделя
                        </option>
                        <option value="1"  <?php if($serv->srok==1)echo'selected="selected"' ?> >
                            2 недели
                        </option>
                        <option value="2"  <?php if($serv->srok==2)echo'selected="selected"' ?> >
                            1 месяц
                        </option>
                    </select>
                </div>
            </div>

            <div class='field-for-edit'  style="width: 47.5%;">
                <span class="edit-label">Статус</span>
                <div class="custom-select" style="width: 100%; margin: 0px">
                    <select class="selectb" name="status">
                        <option value="1" <?php if($serv->status==1)echo'selected="selected"' ?> >
                            Открыто
                        </option>
                        <option value="0"  <?php if($serv->status==0)echo'selected="selected"' ?>   >
                            Закрыто
                        </option>
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
                    <input class="upload-photo-input" type="text"/>
                    <button class="upload-photo" id="upload" type="button"><img src="{{asset('asset/front/images/photo-camera.png')}}"/></button>
                    <span id="status" ></span>
                    <ul class="thumb-photos mclearfix" id="files">
	                                        </ul>
	                                         <ul class="thumb-photos mclearfix remdiv" id="myDiv">
                    <li    style="list-style: none;"id="img_1"><figure><img class="thumb" src="{{asset('storage/help/'.$serv->getPhoto($serv->images))}}" alt="{{$serv->title}}" title="{{$serv->title}}" /></figure><a class="close" ><img src="{{asset('asset/front/images/close.png')}}" alt=""></a></li>                </ul>
                </div>
            </div>

            
            <div class="lenta-options">
                <input name="flag_comment"   value='1' type="checkbox" id="option1" class="checkbox" <?php if($serv->flag_coment==1) echo 'checked="checked"'?>>
                <span>Разрешить добавлять комментарии</span>
            </div>

            <div class="lenta-options" style="margin-top: 10px;">
                <input name="flag_email" type="checkbox" id="option2" value="1"     <?php if($serv->flag_email==1) echo 'checked="checked"'?>class="checkbox">
                <span>Получать уведомления о новых сообщениях на почту</span>
            </div>
            
            
            <input type="hidden" name="str_images" id="str_images" />
            <input type="hidden" name="str_video" id="str_video" />
      

            <div class="field-for-edit" style="margin-top: 25px;">
                <input value="Сохранить" class="save" type="submit"/>
                <a href="/profile/uslugi" class="cancel">Отмена</a>
            </div>
        </form>
    </div>
</section>      
              
              
 @push('js')
       
 @endpush
 @endsection