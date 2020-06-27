/**
 * DS Send Message Chat v2.3.1
 * 
 * Copyright 2015 Allaberenov Almaz
 * Released under the MIT license
 */
$(document).ready(function()
{
	// ======== Глобальные настройки ========
	var port='8281';
	var siteUrl=window.location.protocol+'//'+window.location.host;
	var startserveraddress=siteUrl+'/?ws=start';
	var chataddr='ws://'+window.location.host+':'; //wsUrl('');
	var sRegEx = smileRegEx(); // Регулярное выражения для смайлов
	
	// ======== Приватные настройки ========
	var socket;
	var xhttp;
	var setTimer_ID, setInterval_ID, setTimer_Pen;
	var iWrite=0, iWipe=0;
	var startWS=false, openWS=false;
	
	
	// ========= Инициализация =========
	function initStart()
	{
		// Филтрация текста
		filterAllText();
	}
	
	// ========= Запуск сервера =========
	function wsServerRun()
	{
		//Обект подключения
		try {
			xhttp = new XMLHttpRequest(); //Для всех браузеров, кроме IE:
		}
		catch (e) {
			xhttp = new ActiveXObject("Microsoft.XMLHttp"); //Для IE:
		}
		xhttp.open('GET',startserveraddress,true);
		xhttp.send();
		xhttp.onreadystatechange = function()
		{
			if (xhttp.readyState == 4 && xhttp.status == 200)
			{
				//Принятое содержимое файла должно быть опубликовано
				console.log(xhttp.responseText);
				//Принятое содержимое json файла должно быть вначале обработано функцией eval
				var json = eval( '('+xhttp.responseText+')' );
				
				if (json.run == 1)
				{
					port=json.p;
					mainWebSocket(); // Соединяем WS (WebSocket)
					return;
				}
				else if (json.run == 2 || json.run == 3)
				{
					// Немного ждем, и отправляем запрос заново
					port=json.p;
					setTimeout( function() { wsServerRun(); }, 4000);
					return;
				}
			}
		}
	}

	// ========= Соединяемся через WebSocket =========
	function mainWebSocket()
	{
		socket = new WebSocket( chataddr+port );             // Устанавливаем соединения через WS (WebSocket)
		socket.onopen = function(evt) { onOpen(evt) };       // Сообщения об Открития соединения
		socket.onclose = function(evt) { onClose(evt) };     // Сообщения об Закрытия соединения
		socket.onerror = function(evt) { onError(evt) };     // Сообщения об WS Ошибках
		//socket.onmessage = function(evt) { onMessage(evt) }; // Сообщения пользовательские (НЕ машинные сообщения)
	}
	
	// ========= Соединение открыто =========
	function onOpen(evt)
	{
		openWS = true;
		socket.send('{"act":"start", "userName":"'+wsUserName+'", "userKey":"'+wsUserKey+'"}'); //start
		socket.send('{"act":"addNewContacts", "forUserID":"'+ forUserID +'"}');                 //new user
	}
	
	// ========= Закрытия чата =========
	function onClose(evt)
	{
		// Закрытие чата (WS соединения)
		startWS = false;
		openWS = false;
		socket.close();
	}
	
	// ========= WS Ошибки (соединения и т.д.) =========
	function onError(evt)
	{
		// Закрытие чата (WS соединения)
		startWS = false;
		openWS = false;
		socket.close();
	}

	// ========= Отправка сообщения =========
	function sendMessage(text)
	{
		// если ни чего НЕ передано, то делаем строку ПУСТОЙ
		if (typeof(text) === 'undefined')
			text = '';
		
		// Если поля ввода пусто, то ничего не отправляем соответсвенно
		if (text === '' && $("#chat-msg").val() === '')
			return false;
		
		// Извлекаем текст
		var getText = text + $("#chat-msg").val();
		
		// ОТПРАВКА СООБЩЕНИЯ
		$.ajax({
			type: "POST",
			url: siteUrl+"/main/isend_msg_user", /* ajax_send_message_to_user */
			data: {
				this_id: this_id, u_id: forUserID, text: getText
                /* hash_token_id : $.cookie('hash_cookie_id'),
                rel_id : forUserID,
                textMsg : getText */
            },
			dataType: "html",
			success: function(msg)
			{
				// если ошибка 
				if (msg === 'error')
					window.location.href = siteUrl;  //перенаправляем на главную страничку сайта
				
				// если успех
				if (msg === 'ok')
				{
					// Проверяем статус сервера и запуск
					if (startWS === false)  //остановлен
					{
						startWS = true;
						wsServerRun();
					}
					else  //запущен
					{
						// сообщаем о новом контакте/сообщении
						if (openWS === true)
							socket.send('{"act":"addNewContacts", "forUserID":"'+ forUserID +'"}'); //send new user
					}
				}
			}
		});
		
		// закрываем блок отправки сообщения
		close_block_send_msg();
		
		// добавления сообщения в конец списка
		var new_msg_block = ''
		+ '<li>'
		+ '	<div class="mclearfix">'
		+ '		<div class="wmImg"><img src="'+ (wsUserAvatar === '' ? siteUrl+'/application/views/front/images/chat_img/no_avatar.jpg' : siteUrl+'/images/avatar/'+wsUserAvatar) +'" alt=""></div>'
		+ '		<div class="wmData">'
		+ '			<div class="wm_timestamp">&nbsp;&nbsp;<span class="wm_msg_time">'+ current_time_msg() +'</span></div>'
		+ '			<div class="wm_sender"><p>'+ wsUserName +'</p></div>'
		+ '			<div class="wm_content"><p>'+ replaceText(getText) +'</p></div>'
		+ '		</div>'
		+ '	</div>'
		+ '</li>';
		$(".wm_row").append(new_msg_block);      //добавлям сообщения в конец списка
		$(".wm_row").children().eq(0).remove();  //удаляем первое сообщение
		
		// удаления информации о "черном списке"
		$('.cerrent_ban_user').remove();
		return true;
	}
	
	//========= Перебор всей истории для филтрации =========
	function current_time_msg()
	{
		var today = new Date();
		var t_getHours = (today.getHours() < 10 ? '0'+today.getHours() : today.getHours());
		var t_getMinutes = (today.getMinutes() < 10 ? '0'+today.getMinutes() : today.getMinutes());
		var t_getDate = (today.getDate() < 10 ? '0'+today.getDate() : today.getDate());
		var t_getMonth = ((today.getMonth()+1) < 10 ? '0'+(today.getMonth()+1) : (today.getMonth()+1));
		return t_getHours+':'+t_getMinutes+' | '+t_getDate+'.'+t_getMonth+'.'+today.getFullYear();
	}
	
	//========= Перебор всей истории для филтрации =========
	function filterAllText()
	{
		var countMsg = $(".wm_row > li").size();
		for (var i=0; i < countMsg; i++)
		{
			var obj_text = $(".wm_row").children().eq(i).find("div[class='wm_content'] > p");
			if (typeof(obj_text.text()) === 'undefined' || obj_text.text() === '')
				continue;
			obj_text.html(replaceText(obj_text.text())); //филтруем текст
		}
	}
	
	//========= Фмльтрация входного текста =========
	function replaceText( text )
	{
		// проверка на валидность 
		if (text === '')
			return text;
		// заменяяем смайлы на фото смайлы
		text = text.replace( sRegEx, replaceSmilesCallback );
		// заменяем код изображения в ссылку изображения
		text = text.replace( /\$(.*)\$/g, replaceImgCallback );
		return text;
	}
	
	//========= Изменяем код смайлов на изображения смайлов =========
	function replaceSmiles( text )
	{
		return text.replace( sRegEx, replaceSmilesCallback );
	}
	
	// ========= Регулярное выражения для смайлов =========
	function smileRegEx()
	{
		var regExpStr = '^(.*)(';
		var countSmiles = $(".all-smiles > img").size();
		for (var i=0; i < countSmiles; i++)
		{
			var imgcode = $(".all-smiles").children().eq(i).attr('imgcode');
			if (typeof(imgcode) === 'undefined' || imgcode === '')
				continue;
			if(i!==0)
				regExpStr += '|';
			regExpStr += ':(?:' + escapeRegExp(imgcode) + '):';
		}
		regExpStr += ')(.*)$';
		return new RegExp(regExpStr, 'gm');
	}
	
	//========= Переходы для Регулярных вырожений =========
	function escapeRegExp( text )
	{
		var specials = new Array(
			'^', '$', '*', '+', '?', '.', '|', '/',
			'(', ')', '[', ']', '{', '}', '\\', '>'
		);
		var sReg = new RegExp(
			'(\\' + specials.join('|\\') + ')', 'g'
		);
		return text.replace( sReg, '\\$1');
	}
	
	// ========= Собираем смайлики из переданных кодов =========
	function replaceSmilesCallback( str, p1, p2, p3 )
	{
		if (p2)
		{
			var parseCode = p2.match(/^:(.*):$/);
			var imgurl = $("img[imgcode='"+parseCode[1]+"']").attr('src');
			return 	replaceSmiles(p1)
				+	'<img src="'
				+	imgurl
				+	'" alt="'+parseCode[1]+'" />'
				+ 	replaceSmiles(p3);
		}
		return str;
	}
	
	// ========= Собираем из кода картинки, изображения =========
	function replaceImgCallback( str, p1 )
	{
		var orig_name = p1.replace("_thumb", "");
		return '<a class="fancybox" data-fancybox-group="gallery" href="'+siteUrl+'/images/uploads/'+orig_name+'"><div class="img-box"><img src="'+siteUrl+'/images/uploads/'+orig_name+'" alt="" width="70" height="70" /></div></a>';
	}
	
	// ========= Внедряем код смайла в текстовое поле =========
	function setSmilesText(text)
	{
		var txtarea  = $('#chat-msg').get(0),
			textareaObj = $(txtarea);
		
		if (document.selection) {
			//For browsers like Internet Explorer
			var sel = document.selection.createRange();
			txtarea.focus();
			sel.text = text;
			txtarea.focus();
		} 
		else if (txtarea.selectionStart || txtarea.selectionStart == '0') {
			textareaObj.focus();
			var startPos = txtarea.selectionStart;
			var endPos = txtarea.selectionEnd;
			var scrollTop = txtarea.scrollTop;
			txtarea.value = txtarea.value.substring(0, startPos)+text+txtarea.value.substring(endPos,txtarea.value.length);
			txtarea.focus();
			txtarea.selectionStart = startPos + text.length;
			txtarea.selectionEnd = startPos + text.length;
			txtarea.scrollTop = scrollTop;
		} else {
			txtarea.value = txtarea.value + ' ' + text;
			txtarea.focus();
		}
		
		// скрываем панель с смайликами
		$('div.smile-box').hide();
	}
	
	// ========= Закрытия блока отправкм сообщения =========
	function close_block_send_msg()
	{
        $.fancybox.close();  //закрываем окно отправки
		$('#wm_rows').hide(500);            //закрываем блок истории
		$('#chat-msg').val('');             //обнуляем поле ввода
		$('#button_open_close_history').text('Показать историю');  //меняем название кнопки показа истории
	}
	
	//##########>  Пользователские действия  <##################################################
	
	//=== Показывать/Скрывать окно отправки сообщения данному пользователю ==========================================
	//
	// при наведении мыши над кнопкой
	$('.write_message_button').mouseover(function(){
		$(this).children().css('border-bottom','1px dotted #4e4e4e');
	});
	// при удалении мыши от кнопки
	$('.write_message_button').mouseout(function(){
		$(this).children().css('border','none');
	});
	// показать скрывать окно
	$('#write_message').click(function(){
		$('#chat-msg').val('');               //обнуляем поле ввода
		$('#wm_rows').hide(500);              //закрываем блок истории
	});
	//
	//=== END - Показывать/Скрывать окно отправки сообщения данному пользователю ===>
	
	// Нажатие по клавиатуре (кнопкам)
	var sendObj = $('#chat-msg').get(0);
	$(sendObj).on('keydown', function(e) {  // при нажатии CARL+ENTER
		if ((e.keyCode == 10 || e.keyCode == 13) && e.ctrlKey) sendMessage();  // Отправляем сообщения
	});

	// Клик по кнопке "Отправить"
	document.getElementById("msg-send").onclick = function (){ sendMessage(); };  // Отправляем сообщения
	
	// Клик по кнопки "Показать/Скрывать историю"
	$('#button_open_close_history').click(function(){
		var ro = $('#wm_rows');
		if (ro.css('display') === 'block')
		{
			ro.animate({'opacity':0});
			ro.hide(300);
			$(this).text('Показать историю');
		}
		else
		{
			ro.css({'opacity':0});
			ro.show(300);
			ro.animate({'opacity':1});
			$(this).text('Закрыть историю');
		}
	});
	
	// При клике на крестик в вверху блока отправки сообщения
	$('#button_close_msg_block').click(function(){
		close_block_send_msg();
	});
	
	
	//=== Работа со смайлами ==========================================================================
	//
	// Показываем/скрываем смайлы, при клике на смайла внутри поля ввода сообщения
	$('a.wm_smiles').on('click', function(e) {
		var el = $(this), box = $('div.smile-box');
		if (box.css('display')=='block')
			box.css('display', 'none');
		else
			box.css('display', 'block');
		box.css({
			top  : el.position().top - (box.height() + 10),
			left : el.position().left - (box.width() - 50)
		});
	});
    //
    // При клике в ЛЮБОМ месте по текущей активной странички
	$(document).bind('click', function(e) {
		// Скрываем блок смайлов
		var box = $('div.smile-box'), a = $('a.wm_smiles');           
		if (!$(e.target).closest('a.wm_smiles').length) {
			if (!$(e.target).closest('div.smile-box').length)
				box.css('display', 'none');
		}    
	});
	//
	// При клике по смайликам, ставим их код в техтовое поле
	$(document).on('click', '.smile-box-img', function(event) {
		var parseSrc = $(this).attr('src').match(/\/([a-z_0-9-]+)\.(gif|png|jpg)/);
		if (parseSrc && parseSrc[1]) {
			setSmilesText(':'+parseSrc[1]+':');
			$('div.smile-box').hide();
		}
	});
	//
	//=== END - Работа со смайлами ===>
	
	
	
	//=== Загрузка изображения =================================================================================
	//
	var btnUpload = $('.wm_files');
	new AjaxUpload(btnUpload, {
		action: siteUrl+'/profile/ajax_upload',
		name: 'userfile',
		onSubmit: function(file, ext) {
			//проверяем на валидность
			if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
				// extension is not allowed 
				$('.message_status_img').text('Поддерживаемые форматы JPG, JPEG, PNG или GIF').show(500);
				return false;
			}
			//информируем об ожидании
			$('.message_status_loader').show();
		},
		onComplete: function(file, response) {
			//On completion clear the status
			$('.message_status_loader').hide();
			$('.message_status_img').hide();
			//Add uploaded file to list
			if (response === "error") {
				alert('Файл не загружен "'+file+'"');
			} else {
				// response - назва зменшеного файлу
				sendMessage('$'+response+'$');  //отправляем сообщения
			}
		}
	});
	//
	$('.fancybox').fancybox();
	//Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
	$('.fancybox-media').attr('rel', 'media-gallery').fancybox({
		openEffect : 'none',
		closeEffect : 'none',
		prevEffect : 'none',
		nextEffect : 'none',
		arrows : false,
		helpers : {
			media : {},
			buttons : {}
		}
	});
	//
	//=== END - Загрузка изображения ===>
	
	
	// ========= Загрузка всех событий данного скрипта =========
	return initStart();  //START
	
});