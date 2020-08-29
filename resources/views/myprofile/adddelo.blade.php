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
        <li><a href="/">Главная</a></li><li><a href="/profile">Профиль</a></li><li class="active">Добавить дело</li>    </ol>


</div><script src="{{asset('asset/front/js/profile/add_delo.js')}}"></script>

<link href="{{asset('asset/front/js/datepicker/jquery-ui.css')}}" rel="stylesheet">
<script src="{{asset('asset/front/js/front/datepicker/jquery-ui.js')}}"></script>
<!-- AjaxUpload -->
<script type="text/javascript" src="{{asset('asset/front/js//jquery/ajaxupload.3.5.js')}}"></script>





<style>
    .add-button a { text-decoration: none; }
    .error { color: #FF0000; font-size: 10px; }
</style>

<script type="text/javascript">
    $(document).ready(function(){

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
                                            $("#files").append('<li id="img_' + img + '"><figure><img class="thumb" src="{{asset('storage/upload/uploads/')}}/' + response + '" alt="' + file + '" title="' + file + '" /><figcaption>' + (file.length > 10 ? file.substr(0, 8) + '..' : file) + '</figcaption></figure><a class="close" onclick="remove_img(' + img + ', \'' + orig_name + '\')"><img src="{{asset('asset/front/images/close.png')}}" alt="" /></a></li>');
                                            my_mas1.push(orig_name);
                                            document.getElementById('str_images').value = my_mas1;
                                            img++;
                                        }
                                    }
                                });

								var error_aName=1;//title fild
								var error_aDesc=1;//description
								var error_aStat=1;//curent status
								var error_country=1;
								var error_region=1;
								var error_aBudjet=1;
								var error_aTime=1;
								var error_aEffect=1;
								var error_aEffect=1;
								var error_aThank=1;
								
								$("#aName").blur(function(){
								length_input= $("#aName").val().length
								if(length_input<6)
								{
									$('#err_aName').html('<span style="color:red">Заголовок должен содержать более 6 символов</span>');
									error_aName=1
								}
								if(length_input>80)
								{
									$('#err_aName').html('<span style="color:red">Заголовок должен содержать менее 80 символов</span>');
									error_aName=1
								}
								if(length_input>6 && length_input<80)
								{
									error_aName=0;
									$('#err_aName').html('<span style="color:green">OK</span>');
								}
								
								});
								
								
								$('#aDesc').blur(function(){
									length_input= $("#aDesc").val().length
									if(length_input<20)
									{
								$('#err_aDesc').html('<span style="color:red"> Описание должено содержать более 20 символов</span>');
								error_aDesc=1;
									}
									if(length_input>5000)
									{
								$('#err_aDesc').html('<span style="color:red"> Описание должено содержать менее 5000 символов</span>');
								error_aDesc=1;
									}
									
									if(length_input>20 && length_input<5000)
								{
								error_aDesc=0;
									$('#err_aDesc').html('<span style="color:green">OK</span>');
								}
									
									
								})//Описание END
								
								$('#aStat').blur(function(){
									
									length_input= $("#aStat").val().length
									if(length_input<6)
									{
										$('#err_aStat').html('<span style="color:red"> Текущий статус должен содержать более 6 символов</span>');
										error_aStat=1
									}
									if(length_input>4000)
									{
										$('#err_aStat').html('<span style="color:red"> Текущий статус должен содержать менее 40000 символов</span>');
										error_aStat=1
									}
									if(length_input>6 && length_input<4000)
								   {
									error_aStat=0
									$('#err_aStat').html('<span style="color:green">OK</span>');
								   }
								})
								
								
								$('#add_delo_true').submit(function(){
									
									
									
									if(error_aName===1){
									event.preventDefault();	
									}
									if(error_aDesc===1){
									event.preventDefault();	
									}
									if(error_aStat===1){
									event.preventDefault();
									}
									if($("#country").val()===null || $("#country").val().length==0 ){
									
									$('#err_Locat').html('<span style="color:red">Не выбрана страна</span>');
										event.preventDefault();
									}
									
									if($("#region").val()==null || $("#region").val().length==0){
									
									$('#err_Locat').html('<span style="color:red">Не выбран регион</span>');
										event.preventDefault();
									}
									
									if($("#city").val()==null||$("#city").val().length==0 ){
									
									$('#err_Locat').html('<span style="color:red">Не выбран город</span>');
										event.preventDefault();
									}
									
									if($("#aBudjet").val().length>128 ){
									
									$('#err_aBudjet').html('<span style="color:red">Число символов не должно привышать 128 символов</span>');
										event.preventDefault();
									}
									
									
									if($("#aTime").val().length>128){
									
									$('#err_aTime').html('<span style="color:red">Число символов не должно привышать 128 символов</span>');
										event.preventDefault();
									}
								if($("#aEffect").val().length>256 ){
									
									$('#err_aEffect').html('<span style="color:red">Число символов не должно привышать 256 символов</span>');
										event.preventDefault();
									}
								 
								 
								});
								
								
                            });

