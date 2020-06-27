	@extends('layouts.admin.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')

<script type="text/javascript">
    $(function () {
        $("#dates").datepicker({dateFormat: "yy-mm-dd"});
    });
    $(document).ready(function () {

        // Выделения кнопки текущего раздела
        $('.social-razdel-' +5).attr({'class': 'active_menu'});

        // При выборе "Тип вопроса"
        $('select[name=questions_type]').change(function () {
            var qI = $(".questions_inputs");
            var qW = $(".q_choice");
            var sVal = $(this).val();
            var newInHtml = '';
            var newHtmlView = '';
            qI.empty();  //очищаем поле "пункты выбора"
            qW.empty();  //очищаем поле "предварительный просмот"
            $(this).css('border', '1px solid #ccc');
            switch (sVal)
            {
                case '1':    //один выбор
                    // в Редакторе
                    for (var x1 = 1; x1 <= 10; x1++)
                        newInHtml += '<div><input onblur="ttInp(\'' + x1 + '\')" onkeyup="ttInp(\'' + x1 + '\')" class="text-input" type="text" name="variant_' + x1 + '" value="" maxlength="256"><span class="r_inp_button" onclick="remove_Inp(\'' + x1 + '\')">[x]</span></div>';
                    // в Просмотре
                    for (var x1 = 1; x1 <= 10; x1++)
                        newHtmlView += '<li><input type="radio" name="i_view_r" id="poll-' + x1 + '"><label class="qV_' + x1 + '" for="poll-' + x1 + '"></label></li>';
                    break;

                case '2':  //мулти выбор
                    // в Редакторе
                    for (var x1 = 1; x1 <= 10; x1++)
                        newInHtml += '<div><input onblur="ttInp(\'' + x1 + '\')" onkeyup="ttInp(\'' + x1 + '\')" class="text-input" type="text" name="variant_' + x1 + '" value="" maxlength="256"><span class="r_inp_button" onclick="remove_Inp(\'' + x1 + '\')">[x]</span></div>';
                    // в Просмотре
                    for (var x1 = 1; x1 <= 10; x1++)
                        newHtmlView += '<li><input type="checkbox" name="i_view_' + x1 + '" id="poll-' + x1 + '"><label class="qV_' + x1 + '" for="poll-' + x1 + '"></label></li>';
                    break;

                case '3':  //кнопки ДА/НЕТ
                    // в Редакторе
                    newInHtml += '<div><input onblur="tt_Bool(\'1\')" onkeyup="tt_Bool(\'1\')" class="text-input" type="text" name="variant_1" value="" maxlength="50"></div>';
                    newInHtml += '<div><input onblur="tt_Bool(\'2\')" onkeyup="tt_Bool(\'2\')" class="text-input" type="text" name="variant_2" value="" maxlength="50"></div>';
                    // в Просмотре
                    newHtmlView += '<li><input style="margin: 0 4px;" type="button" name="yes_q" value=""><input style="margin: 0 4px;" type="button" name="note_q" value=""></li>';
                    break;

                case '4':  //текстовое поле
                    // в Редакторе
                    newInHtml += '<textarea onblur="tt_text()" onkeyup="tt_text()" name="variant_1" maxlength="256" style="width: 300px!important; height: 160px!important; resize: none;"></textarea><br>';
                    // в Просмотре
                    newHtmlView += '<li><textarea style="width: 170px!important;" name="i_view_t"></textarea></li>';
                    break;

                default:
                    break;  //неопределено
            }
            qI.append(newInHtml);   //внедряем в поле "FORM"
            qW.append(newHtmlView); //внедряем в поле "предварительного просмотра"
        });

        // при нажатии "Добавить"
        $('#q_submit').click(function () {
            // Проверка "Текст Опроса"
//		var qTextObj = $('.questions_text');
//		if (typeof(qTextObj.val()) === 'undefined' || qTextObj.val() === '')
//		{
//			// Текст опроса не введен
//			qTextObj.css('border', '1px solid red');
//			alert('Текст опроса не введен!');
//			return false;
//		}

            // Проверка "Тип Опроса"
            var qValObj = $('select[name=questions_type]');
            var qVal = qValObj.val();
            var date = new Date($('#dates').val().replace(/(\d+).(\d+).(\d+)/, '$3/$2/$1'));
            var curDate = new Date;
            var needdate = new Date(curDate.getFullYear(), curDate.getMonth(), curDate.getDate() + 1);
            var msg = "";

            if (typeof (qVal) !== 'undefined' && qVal !== '' && qVal !== '0' && date >= needdate) //тип ответа выбран :)
            {
                // проверка на заполнения
                var qInpErr = false;
                var qInput = $('.questions_inputs');
                var qInputSize = $('#q_tarea').val();
                if (qInputSize.length == 0)
                {
                    // нет Input -ов

                    var qTextarea = $('textarea[name=variant_1]');
                    if (typeof (qTextarea.val()) === 'undefined')
                    {
                        // ошибка выбора "тип опроса"
                        alert('Неверно выбран "Тип Опроса"');
                        return false;
                    }
                    if (date <= needdate)
                    {
                        // ошибка выбора "тип опроса"
                        alert('Неверно выбран "Тип Опроса"');
                        return false;
                    }
                }
                for (var x1 = 0; x1 < qInputSize; x1++)
                {
                    // проверяем все Input на заполнения
                    var qInpObj = qInput.children('div').eq(x1).children('input');
                    var qInpVal = qInput.children('div').eq(x1).children('input').val();
                    if (typeof (qInpVal) !== 'undefined' && qInpVal !== '')
                    {
                        qInpObj.css('border', '1px solid #ccc');
                    } else
                    {
                        qInpObj.css('border', '1px solid red');
                        qInpErr = true;
                    }
                }
                if (qInpErr) //не заполнено
                    return false;
            } else  //не выбран "тип ответа"
            {
                if (qVal == 0) {
                    // Тип опроса не указан
                    qValObj.css('border', '1px solid red');
                    msg += 'Вы не выбрали "Тип опроса"\n';
                }
                if (date < needdate) {
                    // Тип опроса не указан
                    $('#dates').css('border', '1px solid red');
                    msg += 'Слишком ранняя "Дата окончания опроса"\n';
                }
                if (msg.length > 0) {
                    alert(msg);
                    return false;
                }
            }

            // Отправляем данные

		$(this).submit();
            $('.questions_view').remove();  //удалить блок придварительного вида опроса
            $('form[name=form_razdel]').submit();
            return false;
        });

    });

