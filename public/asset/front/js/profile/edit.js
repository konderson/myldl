$(document).ready(function(){
    
    var user_country = $('#country').attr('data-id');
    var user_region = $('#region').attr('data-id');
    var user_city = $('#city').attr('data-id');
    var exists_image = 0;
    
	$("#country").empty();
	$.ajax({
		type: "GET",
		url: "/profile/ajax_get_country",
		dataType: "html",
		success: function(msg){
			$("#country").append('<option value="">Страна</option>'+msg).selectpicker('refresh');
            if(user_country > 0) {
                $('#country option[value="'+user_country+'"]').prop('selected', true).change();
                user_country = 0;
            }
		}
	});
    
	$('select[name=country]').change(function(){
		$("#region").empty();
		$.ajax({
			type: "GET",
			url: "/profile/ajax_get_region/"+$(this).val(),
			dataType: "html",
			success: function(msg){
				$("#region").append('<option value="">Регион</option>'+msg).selectpicker('refresh');
                if(user_region > 0) {
                    $('#region option[value="'+user_region+'"]').prop('selected', true).change();
                    user_region = 0;
                }
			}
		});
	});
	
	$('select[name=region]').change(function(){
		$("#city").empty();
		$.ajax({
			type: "GET",
			url: "/profile/ajax_get_city/"+$(this).val(),
			dataType: "html",
			success: function(msg){
				$("#city").append('<option value="">Город</option>'+msg).selectpicker('refresh');
                if(user_city > 0) {
                    $('#city option[value="'+user_city+'"]').prop('selected', true).change();
                    user_city = 0;
                }
			}
		});
	});	
function image_add(){
	img=1;
	var btnUpload=$('#upload');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
		action: 'profile/ajax_upload_avatar',
		name: 'userfile',
		data : {
			//'<?= $this->security->get_csrf_token_name() ?>' : $.cookie('<?= config_item('csrf_cookie_name') ?>')
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
				$("#files").append('<li id="img_'+img+'"><figure><img class="thumb" src="/images/avatar/'+response+'" alt="" /><figcaption>'+img+'</figcaption></figure><a class="close" onclick="remove_img('+img+', \''+orig_name+'\')"><img src="/application/views/front/images/close-2.png" alt="" /></a></li>');
				//location.reload(0);
			}
		}
	});
}
	$('#change_city').click(function(){
		$('#hid_pole').show('slow');
	});
    
    btn_text = 'Добавить фото';
    del_btn  = '';
    if(exists_image === 1) {
        btn_text = 'Изменить фото';
        del_btn  = '&nbsp;<a class="close" href="#">Удалить</a>';
    }
    
	$(".mediaform").html('<div class="add-button"><a href="#" id="upload">'+btn_text+'</a>'+del_btn+'</div><span id="status" ></span><ul class="thumb-photos mclearfix" id="files"></ul><input type="file" name="userfile" style="position: absolute; margin: -5px 0px 0px -175px; padding: 0px; width: 220px; height: 30px; font-size: 14px; opacity: 0; cursor: pointer; display: none; z-index: 2147483583; top: 1250px; left: 669px;">');
	$('.close').click(function(){
		//alert($('#kartinka').attr("nazva"));
		var avatar = $('#kartinka').attr("nazva");
		if (confirm("Вы действительно хотите удалить аватар?")) {
			//document.location.href = "<?= site_url("profile/del_avatar") ?>/"+avatar;
			$.get("/profile/del_avatar/"+avatar);
			$(".mediaform").html('<div class="add-button"><a href="#" id="upload">Добавить фото</a></div><span id="status" ></span><ul class="thumb-photos mclearfix" id="files"></ul><input type="file" name="userfile" style="position: absolute; margin: -5px 0px 0px -175px; padding: 0px; width: 220px; height: 30px; font-size: 14px; opacity: 0; cursor: pointer; display: none; z-index: 2147483583; top: 1250px; left: 669px;">');
			image_add();
            $(".img-box").html('<img alt="" src="<?= base_url() ?>application/views/front/images/no_logo.jpg">');
		}
	});
	
});

// Загрузка картинок
$(function(){
	img=1;
	var btnUpload=$('#upload');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
		action: '/rofile/ajax_upload_avatar',
		name: 'userfile',
		data : {
			//'<?= $this->security->get_csrf_token_name() ?>' : $.cookie('<?= config_item('csrf_cookie_name') ?>')
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
				$("#files").append('<li id="img_'+img+'"><figure><img class="thumb" src="/images/avatar/'+response+'" alt="" /><figcaption>'+img+'</figcaption></figure><a class="close" onclick="remove_img('+img+', \''+orig_name+'\')"><img src="/application/views/front/images/close-2.png" alt="" /></a></li>');
				//location.reload(0);
			}
		}
	});
	
});