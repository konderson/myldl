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
        <li><a href="/">Главная</a></li><li><a href="/myprofile/index">Профиль</a></li><li class="active">Редактировать взаимопомощь</li>    </ol>
</div>﻿
<!-- AjaxUpload -->
<script type="text/javascript" src="{{asset('asset/front/js//jquery/ajaxupload.3.5.js')}}"></script>
<!-- сортировка таблицы -->
<script src="{{asset('asset/front/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/front/js/jquery.maskedinput.js')}}"></script>

<style>
    .add-button a {
        text-decoration: none;
    }

    .error {
        color: #FF0000;
        font-size: 10px;
    }
</style>



       <section>
        <div class="people-outside lenta-sobitii moya-anketa">
	    
         @include('myprofile.left')
        <form class="right" action="/profile/update/{{$help->id}}" method="POST" id="helpForm" >
            {{ csrf_field() }}
             @method('PUT')
                <input type="hidden" id="hashAddUslugaID" name="ci_csrf_token" value="">
            <p class="title">Добавить заявку</p>
            <input type="hidden" name="str_images"
                   value=""
                   id="str_images"/>

            <div class='field-for-edit'>
                <span class="edit-label">Раздел <span id="err_type"></span></span>
                <div class="custom-select">
                    <select name="type" id="department" class="selectb">
                        <option selected value="0">Раздел</option>
                        <option value="1" <?if($help->type==1) echo 'SELECTED' ?>>
                            Хочу помочь
                        </option>
                        <option value="2" <?if($help->type==2) echo 'SELECTED' ?>>
                            Нужна помощь
                        </option>
                        <option value="3" <?if($help->type==3) echo 'SELECTED' ?>>
                            Ищу человека
                        </option>
                    </select>
                </div>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Заголовок id="err_title"></span></span>
                <input type="text" placeholder="Заголовок..." name="title" id="title" value="{{$help->title}}"/>
                <span class="error"></span>
            </div>

            <div class="field-for-edit">
                <span class="edit-label">Описание id="err_description"></span></span>
                <textarea placeholder="Описание..." id="description" name="description">{{$help->description}}</textarea>
                <span class="error"></span>
            </div>

            <div class='field-for-edit'>
                <div class="custom-select">
                    <span class="edit-label">E-mail</span>
                    <input type="text" placeholder="E-mail..." name="email" value="{{$help->email}}"/>
                    <span class="error"></span>
                </div>

                <div class="custom-select">
                    <span class="edit-label">Телефон  <span id="err_phone"></span></span>
                    <input type="text" placeholder="Телефон..." name="phone"  id="tel" value="{{$help->phone}}"/>
                    <span class="error"></span>
                </div>

                <div class="custom-select">
                    <span class="edit-label">Соц. сети <span id="err_cociality"></span> </span>
                    <input type="text" placeholder="Соц. сети..." name="cocial" id="social"" value="{{$help->cocial}}"/>
                    <span class="error"></span>
                </div>
            </div>

            <div class='field-for-edit'>
                <span class="edit-label">Местоположение <span id="err_Locat"></span> </span>
                <div class="custom-select">
                    <select name="country" id="country" class="selectb">
                        <option value="0">Страна</option>
                                            </select>
                </div>

                <div class="custom-select">
                    <select id="region" name="region" class="selectb">
                        <option value="">Регион</option>
                                            </select>
                </div>

                <div class="custom-select">
                    <select name="city" id="city" class="selectb">
                        <option value="">Город</option>
                                            </select>
                </div>
            </div>

            <div class='field-for-edit'>
                <span class="edit-label">Cтатус</span>
                <div class="custom-select">
                    <select name="status" id="hStatus" class="selectb">
                        <option value="">Статус</option>
                        <option value="1" <?if($help->status==1)echo 'SELECTED '?>>
                            Действует
                        </option>
                        <option value="0"  <?if($help->status==0)echo 'SELECTED'?>>
                            Архив
                        </option>
                    </select>
                </div>
            </div>
            <!--
            <div class='field-for-edit forpeople'  style="display: none">
                <span class="edit-label">ФИО</span>
                <input type="text" placeholder="ФИО" name="name" value=""/>
            </div>

            <div class="field-for-edit forpeople"   style="display: none">
                <span class="edit-label">Возраст</span>
                <input type="text" placeholder="Возраст..." value="" name="age"/>
            </div>

            <div class="field-for-edit forpeople"  style="display: none">
                <span class="edit-label">Приметы</span>
                <textarea placeholder="Приметы..." name="primeti"></textarea>
            </div>

            <div class="field-for-edit forpeople"  style="display: none">
                <span class="edit-label">Где видели последний раз</span>
                <textarea name="where" placeholder="Где видели последний раз..."></textarea>
            </div>-->

            <div class="field-for-edit">
                <span class="edit-label">Добавить фото</span>
                <div class="input-group" id="mediaFile">
                    <input class="upload-photo-input" type="text"/>
                     <input type="hidden" name="photo_curent" id="photo_curent" value="{{$help->images}}">
                      <input type="hidden" name="help_id" value="{{$help->id}}">
                    <button class="upload-photo addFoto"    id="upload"    type="button"><img src="{{asset('asset/front/images/photo-camera.png')}}"/></button>
                    <span id="status"></span>
                </div>
                <ul class="thumb-photos mclearfix" id="files">
                                    </ul>
            </div>

                <ul class="thumb-photos mclearfix remdiv" id="myDiv">
                    <li    style="list-style: none;"id="img_1"><figure><img class="thumb" src="{{asset('storage/upload/uploads'.$help->images)}}" alt="{{$help->title}}" title="{{$help->title}}" /></figure><a class="close" ><img src="{{asset('asset/front/images/close.png')}}" alt=""></a></li>                </ul>
            
            <div class="field-for-edit" style="margin-top: 25px;">
                <input value="Сохранить" class="save" type="submit"/>
                <a href="/profile/vzaimopomoshi" class="cancel">Отмена</a>
            </div>
        </form>
    </div>
