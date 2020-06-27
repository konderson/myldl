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
        <li><a href="/">Главная</a></li><li><a href="/profile/index">Профиль</a></li><li class="active">Редактировать Профиль</li>    </ol>
</div>
<script type="text/javascript" src="{{asset('asset/front/js//jquery/ajaxupload.3.5.js')}}"></script>
 
<link href="{{asset('asset/front/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
                <script src="{{asset('asset/front/js/jquery/jquery.mask.min.js')}}"></script>
                <script src="{{asset('asset/front/daterangepicker/moment.min.js')}}"></script>
                <script src="{{asset('asset/front/daterangepicker/ru.js')}}"></script>
                <script src="{{asset('asset/front/daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function(){
		
		
		optionsText='';
optionsText += '<option value="<?php if(isset($user->person->City->id)) echo $user->person->City->id ?>" SELECTED><?php  if(isset($user->person->City->id))  echo $user->person->City->name ?></option>';
                    $("#city")
                        .append(optionsText );
optionsText='';
optionsText += ' <option value=" <?php if(isset($user->person->City->Region->id)) echo $user->person->City->Region->id ?> " SELECTED><?php if(isset($user->person->City->Region->name)) echo $user->person->City->Region->name?></option>';
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
                optionsText += '<option value=" <?php if($user->person->Country->id) echo $user->person->Country->id ?>" SELECTED><?php if(isset($user->person->Country->name)) echo $user->person->Country->name ?></option>';
                
                $("#country")
                    .append(optionsText + msg)
                    .data("selectBox-selectBoxIt").refresh();
                /*if(user_country > 0) {
                    $('#country option[value="'+user_country+'"]').prop('selected', true).change();
                    user_country = 0;
                }*/
            }
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
                //document.location.href = "https://myldl.ru/profile/del_avatar/"+avatar;

                //$.post('https://myldl.ru/profile/del_avatar', {avatar: avatar});

                $.ajax({
                    type: 'post',
                    url: 'https://myldl.ru/profile/del_avatar',
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

    });

    // Загрузка картинок
    $(function(){
        img=1;
        var btnUpload=$('#upload');
        var status=$('#status');
		 var photo=$('#photo_curent').val();
                                
		    new AjaxUpload(btnUpload, {
            action: '/profile/avatar/ajax_upload',
            name: 'userfile',
            data : {
                _token: $('meta[name="csrf-token"]').attr('content'),
				'photo':photo,
            },
            onSubmit: function(file, ext){
                 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                    // extension is not allowed
                    status.text('Поддерживаемые форматы JPG, PNG или GIF');
                    return false;
                }
                status.text('Загружается...');
            },
            onComplete: function(file, response){
                //On completion clear the status
                status.text('');
                //Add uploaded file to list
                if(response==="error"){
                    $('<li></li>').appendTo('#files').text('Файл не загружен '+file).addClass('error');
                } else {
                    // response - назва зменшеного файлу
                    $(".add-button").css('display', 'none');
                    orig_name = response.replace("_thumb", "");
                    $("#files").empty().append(
                        '<li id="img_'+img+'">' +
                        '<figure>' +
                        '<img class="thumb" src="{{asset('storage/avatar/')}}/'+response+'" alt="" />' +
                        '</figure>' +
                        '<!--<a class="close" onclick="remove_img('+img+', \''+orig_name+'\')"><img src="{{asset('asset/front/images/close-2.png')}}" alt="" /></a>-->' +
                    '</li>');
					$('#name_photo').val(orig_name);
					
                    //location.reload(0);
                }
            }
        });

    });
</script>

<style>
    .close, .close:hover{
        background-color: #B3CB31;
        border-color: #B3CB31;
        opacity: 1;
        text-shadow:  none;
        float: none;
    }
    .thumb-photos {
        padding: 0;
        list-style: none;
    }
    .thumb-photos li {
        margin-right: 15px;
        float: left;
    }
    .thumb-photos figure {
        max-width: 100px;
        margin: 0;
    }
</style>