// Удаления лишних полей
    function remove_Inp(inp)
    {
        $('input[name=variant_' + inp + ']').parent().remove();  //удаления в редакторе
        $('.qV_' + inp).parent().remove();                     //удаления в просмотре
    }

//=== Примая транслятция ввода ===========
//
// "Текст Опроса"
    function tt_Q()
    {
        $('.q_text').html($('.questions_text').val());
    }
// "Один/Мулти выбор"
    function ttInp(inp)
    {
        $('.qV_' + inp).text($('input[name=variant_' + inp + ']').val());
    }
// "Да/Нет выбор"
    function tt_Bool(inp)
    {
        if(inp==1){
        $('input[name=yes_q]').val($('input[name=variant_' + inp + ']').val());
        }
        if(inp==2){
        $('input[name=note_q]').val($('input[name=variant_' + inp + ']').val());
        }
    }
// "Текстовый выбор"
    function tt_text()
    {
        $('input[name=i_view_t]').val($('input[name=variant_1]').val());
    }
//
//=== Примая транслятция ввода ===>

</script>
<style>
    .r_inp_button {
        padding: 0 5px;
        color: #000;
        cursor: pointer;
    }
    .r_inp_button:hover {
        color: red;
        font-weight: bold;
    }
    .questions_text {
        width: 340px!important;
        height: 140px!important;
        resize: none;
    }
    .questions_edit {
        float: left;
    }
    .questions_view {
        float: right;
        width: 246px;
        border: 1px solid #999;
    }
    .questions_view .q_title {
        padding: 15px 15px 5px;
        border-bottom: 1px solid #999;
    }
    .questions_view fieldset {
        padding: 10px 15px;
    }
    .questions_view .q_text {
        font: 14px Verdana;
    }
    .questions_view .q_choice li {
        margin: 2px 0;
    }
    .questions_view .q_choice li input {
        float: left;
    }
    .questions_view .q_choice li label {
        font: 11px Verdana;
    }
