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
        <li><a href="https://myldl.ru/">Главная</a></li><li><a href="https://myldl.ru/profile">Профиль</a></li><li class="active">Добавить дело</li>    </ol>
</div><script src="https://myldl.ru//static/js/profile/add_delo.js"></script>

<link href="https://myldl.ru/application/views/front/datepicker/jquery-ui.css" rel="stylesheet">
<script src="https://myldl.ru/application/views/front/datepicker/jquery-ui.js"></script>


<!-- AjaxUpload -->
<script type="text/javascript" src="https://myldl.ru/application/views/front/js/ajaxupload.3.5.js"></script>


<style>
    .add-button a { text-decoration: none; }
    .error { color: #FF0000; font-size: 10px; }
</style>

<script type="text/javascript">
    $(document).ready(function(){

       
      optionsText='';
optionsText += '<option value="{{($delo->City->id)}}" SELECTED>{{($delo->City->name)}}</option>';
                    $("#city")
                        .append(optionsText );
optionsText='';
optionsText += '<option value="{{($delo->City->Region->id)}}" SELECTED>{{($delo->City->Region->name)}}</option>';
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
                optionsText += '<option value="425" SELECTED>{{($delo->country->name)}}</option>';
                
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
                    optionsText += '<option value="{{($delo->City->Region->id)}}" SELECTED>{{($delo->City->Region->name)}}</option>';
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
                    optionsText += '<option value="{{($delo->City->id)}}" SELECTED>{{($delo->City->name)}}</option>';
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



  $(function () {
                                img = 1 + my_mas1.length;
                                var btnUpload = $('#upload');
                                var status = $('#status');
                                $.ajaxSetup({
    
});
                                new AjaxUpload(btnUpload, {
                                    action: '/profile/ajax_upload',
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
                                            $("#files").append('<li id="img_' + img + '"><figure><img class="thumb" src="{{asset('storage/delo')}}/' + response + '" alt="' + file + '" title="' + file + '" /><figcaption>' + (file.length > 10 ? file.substr(0, 8) + '..' : file) + '</figcaption></figure><a class="close" onclick="remove_img(' + img + ', \'' + orig_name + '\')"><img src="https://myldl.ru/application/views/front/images/close-2.png" alt="" /></a></li>');
                                            my_mas1.push(orig_name);
                                            document.getElementById('str_images').value = my_mas1;
                                            img++;
                                        }
                                    }
                                });

                            });
})
</script>


<!-- ui-dialog -->
<div id="dialog" title="Прикрепить видео" style="display: none">
    <br />
    Вы можете прикрепить видео с сервиса Youtube, для этого просто введите часть ссылки на него, как показано на рисунке:<br /><br />
    <img src="https://myldl.ru/application/views/front/images/fox.jpg" style="padding-left:20px" /><br /><br />
    Прикрепить можно до 4-ех видео:<br /><br />
    http://www.youtube.com/watch?v=<input type="text" name="kod" value="" maxlength="20" /> <a style="cursor:pointer;" class="load_img">Прикрепить</a><br />
    http://www.youtube.com/watch?v=<input type="text" name="kod" value="" maxlength="20" /> <a style="cursor:pointer;" class="load_img">Прикрепить</a><br />
    http://www.youtube.com/watch?v=<input type="text" name="kod" value="" maxlength="20" /> <a style="cursor:pointer;" class="load_img">Прикрепить</a><br />
    http://www.youtube.com/watch?v=<input type="text" name="kod" value="" maxlength="20" /> <a style="cursor:pointer;" class="load_img">Прикрепить</a><br />
</div>
<!-- ui-dialog -->


<!-- ui-dialog -->
<div id="dialog" title="Прикрепить видео" style="display: none">
    <br />
    Вы можете прикрепить видео с сервиса Youtube, для этого просто введите часть ссылки на него, как показано на рисунке:<br /><br />
    <img src="https://myldl.ru/application/views/front/images/fox.jpg" style="padding-left:20px" /><br /><br />
    Прикрепить можно до 4-ех видео:<br /><br />
    http://www.youtube.com/watch?v=<input type="text" name="kod" value="" maxlength="20" /> <a style="cursor:pointer;" class="load_img">Прикрепить</a><br />
    http://www.youtube.com/watch?v=<input type="text" name="kod" value="" maxlength="20" /> <a style="cursor:pointer;" class="load_img">Прикрепить</a><br />
    http://www.youtube.com/watch?v=<input type="text" name="kod" value="" maxlength="20" /> <a style="cursor:pointer;" class="load_img">Прикрепить</a><br />
    http://www.youtube.com/watch?v=<input type="text" name="kod" value="" maxlength="20" /> <a style="cursor:pointer;" class="load_img">Прикрепить</a><br />
</div>
<!-- ui-dialog -->


<section>
    <div class="people-outside lenta-sobitii moya-anketa">
	    
   @include('myprofile.left')
 