<section>
    <div class="people-outside lenta-sobitii moya-anketa">
  @include('myprofile.left')	    
       <form class="right" action="{{route('profile.update',Auth::user()->id)}}" method="post">
           @csrf
        @method('PUT')
            <input type="hidden" name="ci_csrf_token" value="">
            <p class="title">Изменение данных </p>
            <script>
                $(document).ready(function(){
                    if ($("input#h_need:checked").length === 1 ) {
                        $("#help_list").hide();
                    }

                    $("input#h_want").change(function(){
                        $('#help_list').show();
                    });
                    $("input#h_need").change(function(){
                            $('#help_list').hide();
                    });

                    if ( $("input#more:checked").length === 0 ) {
                        $("input#more_text").hide().val('');
                        $("input#more_text").value = '';
                    } else {
                        $("input#more_text").show();
                    }

                    $('input#more').click(function() {

                        if ( $("input#more:checked").length === 0 ) {
                            $("input#more_text").hide().val('');
                            $("input#more_text").value = '';
                        } else {
                            $("input#more_text").show();
                        }
                    });
                });

            </script>
            <div class="field-for-edit">
                <span class="edit-label-str">Кто вы:</span>
                <label class="radio-label">
                    <input type="radio" id="h_need" name="help" value="need" checked/> Мне нужна помощь</label>
                <label class="radio-label">
                    <input type="radio" id="h_want" name="help" value="want" /> Я хочу помогать</label>
                <div class="help_list" id="help_list">
                    <label>Дополнительно:</label>
                                        <ul style="
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    grid-gap: 1rem;
                    list-style-type: none;">

                        <li><label class="radio-label"><input type="checkbox" name="help_additional[1]" /> принимать участие в поисках пропавшего</label></li><li><label class="radio-label"><input type="checkbox" name="help_additional[2]" /> есть автомобиль</label></li><li><label class="radio-label"><input type="checkbox" name="help_additional[3]" /> об звон больниц</label></li><li><label class="radio-label"><input type="checkbox" name="help_additional[4]" /> есть Квадроцикл / Cнегоход</label></li><li><label class="radio-label"><input type="checkbox" name="help_additional[5]" /> печать ориентировок</label></li><li><label class="radio-label"><input type="checkbox" name="help_additional[6]" /> мелкий ремонт</label></li><li><label class="radio-label"><input type="checkbox" name="help_additional[7]" /> можно переночевать на 1 ночь</label></li><li><label class="radio-label"><input type="checkbox" name="help_additional[8]" /> есть работа, не требующая специальной квалификации</label></li><li><label class="radio-label"><input type="checkbox" id="more" name="help_additional[9]" value="more" /> другое (указать)</label><input type="text" id="more_text" name="more_text" placeholder="другое (указать)" maxlength="200" value="" /></li></li>						</ul>
                </div>
            </div>

            <div class="field-for-edit">
                <label for="pOrgName" class="edit-label">Имя / Название организации</label>
                <input type="text" id="pOrgName" name="name" placeholder="Имя / Название организации..." value="{{isset(Auth::user()->person->name) ? Auth::user()->person->name : '' }}" />
	                        </div>

            <div class='field-for-edit'>
                <span class="edit-label">Дата рождения</span>
               
                <script type="text/javascript">
                    $(function() {

                        $('#birthday').daterangepicker({
                            singleDatePicker: true,
                            showDropdowns: true,
                            autoUpdateInput: false,
                            minYear: 1901,
                            locale: {
                                format: 'YYYY-MM-DD',
                                cancelLabel: 'Clear'
                            },
                        }).on('cancel.daterangepicker', function(ev, picker) {
                            $(this).val('');
                        }).on('apply.daterangepicker', function(ev, picker) {
                            $(this).val(picker.startDate.format('YYYY-MM-DD'));
                        }).mask('9999-99-99');
                    });
                </script>
                <input type="text" id="birthday" name="birthday" placeholder="Дата рождения" maxlength="10" value="{{isset(Auth::user()->person->birthday) ? Auth::user()->person->birthday : '' }}" />
	                        </div>
            <div class='field-for-edit'>
                <label class="edit-label" for="country">Местоположение</label>
                <div class="custom-select tsp">
                    <select class="selectpicker selectb form-control" id="country" name="country" data-id="0">
                        <option value="">Страна</option>
                    </select>
                                    </div>

                <div class="custom-select tsp">
                    <select class="selectpicker selectb form-control" id="region" name="region" data-id="0">
                        <option value="">Регион</option>
                    </select>
                                    </div>

                <div class="custom-select tsp">
                    <select class="selectpicker selectb form-control" id="city" name="city" data-id="0">
                        <option value="">Город</option>
                    </select>
					                </div>
            </div>

            <div class="field-for-edit">
                <label for="hMood" class="edit-label">О себе / Об организации</label>
                <textarea placeholder="О себе / Об организации..." id="hMood" name="about">{{Auth::user()->person->about}}</textarea>
            </div>

            <div class="field-for-edit">
                <span class="edit-label-str">Пол:</span>
                <label class="radio-label"><input type="radio" name="pol" value="1" <?php if(Auth::user()->person->pol==1) echo "checked" ?>  /> Мужской</label>
                <label class="radio-label"><input type="radio" name="pol" value="2" <?php if(Auth::user()->person->pol==2) echo "checked" ?> /> Женский</label>
            </div>

            <div class="field-for-edit">
                <label for="pStatus" class="edit-label">Статус</label>
                <textarea placeholder="Статус..." id="pStatus" name="status_str">{{Auth::user()->person->status_str}}</textarea>
            </div>

            <div class='field-for-edit'>
			<!--
                <div class="custom-select">
                    <label for="pMail" class="edit-label">E-mail</label>
                    <input type="text" placeholder="E-mail..."  value="{{Auth::user()->email}}" id="pMail" name="email" />
                </div>
                        -->
                <div class="custom-select">
                    <label for="pSkype" class="edit-label">Skype / ICQ</label>
                    <input type="text" placeholder="Skype / ICQ..." id="pSkype" name="skype" value="{{Auth::user()->person->skype}}" />
                </div>

                <div class="custom-select">
                    <label for="psite" class="edit-label">Сайт</label>
                    <input type="text" placeholder="Сайт..." id="psite" name="site" value="{{Auth::user()->person->site}}" />
                </div>
            </div>

            <div class="field-for-edit">
                <label for="pdolzhnost" class="edit-label">Должность</label>
                <input type="text" placeholder="Должность..." id="pdolzhnost" name="dolzhnost" value="{{Auth::user()->person->dolznost}}" />
            </div>

            <div class="field-for-edit">
                <label for="pdohod" class="edit-label">Доход в месяц</label>
                <input type="text" placeholder="Доход в месяц..." id="pdohod" name="dohod" value="{{Auth::user()->person->dohod}}" />
            </div>

            <div class="field-for-edit">
                <label for="pUvlecheniya" class="edit-label">Увлечения</label>
                <textarea placeholder="Увлечения..." id="pUvlecheniya" name="hobbi">{{Auth::user()->person->hobbi}}</textarea>
            </div>

            <div class="field-for-edit">
                <div class="mediaform" style="overflow: hidden;margin-bottom: 10px;clear: left;">
                    <button class="upload-photo" id="upload" style="width: auto; padding-left: 40px;"><img src="{{asset('asset/front/images/photo-camera.png')}}"/>Добавить фото</button>
                                        <span id="status"></span>
                    <input type="file" name="userfile" id="userfile" style="display: none;">
                </div>
		                            <span id="status"></span>
                    <ul class="thumb-photos mclearfix" id="files">
                    </ul>
		                    </div>
               <input type="hidden" id="name_photo" name="name_photo" />
            <div class="field-for-edit" style="margin-top: 25px;">
                <input value="Сохранить изменения" class="save" type="submit"/>
                <a href="/profile/index" class="cancel">Отмена</a>
            </div>
        </form>
    </div>
</section> 






 @push('js')
        
         @endpush

@endsection