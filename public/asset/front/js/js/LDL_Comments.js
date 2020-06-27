/**
 * ------------------------------------------------------------
 * LDL_Comments - функционал комментарий для сайта ЛДЛ (myldl.ru)
 * ------------------------------------------------------------
 * @version 1.0.01
 * @author  A.Almaz <me@devdiamond.com>
 * @copyright Almaz Allaberenov. All right reserved <me@devdiamond.com>
 */
var LDL_Comments = {
	
	//inTime : new Date().getTime(),
	isSend : true,
	inTime : 0,
	sendUrl : '',
	smilesUrl : '',
    userUrl : '',
	avatarUrl : '',
	userId  : 0,
    userName : '',
    userAvatar : '',
    sectionId : 0,
    postId : 0,
    message : '',
    parentId : 0,
    userNameGuest : '',
	errorBlockTime : 0,
    hashCookieName : '',
	cookieName : 'cookie_',
	maxCountLengthMsg : 250,
	maxCountLengthUserName : 15,

    // Smiles List
    smilesList : {},

    // Cookie Options
	cookieOptions : {expires: 3, path: '/'},

    // HTML Objects
    objHtml : {},

    setSmilesUrl : function(url)
    {
        this.smilesUrl = url;
    },

    setSendUrl : function(url)
    {
		this.sendUrl = url;
	},

    setUserUrl : function(url)
    {
		this.userUrl = url;
	},
	
	setAvatarUrl : function(url)
    {
		this.avatarUrl = url;
	},
	
	setUserId : function(id)
    {
		this.userId = id;
	},

    setUserName : function(id)
    {
        this.userName = id;
    },

    setUserAvatar : function(id)
    {
        this.userAvatar = id;
    },

    setSectionId : function(id)
    {
		this.sectionId = id;
	},

    setPostId : function(id)
    {
        this.postId = id;
    },

    setHashCookieID : function(id)
    {
        this.hashCookieName = id;
    },

	//--- Отлавливаемые события -----------------------------------------------------------------

    // нажатие "Ответить"
    setAnswerButton : function()
    {
        var me = this;

        me.objHtml.btnAnswer.on('click', function()
        {
            // собираем данные
            var parent_obj = $(this).parent().parent().parent();

            me.objHtml.btnAnswer.parent().show();  // открываем все кнопки 'ответить'
            $(this).parent().hide();               // закрываем текущую кнопку 'ответить'
            me.objHtml.btnNewComment.show();       // открываем кнопку 'написать комментарий'

            // ставляем блок редактора комментария
            me.objHtml.blockNewComment.insertAfter($(this).parent().parent());

            me.objHtml.inputParentID.val(parent_obj.attr('comId'));  // ставим родителский ID (parent_id)
            me.objHtml.textareaComment.val('');   // очищаем поле ввода коммента
            me.objHtml.blockNewComment.show();    // открываем сам блок
            me.objHtml.textareaComment.focus();   // даем фокус
        });
    },

    // нажатие "Написать комментарий"
    setNewCommentButton : function()
    {
        var me = this;

        me.objHtml.btnNewComment.on('click', function()
        {
            me.objHtml.btnAnswer.parent().show();  // открываем все кнопки 'ответить'
            me.objHtml.btnNewComment.hide();       // закрываем кнопку 'написать комментарий'

            // ставляем блок редактора комментария
            me.objHtml.blockNewComment.insertAfter(me.objHtml.btnNewComment);

            me.objHtml.inputParentID.val('0');   // обнуляем (parent_id)
            me.objHtml.textareaComment.val('');  // очищаем поле ввода коммента
            me.objHtml.blockNewComment.show();   // открываем сам блокы
            me.objHtml.textareaComment.focus();  // даем фокус
        });
    },

	// нажатие CTRL+ENTER
	setCtrlEnter : function()
    {
		var me = this;

		// при нажатии клавиш
		me.objHtml.textareaComment.on('keydown', function(e)
        {
			// при нажатии CARL+ENTER
			if ((e.keyCode == 10 || e.keyCode == 13) && e.ctrlKey)
            {
				me.checkValidateInput();  //проверяем на валидность
				return true;
			}

			// при осталных кнопках проверяем количество вводимых символов
			if (!me.maxLengthMsg())
				return true;
		});

		// при вставке из буфера
        me.objHtml.textareaComment.on('paste', function()
        {
			// проверяем количество вводимых символов
			setTimeout(function(){ if (me.maxLengthMsg()) return true; }, 20);
		});
	},
	
	// набор символов в поле "ваше имя"
	setKeyDownUserName : function()
    {
		var me = this;

		// при нажатии клавиш
		me.objHtml.inputUserName.on('keyup', function()
        {
			// при вводе имя проверяем количество вводимых символов
			if (!me.maxLengthUserName())
				return true;
		});
	},
	
	// нажатие по button кнопке 'Комментировать'
	setButtonClick : function()
    {
		var me = this;

		me.objHtml.inputSendComment.on('click', function()
        {
			me.checkValidateInput();  //проверяем на валидность
		});
	},

    // нажатие Enter внутри "каптчи"
    setCaptchaEnter : function()
    {
        var me = this;

        me.objHtml.inputCaptchaCode.on('keydown', function(e)
        {
            // при нажатии ENTER
            if (e.keyCode == 10 || e.keyCode == 13)
            {
                me.checkValidateInput();  //проверяем на валидность
                return true;
            }
        });
    },

    // нажатие Enter внутри "Ваше имя"
    setUserNameEnter : function()
    {
        var me = this;

        me.objHtml.inputUserName.on('keydown', function(e)
        {
            // при нажатии ENTER
            if (e.keyCode == 10 || e.keyCode == 13)
            {
                me.checkValidateInput();  //проверяем на валидность
                return true;
            }
        });
    },

	//--- валидация полей комментария -----------------------------------------------------------------
	
	// проверяем на валиднось отправляемых данных
	checkValidateInput : function()
    {
		var me = this;
		
		// блакировка к отправке
		if ( !me.isSend )
            return true;
        // проверяем количество вводимых символов
		if ( !me.maxLengthMsg() )
			return true;
		// проверяем сообщения
		if ( !me.checkMsg() )
			return true;
		// проверяем имя (ник)
		if ( !me.checkUserName() )
			return true;
		// проверяем каптчу
		if ( !me.checkCaptcha() )
			return true;
		
		//очищаем блок с ошибками
		me.closeErrorMessages();
		// отправляем сообщения
		me.sendMessage();
	},
	
	// проверяем поле ввода "сообщения"
	checkMsg : function()
    {
		var me = this;
		if (me.objHtml.textareaComment.val().trim() == '')
        {
            me.objHtml.blockErrorMess.text('Вы не заполнили поля "Ваше сообщение"');
            me.objHtml.blockErrorMess.show(500);
			setTimeout(function()
            {
                me.objHtml.blockErrorMess.hide(500);
                me.objHtml.blockErrorMess.text('');
                me.objHtml.textareaComment.css('border','1px solid #A9A9A9');
            }, 5000);
            me.objHtml.textareaComment.css('border','1px solid #FF9900');
            me.objHtml.textareaComment.focus();
			return false;
		}
		return true;
	},
	
	// проверяем поле ввода "имя" (ник)
	checkUserName : function()
    {
		var me = this;

		if (me.userId == '0')
		{
			if (me.objHtml.inputUserName.val().trim() == '')   //если поле пустое
			{
                me.objHtml.blockErrorMess.text('Вы не заполнили поля "Ваше имя"');
                me.objHtml.blockErrorMess.show(500);
				setTimeout(function()
                {
                    me.objHtml.blockErrorMess.hide(500);
                    me.objHtml.blockErrorMess.text('');
                    me.objHtml.inputUserName.css('border','1px solid #A9A9A9');
                }, 5000);
                me.objHtml.inputUserName.css('border','1px solid #FF9900');
                me.objHtml.inputUserName.focus();
				return false;
			}
			else if (!me.maxLengthUserName())   //максимальное количество символов
			{
				return false;
			}
		}
		return true;
	},
	
	// проверяем поле ввода "каптчи"
	checkCaptcha : function()
    {
		var me = this;

        if ( !me.userId )
        {
            if (me.objHtml.blockCaptcha.css('display') === 'none')
            {
                me.objHtml.blockCaptcha.show();
                me.objHtml.inputCaptchaCode.focus();
                return false;
            }
        }
        else
        {
            var currentTime = Date.now();
            var contTime = (currentTime - me.inTime) / 1000;
            if (contTime < me.objHtml.inputCaptchaPause.val())
            {
                me.objHtml.inputCaptchaCode.val('');  // чистим поле ввода каптчи
                me.objHtml.blockCaptcha.show(500);    // открываем блок с каптчей

                me.objHtml.blockErrorMess.text('Слишком частые запросы! Пожалуйста, введите код из картинки.');
                me.objHtml.blockErrorMess.show(500);
                setTimeout(function () {
                    me.objHtml.blockErrorMess.hide(500);
                    me.objHtml.blockErrorMess.text('');
                    me.objHtml.inputCaptchaCode.css('border', '1px solid #A9A9A9');
                }, 5000);
                me.objHtml.inputCaptchaCode.css('border', '1px solid #FF9900');
                me.objHtml.inputCaptchaCode.focus();
                return false;
            }
        }

        if (me.objHtml.blockCaptcha.css('display') === 'block' && me.objHtml.inputCaptchaCode.val().trim() == '')
        {
            me.objHtml.blockErrorMess.text('Вы не ввели Код из картинки!');
            me.objHtml.blockErrorMess.show(500);
            setTimeout(function () {
                me.objHtml.blockErrorMess.hide(500);
                me.objHtml.blockErrorMess.text('');
                me.objHtml.inputCaptchaCode.css('border', '1px solid #A9A9A9');
            }, 5000);
            me.objHtml.inputCaptchaCode.css('border', '1px solid #FF9900');
            me.objHtml.inputCaptchaCode.focus();
            return false;
        }

		return true;
	},
	
	//--- Работаем с Комментарием -----------------------------------------------------------------
	
	// вывод ошибок
	errorMessages : function(msg)
    {
        var me = this;
        me.objHtml.blockErrorMess.text(msg);
        me.objHtml.blockErrorMess.show(500);
		me.errorBlockTime = setTimeout(function()
        {
            me.objHtml.blockErrorMess.hide(500);
            me.objHtml.blockErrorMess.text('');
        }, 5000);
	},

	// закрывает блок с предупреждениями
	closeErrorMessages : function()
    {
		var me = this;

        clearTimeout(me.errorBlockTime);
        me.objHtml.blockErrorMess.text('');
        me.objHtml.blockErrorMess.hide(500);
	},

	sendMessage : function()
    {
		var me = this;

        // устанавливаем тайм отправки
        me.objHtml.inTime = Date.now();

        // если это гость, то добавляем имя в куку
        if (me.userId == '0')
            $.cookie(me.cookieName+me.userId, me.objHtml.inputUserName.val(), me.cookieOptions);

        // записываем в память
        me.parentId = me.objHtml.inputParentID.val();       // родительский ID
        me.message = me.objHtml.textareaComment.val();      // сообщения
        me.userNameGuest = me.objHtml.inputUserName.val();  // имя пользователя

        // запрещаем следущую отправку
        me.isSend = false;

        // собираем отправляемые объекты
        var arrPostData = {};
        arrPostData.section_id = me.sectionId;   // ID секции
        arrPostData.post_id = me.postId;         // ID поста (записи)
        arrPostData.parent_id = me.parentId;     // ID родительского коммента
        arrPostData.text = me.message;           // текст комментария
        if (me.userId == '0')
            arrPostData.user_name = me.objHtml.inputUserName.val();  // Имя (ник) комментатора
        arrPostData[me.objHtml.inputHashCommentID.attr('name')] = $.cookie(me.hashCookieName);  // Hash ID

        // собираем отправляемые объекты из системы каптчи
        if (me.objHtml.blockCaptcha.css('display') === 'block')
        {
            arrPostData.captcha_code = me.objHtml.inputCaptchaCode.val();  // каптча
            var inputsCaptcha = me.objHtml.blockCaptchaCodeImg.find('input');
            for (var i1 = 0; i1 < inputsCaptcha.length; i1++)
                arrPostData[inputsCaptcha.eq(i1).attr('name')] = inputsCaptcha.eq(i1).attr('value');
        }

        // очищаем и закрываем поля
        me.objHtml.blockCaptcha.hide();       // закрываем блок каптчи
        me.objHtml.inputCaptchaCode.val('');  // код каптчи
        me.objHtml.textareaComment.val('');   // текст комметна
        me.objHtml.textareaComment.focus();   // даем фокус редактору

        // отправляем сообщения
        var ajaxPostMsg = $.post(
            me.sendUrl,
            arrPostData,
            function(dataIn)
            {
                if(dataIn)
                {
                    if (dataIn.status === 'OK')
                    {
                        me.addNewComment(dataIn.statusID);
                        return true;
                    }
                    else if (dataIn.status === 'ERROR')
                    {
                        switch(dataIn.errorCode)
                        {
                            // Вы не ввели Ваше имя! ----------
                            case '1':
                                me.checkUserName();
                                break;

                            // Ошибка в Имени
                            case '2':
                                me.objHtml.inputUserName.focus();
                                me.errorMessages('Ошибка в имени! Проверти пожалуйста поле «Ваше имя»');
                                break;

                            // Вы не ввели текст комментария! ----------
                            case '3':
                                me.checkMsg();
                                break;

                            // Вы не ввели Код из картинки! ----------
                            case '4':
                                me.newCaptchaCode();
                                me.errorMessages('Вы не ввели Код из картинки!');
                                break;

                            // Код с картинки введен не верно! ----------
                            case '5':
                                me.newCaptchaCode();
                                me.errorMessages('Код с картинки введен не верно!');
                                break;

                            // Слишком частые запросы! ----------
                            case '6':
                                me.newCaptchaCode();
                                me.errorMessages('Слишком частые запросы!');
                                break;

                            // Неверный формат данных! ----------
                            case '0':
                            default:
                                me.newCaptchaCode();
                                me.errorMessages('Неверный формат данных!');
                        }
                        me.objHtml.btnCaptchaImgReloaded.trigger('click');  // обновлем каптчу
                        me.objHtml.textareaComment.val(me.message);  // ставим обратно текст коммента
                        me.isSend = true;  // убираем блокировку на отправку
                        return true;
                    }
                }

                // Ошибка, сервер не отвечает!  // ____02
                me.errorServerMsg();
                me.objHtml.btnCaptchaImgReloaded.trigger('click');  // обновлем каптчу
                me.objHtml.textareaComment.val(me.message);  // ставим обратно текст коммента
                me.isSend = true;  // убираем блокировку на отправку
                return true;
            },
        "json");
		
		// Если возникла ошибка
		ajaxPostMsg.fail(function()
        {
			// Ошибка, сервер не отвечает!  // ____01
            me.errorServerMsg();
            me.objHtml.btnCaptchaImgReloaded.trigger('click');  // обновлем каптчу
            me.objHtml.textareaComment.val(me.message);  // ставим обратно текст коммента
            me.isSend = true;  // убираем блокировку на отправку
			return true;
		});
	},

	addNewComment : function(statusID)
    {
		var me = this,
            userUrl = '',
            str_avatar = '';

		console.log(me);
        // User url
        if (me.userId == '0')
            userUrl = '<span class="guestCommenter">'+ me.userNameGuest +'</span>&nbsp;<sup style="color: #888;">гость</sup>&nbsp;';
        else
            userUrl = '<a target="_blank" href="'+ me.userUrl + me.userId +'">'+ me.userName +'</a>';

        // User avatar img
        if (me.userAvatar == '')
            str_avatar = '<div class="ava clNoAvatar" style="background-image: url(/static/images/noimg.png)"></div>';
        else
            str_avatar = '<div class="ava" style="background-image: url('+ me.avatarUrl + me.userAvatar +')"></div>';

        // htmlspecialchars
        me.message = me.message.replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#039;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

        // smiles parser
        me.message = me.message.replace(/:([a-z_0-9-]+):/g, function(rStrIn, p1)
        {
            if (p1 in me.smilesList)
                return '<img src="'+me.smilesUrl+p1+'.'+me.smilesList[p1]+'" class="smile-box-img" alt="" />';
            else
                return '{'+p1+'}';
        });

        var clas = 'odd-comment';

        if ($('.add-comment').parent().attr('comid')) {
            var clas = 'even-comment';
        }

        // new comments block
        var strComment = '<div style="display: none;" class="'+ clas +'" id="k'+ statusID +'" comid="'+ statusID +'">\n' +
            '                    <div class="photo">'+ str_avatar +'</div>\n' +
            '                    <div class="adv-comment">\n' +
            '                        <div class="profile-name">' + userUrl +
            '                        </div>\n' +
            '                        <p>'+ me.message +'</p>\n' +
            '                        <div class="callback clAnswer">\n' +
            '                            <button>Ответить</button>\n' +
            '                            <span>1 минуту назад</span>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                </div>';

		// добавляем коммент

        $('.add-comment').before(strComment);

        // закрываем редактор
        me.objHtml.blockNewComment.hide('slow', function()
        {
            // открываем коммент
            $('#k'+statusID).show('slow');
        });

        me.objHtml.btnAnswer.parent().show();  // открываем все кнопки 'ответить'
        me.objHtml.btnNewComment.show('slow');  // открываем кнопку 'Написать комментарий'
        me.objHtml.btnCaptchaImgReloaded.trigger('click');  // обновлем каптчу

        // глобальные настройки
        me.message = '';   // лчищаем техт
        me.parentId = 0;   // обнуляем ParentID
        me.isSend = true;  // убираем блокировку на отправку
        return true;
	},

    // ошибка сервера
    errorServerMsg : function()
    {
        var me = this;
        me.objHtml.blockErrorMess.text('Сервер не отвечает! Попробуйте через пару минут.');
        me.objHtml.blockErrorMess.show(500);
        setTimeout(function()
        {
            me.objHtml.blockErrorMess.hide(500);
            me.objHtml.blockErrorMess.text('');
        }, 10000);
        me.objHtml.textareaComment.focus();
        return true;
    },

    // новая каптча
    newCaptchaCode : function()
    {
        var me = this;

        // обновляем
        me.objHtml.blockCaptcha.show();
        me.objHtml.inputCaptchaCode.val('');
        me.objHtml.inputCaptchaCode.focus();
    },

	// ограничитель символов в поле ввода "комментария"
	maxLengthMsg : function()
    {
		var me = this;

		// если текст больше указанного, урезаем его
		if (me.objHtml.textareaComment.val().length > (me.maxCountLengthMsg - 1))
        {
            me.objHtml.textareaComment.val(me.objHtml.textareaComment.val().substr(0,(me.maxCountLengthMsg - 1)));
			clearTimeout(me.errorBlockTime);
			me.errorMessages('Вы ввели '+ me.maxCountLengthMsg +' символов, больше нельзя!');
			return false;
		}
		return true;
	},
	
	// ограничитель символов в "имени" (ник)
	maxLengthUserName : function()
    {
		var me = this,
            text_val = me.objHtml.inputUserName.val();

		// если текст больше указанного урезаем её
		if (text_val.length > me.maxCountLengthUserName)
        {
            me.objHtml.inputUserName.val(text_val.substr(0, me.maxCountLengthUserName));
			clearTimeout(me.errorBlockTime);
			me.errorMessages('Имя должно содержать максимум '+ me.maxCountLengthUserName +' символов!');
			return false;
		}

        // Проверяем не введется-ли запрещаемые символы
        if ( !text_val.match(/^[A-Za-z0-9А-Яа-яЁё_\-]+$/) )
        {
            me.objHtml.inputUserName.val(text_val.substr(0, (text_val.length - 1)));
            clearTimeout(me.errorBlockTime);
            me.errorMessages('В имени разрешено использовать только буквы и символы «_» и «-»');
            return false;
        }

        return true;
	},
	
	//--- смайлики -----------------------------------------------------------------
	
	// открытие/закрытие блок смайлов
	setSmilesBlock : function()
    {
        var me = this;

        // открытие/закрытие блок с смайлами
        me.objHtml.btnSmiles.on('click', function()
        {
            var obj = $(this);

            me.objHtml.blockSmilesBox.toggle();
            me.objHtml.blockSmilesBox.css({
                top  : obj.position().top - (me.objHtml.blockSmilesBox.height() + 10),
                // top  : obj.position().top - (me.objHtml.blockSmilesBox.height() + 40),
                left : obj.position().left - (me.objHtml.blockSmilesBox.width() - 50)
                // left : obj.position().left - (me.objHtml.blockSmilesBox.width() - 100)
            });
        });

        // скрываем при нажатии на смайлика
        me.objHtml.btnSmileImg.on('click', function()
        {
            me.objHtml.blockSmilesBox.hide();
        });
    },
	
	// вставка смайликов
	setSmiles : function(img)
    {
		var me = this,
            imgObj = $(img),
            parseSrc = imgObj.attr('src').match(/\/([a-z_0-9-]+)\.(gif|png|jpg)/);

		if (parseSrc && parseSrc[1])
        {
			me.setSmilesText(':'+parseSrc[1]+':');
			$('div.smile-box').hide();
		}

		// проверяем количество вводимых символов
		if ( !me.maxLengthMsg() )
			return true;
	},
	
	// вставляет код смайлика в поле ввода комментария
	setSmilesText : function (text)
    {
		var me = this,
            txtarea = me.objHtml.textareaComment.get(0),
			textareaObj = $(txtarea);
		
		if (document.selection)
        {
			//For browsers like Internet Explorer
			var sel = document.selection.createRange();
			txtarea.focus();
			sel.text = text;
			txtarea.focus();
		} 
		else if (txtarea.selectionStart || txtarea.selectionStart == '0')
        {
			textareaObj.focus();
			var startPos = txtarea.selectionStart;
			var endPos = txtarea.selectionEnd;
			var scrollTop = txtarea.scrollTop;
			txtarea.value = txtarea.value.substring(0, startPos)+text+txtarea.value.substring(endPos,txtarea.value.length);
			txtarea.focus();
			txtarea.selectionStart = startPos + text.length;
			txtarea.selectionEnd = startPos + text.length;
			txtarea.scrollTop = scrollTop;
		}
        else
        {
			txtarea.value = txtarea.value + ' ' + text;
			txtarea.focus();
		}
		
		// скрываем панель с смайликами
		$('div.smile-box').hide();
	},
	
	//--- инициализация -----------------------------------------------------------------

    textFilter : function()
    {
        var me = this,
            commentsTextObj = $('li .clContent');

        // парсим текст с смайлами
        for (var i2=0; i2 < commentsTextObj.length; i2++)
        {
            var parseSrc = commentsTextObj.eq(i2).html().replace(/:([a-z_0-9-]+):/g, function(rStrIn, p1)
            {
                if (p1 in me.smilesList)
                    return '<img src="'+me.smilesUrl+p1+'.'+me.smilesList[p1]+'" class="smile-box-img" alt="" />';
                else
                    return '{'+p1+'}';
            });
            commentsTextObj.eq(i2).html(parseSrc);
        }

        return true;
    },

    // Загрузка первоначальных параметров
	setDom : function()
    {
		var me = this,
            smilesImgObj = $('div.smile-box img'),
            cookieUserName = $.cookie(me.cookieName+me.userId);

        // Jobs HTML objects
        // кнопка под комментарием
        me.objHtml.btnAnswer = $('div.clAnswer > button');
        
        // кнопка Написать комментарий
        me.objHtml.btnNewComment = $('div.btnNewComments');
        
        // кнопка смайлы
        me.objHtml.btnSmiles = $('a.wm_smiles');
        
        
        me.objHtml.btnSmileImg = $('div.smile-box > div > img');
        
        me.objHtml.btnCaptchaImgReloaded = $('#CommentsCaptcha_ReloadLink');

        me.objHtml.blockCaptcha = $('div.wmCaptcha');
        me.objHtml.blockCaptchaCodeImg = $('div.captchaCodeImg');
        me.objHtml.blockNewComment = $("div.add-comment");
        me.objHtml.blockSmilesBox = $('div.smile-box');
        me.objHtml.blockErrorMess = $('div.wmErrorData');

        me.objHtml.inputCaptchaCode = $('input[name=captcha_code]');
        me.objHtml.inputCaptchaPause = $('input[name=captcha_pause]');
        me.objHtml.inputHashCommentID = $('#hashCommentID');
        me.objHtml.inputParentID = $('input[name=parent_id]');
        me.objHtml.inputUserName = $('input[name=user_name]');
        me.objHtml.inputSendComment = $('input[name=send_comment]');

        me.objHtml.textareaComment = $('div.wmCommentMesBlock > textarea');

		// присваеваем имя гостям из куки
		if (me.userId == '0' && typeof(cookieUserName) !== 'undefined')
            me.objHtml.inputUserName.val(cookieUserName);

        // собираем список смайлов
        for (var i1=0; i1 < smilesImgObj.length; i1++)
        {
            var parseSrc = smilesImgObj.eq(i1).attr('src').match(/\/([a-z_0-9-]+)\.(gif|png|jpg)/);
            me.smilesList[parseSrc[1]] = parseSrc[2];
        }
    },

	// инициализация сообщении
	init : function()
    {
		var me = this;
		// инициализация основных инструментов
		me.setDom();
        // обработка текста
        me.textFilter();
        // нажатие "ответить"
        me.setAnswerButton();
        // нажатие "Написать комментарий"
        me.setNewCommentButton();
		// при наборе символов в поле имя
		me.setKeyDownUserName();
        // вкл/выкл блок смайлами
        me.setSmilesBlock();
        // нажатие Enter внутри "каптчи"
        me.setCaptchaEnter();
        // нажатие Enter внутри "Ваше имя"
        me.setUserNameEnter();
        // нажатие Ctrl+Enter
        me.setCtrlEnter();
        // нажатие button кнопку 'Комментировать'
        me.setButtonClick();
	}
	
	//--------------------------------------------------------------------
	
};