<form class="right" action="/profile/delo/upload" method="post" id="add_delo_true">
            {{ csrf_field() }}
                @method('PUT')
            <p class="title">Добавить дело</p>

            <div class="field-for-edit">
                <span class="edit-label-str">Тип дела:</span>
                <input name="tip" type="radio" id="aType1" class="radio" value="1" <?if($delo->tip==1)echo 'checked="true"'?> >
                <span class="radio-label">Индивидуальное</span>
                <input name="tip" type="radio" id="aType2" class="radio" value="2"<?if($delo->tip==2)echo 'checked="true"'?>  >
                <span class="radio-label">Коллективное</span>
            </div>

            <div class="field-for-edit" id="vhod_v_delo" style="display: none;">
                <span class="edit-label-str">Вход в дело:</span>
                <input class="radio" type="radio" id="choice-3" name="vhod_v_delo" value="1" <?if($delo->vhod_v_delo==1)echo 'checked="true"'?> />
                <span class="radio-label">Открыть всем</span>
                <input class="radio" type="radio" id="choice-4" name="vhod_v_delo" value="2"  <?if($delo->vhod_v_delo==2)echo 'checked="true"'?> />
                <span class="radio-label">По запросу</span>
            </div>

            <div class="field-for-edit">
                <span class="edit-label-str">Коментарии:</span>
                <input name="comment_k_delu" type="radio" id="aCom1" class="radio"  value="all"<?if($delo->comment_k_delu==="all")echo 'checked="true"'?>>
                <span class="radio-label">Все</span>
                <input name="comment_k_delu" type="radio" id="aCom2" class="radio" value="reg"  <?if($delo->comment_k_delu==="reg")echo 'checked="true"'?> >
                <span class="radio-label">Только зарегистрированые</span>
                <input name="comment_k_delu" type="radio" id="aCom3" class="radio" value="none"  <?if($delo->comment_k_delu==="none")echo 'checked="true"'?> >
                <span class="radio-label">Никто</span>
            </div>

            <div class="field-for-edit">
                <span class="edit-label-str">Статус:</span>
                <input class="radio" type="radio" id="choice-3_" name="status" value="1" <?if($delo->status==1)echo 'checked="true"'?> />
                <span class="radio-label">Открыто</span>
                <input class="radio" type="radio" id="choice-4_" name="status" value="0"  <?if($delo->status==0)echo 'checked="true"'?> />
                <span class="radio-label">Закрыто</span>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Заголовок</span>
                <input type="text" class="tfi" id="aName" name="nazva" value="{{$delo->nazva}}" placeholder="Заголовок..." />
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Описание</span>
                <textarea placeholder="Описание..." rows="3" id="aDesc" name="opisanie">{{$delo->opisanie}}</textarea>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Текущий статус</span>
                <textarea placeholder="Текущий статус..." rows="3" id="aStat" name="tekuschiy_status">{{$delo->tekuschiy_status}}</textarea>
            </div>

            <div class='field-for-edit'>
                <span class="edit-label">Местоположение</span>
                <div class="custom-select">
                    <select id="country" name="country" class="selectb">
                        <option value="">Страна</option>
	                                        </select>
                </div>

                <div class="custom-select">
                    <select id="region" name="region" class="selectb">
                        <option value="">Регион</option>
	                                        </select>
                </div>

                <div class="custom-select">
                    <select id="city" name="city" class="selectb">
                        <option value="">Город</option>
	                                        </select>
                </div>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Бюджет</span>
                <input type="text" placeholder="Бюджет..." id="aBudjet" name="bydzet" value="{{$delo->bydzet}}" />
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Затраченное время</span>
                <input type="text" placeholder="Затраченное время..." id="aTime" name="vremya" value="{{$delo->vremya}}" />
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Эффект</span>
                <textarea placeholder="Эффект..." id="aEffect" name="effekt">{{$delo->effekt}}</textarea>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Для чего это делалось</span>
                <textarea placeholder="Для чего это делалось..." id="aWhy" name="dlya_chego">{{$delo->dlya_chego}}</textarea>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Благодарность</span>
                <textarea placeholder="Благодарность..." id="aThank" name="blagodarnost">{{$delo->blagodarnost}}</textarea>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Добавить фото</span>
                <input class="upload-photo-input" type="text"  value="{{$delo->images}}" style="height: 40px;"/>
                <button class="upload-photo addFoto" id="upload" type="button"><img src="{{asset('asset/front/images/photo-camera.png')}}"/></button>
                <div class="input-group" id="mediaFile">
                    <ul class="thumb-photos mclearfix" id="files">
			                                </ul>
                </div>
            </div>
               
            <div class="field-for-edit">
                <span class="edit-label">Добавить видео</span>
                <input class="upload-photo-input" type="text" style="height: 40px;"/>
                <button class="upload-photo addVideo upload_video" type="button" style="padding-bottom: 6px;"><img src="{{asset('asset/front/images/video-camera.png')}}"/></button>
            </div>
            <span id="count_video"></span><br><br>
            <div class="video_list">
		                    </div>
            <input type="hidden" name="str_images" value="" id="str_images" />
            <input type="hidden" name="str_video" value="" id="str_video" />

            <div class="field-for-edit" style="margin-top: 25px;">
                <input type="hidden"  name="id" value="{{$delo->id}}">
                <input value="Сохранить" class="save" type="submit"/>
                <a href="https://myldl.ru/profile/dela" class="cancel">Отмена</a>
            </div>
        </form>
    </div>
</section>
        

            @push('js')
        
         @endpush

@endsection