</script>




<section>
    <div class="people-outside lenta-sobitii moya-anketa">
	    
   @include('myprofile.left')
 
<form class="right" action="/profile/store_delo" method="post" id="add_delo_true">
            {{ csrf_field() }}
            <p class="title">Добавить дело</p>

            <div class="field-for-edit">
                <span class="edit-label-str">Тип дела:</span>
                <input name="tip" type="radio" id="aType1" class="radio" value="1"  checked="true">
                <span class="radio-label">Индивидуальное</span>
                <input name="tip" type="radio" id="aType2" class="radio" value="2"  >
                <span class="radio-label">Коллективное</span>
            </div>

            <div class="field-for-edit" id="vhod_v_delo" style="display: none;">
                <span class="edit-label-str">Вход в дело:</span>
                <input class="radio" type="radio" id="choice-3" name="vhod_v_delo" value="1" checked="true" />
                <span class="radio-label">Открыть всем</span>
                <input class="radio" type="radio" id="choice-4" name="vhod_v_delo" value="2"  />
                <span class="radio-label">По запросу</span>
            </div>

            <div class="field-for-edit">
                <span class="edit-label-str">Коментарии:</span>
                <input name="comment_k_delu" type="radio" id="aCom1" class="radio"  value="all" checked="true">
                <span class="radio-label">Все</span>
                <input name="comment_k_delu" type="radio" id="aCom2" class="radio" value="reg" >
                <span class="radio-label">Только зарегистрированые</span>
                <input name="comment_k_delu" type="radio" id="aCom3" class="radio" value="none" >
                <span class="radio-label">Никто</span>
            </div>

            <div class="field-for-edit">
                <span class="edit-label-str">Статус:</span>
                <input class="radio" type="radio" id="choice-3_" name="status" value="1" checked="true" />
                <span class="radio-label">Открыто</span>
                <input class="radio" type="radio" id="choice-4_" name="status" value="0"  />
                <span class="radio-label">Закрыто</span>
            </div>

            <div class="field-for-edit">
                <span class="edit-label" >Заголовок   <span id="err_aName"></span></span> 
                <input type="text" class="tfi" id="aName" name="nazva" value="" placeholder="Заголовок..." />
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Описание  <span id="err_aDesc"></span> </span>
                <textarea placeholder="Описание..." rows="3" id="aDesc" name="opisanie"></textarea>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Текущий статус <span id="err_aStat"></span></span>
                <textarea placeholder="Текущий статус..." rows="3" id="aStat" name="tekuschiy_status"></textarea>
            </div>

            <div class='field-for-edit'>
                <span class="edit-label">Местоположение     <span id="err_Locat"></span></span>
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
                <span class="edit-label">Бюджет <span id="err_aBudjet"></span></span>
                <input type="text" placeholder="Бюджет..." id="aBudjet" name="bydzet" value="" />
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Затраченное время <span id="err_aTime"></span></span>
                <input type="text" placeholder="Затраченное время..." id="aTime" name="vremya" value="" />
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Эффект<span id="err_aEffect"></span></span>
                <textarea placeholder="Эффект..." id="aEffect" name="effekt"></textarea>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Для чего это делалось</span>
                <textarea placeholder="Для чего это делалось..." id="aWhy" name="dlya_chego"></textarea>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Благодарность</span>
                <textarea placeholder="Благодарность..." id="aThank" name="blagodarnost"></textarea>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Добавить фото</span>
                <input class="upload-photo-input" type="text" style="height: 40px;"/>
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
                <input value="Сохранить" class="save" type="submit"/>
                <a href="/profile/dela" class="cancel">Отмена</a>
            </div>
        </form>
    </div>
</section>
        

            @push('js')
        
         @endpush

@endsection