</style>
	
		<div id="main-content"> <!-- Main Content Section with everything -->

    <!-- Page Head -->
    <h2>Добавление Соц-Опроса в раздел &nbsp;"2020"</h2>

    <div class="content-box"><!-- Start Content Box -->

        <div class="content-box-content">

            <form name="form_razdel" action="/admin/social_questions/store" method="post">
                 @csrf
                <input type="hidden" name="ci_csrf_token" value="">

                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

                    <div>
                        <div class="questions_edit">
                            <p>
                                <span class="input-notification information">Текст:</span><br /> <!-- Classes for input-notification: success, error, information, attention -->
                                <textarea onblur="tt_Q()" onkeyup="tt_Q()"  id='q_tarea'  class="questions_text" name="texts" maxlength="256" placeholder="Текст Опроса"></textarea>
                            </p>
                            <p>
                                <span class="input-notification information">Дата окончания опроса:</span><br /> <!-- Classes for input-notification: success, error, information, attention -->
                                <input class="questions_dates" id="dates" name="questions_dates" maxlength="10" value="{{date('Y-m-d')}}" />
                                <span class="error"><p>Слишком ранняя "Дата окончания опроса"</p></span>
                            </p>
                            <p>
                                <select name="questions_type">
                                    <option value="0" SELECTED>Выберите тип опроса</option>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach                          
                                    </select>
                            </p>
                            <p>
                                <span class="input-notification information">Тип вопроса</span> <!-- Classes for input-notification: success, error, information, attention -->
                                <span class="error"></span>
                            </p>
                            <div class="questions_inputs">
                                <!-- JS edit Inputs -->
                            </div>


                            <p>
                                <input type="hidden" name="submit_1" value="new_q" />
                                	<input type="hidden" name="razdel" value="{{$razdel}}" >
                                <input id="q_submit" class="button" type="button" value="Добавить" />
                            </p>
                        </div>
                        <div class="questions_view">
                            <div class="q_title"><h3>Соц. Опрос</h3></div>
                            <fieldset>
                                <p class="q_text"><!-- JS edit Views --></p>
                                <ul class="q_choice">
                                    <!-- JS edit Views -->
                                </ul>
                            </fieldset>
                        </div>
                    </div>
                </fieldset>

                <div class="clear"></div><!-- End .clear -->

            </form>

        </div> <!-- End .content-box-content -->

    </div> <!-- End .content-box -->

    			<div id="messages" style="display: none"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
				
				<h3>Смена пароля</h3>
			 
				<p>
					<strong>Введите новый пароль администратора</strong>
				</p>
			 
				<form action="http://test.myldl.ru/admin/change_pass" method="post">
					<input type="hidden" name="ci_csrf_token" value="">
				
					<fieldset>
						<input class="text-input " type="text" name="pass"  />
					
						<input class="button" type="submit" value="Изменить" />						
					</fieldset>
					
				</form>
				
			</div> <!-- End #messages -->

			<div id="footer">
				<small>
					<a href="/">&#169; Copyright 2013 - {{date('Y')}} MyLDL</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
 @push('js')

        
         @endpush

@endsection