</section>
       <!-- AjaxUpload -->

        <script src="{{asset('asset/front/js/profile/add_delo.js')}}"></script>
         <script type="text/javascript">
    $(document).ready(function(){
        
		$("#helpForm").submit(function(){
			 error_locate='';
			 $('#err_Locat').empty();;
			 $('#err_title').empty();;
			 $('#err_description').empty();;
			 $('#err_cociality').empty();
			 $('#err_cenarub').empty();
			 $('#err_type').empty();
			
			 

		
		if($("#title").val().length==0)
			{
			$('#err_title').html('<span style="color:red">Поле не может быть пустым !</span>');
	          event.preventDefault() 
			} else if($("#tema").val().length>80)
			{
				$('#err_title').html('<span style="color:red">Поле не может привышать длину 80 символов !</span>');
			}
		
		   if($("#description").val().length==0)
			{
			$('#err_description').html('<span style="color:red">Поле не может быть пустым !</span>');
	          event.preventDefault() 
			} else if($("#opisanie").val().length>1000)
			{
				$('#err_description').html('<span style="color:red">Поле не может привышать длину 1000 символов !</span>');
			}
	
		if($("#department").val().length==0  || $("#department").val().length==null || $("#department").val()==0)
			{
			$('#err_type').html('<span style="color:red"> Выберите раздел объявление !</span>');
				event.preventDefault() 
			}
			
			if($("#tel").val().length==0)
			{
			$('#err_phone').html('<span style="color:red">Поле не может быть пустым  !</span>');
				event.preventDefault() 
			}
			if($("#tel").val().length>40)
			{
			$('#err_phone').html('<span style="color:red">Привышенно количество символов  !</span>');
				event.preventDefault() 
			}
			if($("#social").val().length>100)
			{
			$('#err_cociality').html('<span style="color:red">Привышенно количество символов  !</span>');
				event.preventDefault() 
			}
			if($("#country").val().length==0)
			{
				error_locate=error_locate+"Не выбрана страна , ";
			$('#err_Locat').html('<span style="color:red">'+error_locate+'</span>');
	          event.preventDefault() 
			}
			alert($("#city").val().length)
			if($("#region").val().length==0)
			{alert('dd');
				error_locate=error_locate+"Не выбран регион , ";
			 $('#err_Locat').html('<span style="color:red">'+error_locate+'</span>');
	          event.preventDefault() ;
			}
			
			if($("#city").val().length==0)
			{
				error_locate=error_locate+"Не выбран город  ";
			 $('#err_Locat').html('<span style="color:red">'+error_locate+'</span>');
	          event.preventDefault() ;
			}
			
			
		});
		
		
        $('.close').click(function(){
             $.ajax({
   url:"/help/ajax_delete",
   method:"POST",
   
   data:{'id':{{$help->id}},'name':'{{$help->images}}'},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
       
       if(data.error){
        alert(data.error)
        
       }
       else{
              
          $('#myDiv').remove(); 
       }
    
   }
  
  });
        
         
        });
        
optionsText='';
optionsText += '<option value="{{($help->City->id)}}" SELECTED>{{($help->City->name)}}</option>';
                    $("#city")
                        .append(optionsText );
optionsText='';
optionsText += '<option value="{{($help->City->Region->id)}}" SELECTED>{{($help->City->Region->name)}}</option>';
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
                optionsText += '<option value="425" SELECTED>{{($help->country->name)}}</option>';
                
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
                    optionsText += '<option value="{{($help->City->Region->id)}}" SELECTED>{{($help->City->Region->name)}}</option>';
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
                    optionsText += '<option value="{{($help->City->id)}}" SELECTED>{{($help->City->name)}}</option>';
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
                //document.location.href = "https://myldl.ru/profile/del_avatar/"+avatar;

                //$.post('https://myldl.ru/profile/del_avatar', {avatar: avatar});

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

    });

  $(function () {
                                img = 1 + my_mas1.length;
                                var btnUpload = $('#upload');
                                var status = $('#status');
                                 var photo=$('#photo_curent').val();
                                $.ajaxSetup({
    
});
                                new AjaxUpload(btnUpload, {
                                     action: '/help/ajax_reploadupload',
                                    name: 'userfile',
                                    data: {
                                         _token: $('meta[name="csrf-token"]').attr('content'),
                                         'photo':photo,
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
                                            
                                             $('#myDiv').remove(); 
                                            // response - назва зменшеного файлу
                                            orig_name = response.replace("_thumb", "");
                                            $("#files").append('<li id="img_' + img + '"><figure><img class="thumb" src="{{asset('storage/upload/uploads')}}/' + response + '" alt="' + file + '" title="' + file + '" /><figcaption>' + (file.length > 10 ? file.substr(0, 8) + '..' : file) + '</figcaption></figure><a class="close" onclick="remove_img(' + img + ', \'' + orig_name + '\')"><img src="/application/views/front/images/close-2.png" alt="" /></a></li>');
                                            my_mas1.push(orig_name);
                                            document.getElementById('str_images').value = my_mas1;
                                            img++;
                                        }
                                    }
                                });

                            });

</script>      
              
      @push('js')
       
 @endpush
 
 
 
@endsection