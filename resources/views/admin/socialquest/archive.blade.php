	@extends('layouts.admin.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')

<script type="text/javascript">
    $(document).ready(function () {

        // Выделения кнопки текущего раздела
        $('.social-razdel-' +5).attr({'class': 'active_menu'});

    });

// удалить запрашиваемую запись
    function social_q_del(url, title)
    {
        if (confirm("Удалить опрос: " + title))
            window.location.href = url;
    }

// Отправка настройки Опроса на сервер
    function get_settings_server(id)
    {
        // Объект Информера загрузки (лоадера)
        var objS = $('#get_Status_' + id);
        objS.html('Подождите, идет загрузка...');
        objS.attr({'class': 'input-notification information'});
        objS.fadeIn(800);
        // Статус опроса
        var stat_val = $('#selected_is_open_' + id).val();
        // Преобразуем форму в массив
        var form_data = $("#get_submit_" + id).serialize();
        //form_data['ci_csrf_token'] = $.cookie('hash_cookie_id');

        // отправим запрос на сервер
        $.ajax({
            url: $("#get_submit_" + id).attr('action'),
            type: 'POST', // Делаем POST запрос
            data: form_data,
            dataType: "html",
            success: function (msg) {
                // ОШИБКА

                if (msg == 'error')
                {
                    objS.html('Ошибка...');
                    objS.attr({'class': 'input-notification attention'});
                    objS.fadeOut(1200);
                    return;
                }
                // УСПЕХ
                if (msg == 'yes')
                {
                    objS.html('Успешно сохранено :)');
                    objS.attr({'class': 'input-notification success'});
                    objS.fadeOut(1200);
                    //изменяем статус в шапке опроса
                    var src_open = '<img src="http://test.myldl.ru/application/views/admin/resources/images/icons/tick_circle.png" title="Открытый" />';
                    var src_close = '<img src="http://test.myldl.ru/application/views/admin/resources/images/icons/exclamation.png" title="Закрытый" />';
                    if (stat_val != 0)
                        $('.current_status_img_' + id).html(src_open);
                    else
                        $('.current_status_img_' + id).html(src_close);
                    return;
                }
                // ДРУГОЕ
                objS.html('Неожиданная Ошибка...');
                objS.attr({'class': 'input-notification attention'});
                objS.fadeOut(1200);
                return;
            }
        });
    }

// Закрываем блок настройками и информацией Соц.Опроса
    function close_social_q_block(id)
    {
        $('#q_info_id_' + id).fadeOut(800);
        $('#q_settings_id_' + id).fadeOut(800);
    }

// настройки/информация Соц.Опросов
    function open_social_q_settings(id)
    {
        // открываем блок с настройками и информацией
        $('#q_info_id_' + id).fadeIn(800);
        $('#q_settings_id_' + id).fadeIn(800);
        $(function () {
            $("#date_end_"+id).datepicker({dateFormat: "yy-mm-dd"});
        });
        // подгатавливаем информационные блоки
        var obj_i_id = $('#q_info_id_' + id);     // текущий объект информера
        var obj_s_id = $('#q_settings_id_' + id); // текущий объект настроек
        obj_i_id.find('.qi_loading').show();    // показываем блок - загрузки
        obj_i_id.find('.qi_count_VQ').hide();   // скрываем блок - кол. ответов/просмотров
       obj_i_id.find('.qi_rating').hide();     // скрываем блок - рейтинга
       //obj_s_id.find('.qs_table').hide();      // скрываем блок - таблицу отчета
     $(this).find('.qi_loading').css({'display': 'none'});
          //obj_s_id.find('.qi_loading').hide(100);
         
        // получаем информацию о запрашиваемом Соц.Опросе
      // получаем информацию о запрашиваемом Соц.Опросе
        $.ajax({
            type: "GET",
            url: "/admin/social_questions/result/" + id,
            dataType: "json",
            success: function (msg) {
                // ОШИБКА
                if (msg.run_get === 'error')
                {
                    alert('Ошибка!');
                    close_social_q_block(id); //закрываем блок
                    return false;
                }
                // УСПЕХ
                if (msg.run_get === 'yes')
                {
                    // Информация о количестве просмотров/ответов
                    var obj_i_id = $('#q_info_id_' + msg.q_id);
                    obj_i_id.find('.qi_count_VQ').show();
                    obj_i_id.find('.qi_count_v').text(msg.count_v);
                    
                    obj_i_id.find('.qi_count_q').text(msg.count_q);

                    // Объект блока Рейтинга
                    var obj_R = $('#q_info_id_' + msg.q_id);

                    // Блок с рейтингом ответов на опросы
                    if (typeof (msg.block_rating) != 'undefined' && msg.block_rating != '')
                    {
                        // Декодируем и внедряем в шаблон (страничку)
                        var str_info = base64_decode(msg.block_rating);
                        obj_R.find('.qi_rating').html(str_info);

                        // Изменяем вид шкалы (стильи рейтинговых линий)
                        var count_rl = $('.qi_rating_line').length;
                        
                        for (var x1 = 0; x1 < count_rl; x1++)
                        {
                            var obj_l = $('.qi_rating_line').eq(x1);
                            var size_percent = obj_l.attr('r_percent');
                            obj_l.css({'width': size_percent + '%'});
                            var level_color = 0;
                            if (size_percent >= 75)  // x >= 75%
                                level_color = 3;
                            else if (size_percent >= 50)  // x >= 50%
                                level_color = 2;
                            else if (size_percent >= 25)  // x >= 25%
                                level_color = 1;
                            // раскрашиваем уровни
                            obj_l.attr({'class': 'qi_rating_line qi_rating_line_color_' + level_color});
                        }
                        obj_R.find('.qi_rating').show(500);
                    }
                    obj_R.find('.qi_loading').hide(100);

                    return;
                }
                // ДРУГОЕ
                alert('Неожиданная Ошибка!');
                close_social_q_block(id); //закрываем блок
                return false;
            }
        });
    }

// Декодирования base64
    function base64_decode(data)
    {
        var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
        var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
                ac = 0,
                dec = '',
                tmp_arr = [];

        if (!data)
            return data;
        data += '';

        do {
            // unpack four hexets into three octets using index points in b64
            h1 = b64.indexOf(data.charAt(i++));
            h2 = b64.indexOf(data.charAt(i++));
            h3 = b64.indexOf(data.charAt(i++));
            h4 = b64.indexOf(data.charAt(i++));

            bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

            o1 = bits >> 16 & 0xff;
            o2 = bits >> 8 & 0xff;
            o3 = bits & 0xff;

            if (h3 == 64)
                tmp_arr[ac++] = String.fromCharCode(o1);
            else if (h4 == 64)
                tmp_arr[ac++] = String.fromCharCode(o1, o2);
            else
                tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);

        } while (i < data.length);

        dec = tmp_arr.join('');
        return decodeURIComponent(escape(dec.replace(/\0+$/, '')));
    }
</script>

 <div id="main-content"> <!-- Main Content Section with everything -->

    <div class="clear"></div> <!-- End .clear -->

    <div class="content-box"><!-- Start Content Box -->

        <div class="content-box-header">


            <div class="clear"></div>

        </div> <!-- End .content-box-header -->

        <div class="content-box-content">

            <div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->

                <table>

                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Опрос</th>
                            <th>Тип опроса</th>
                            <th>Кол. ответов</th>
                            <th>Дата нач.</th>
                            <th>Истекает</th>
                            <th>Статус</th>
                            <th>Действие</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        @foreach($quests  as  $quest)
                        
                          <tr>
                                <td>{{$quest->id}}</td>
                                <td><div style="width: 300px;">{{$quest->text}}</div></td>
                                <td><?if($quest->tip_id==1)echo 'Один выбор'?>
                                    <?if($quest->tip_id==2)echo 'Мульти выбор'?>
                                     <?if($quest->tip_id==3)echo 'Да-Нет'?>
                                     <?if($quest->tip_id==4)echo 'Один выбор'?>
                                
                                </td>
                                <td>{{$quest->getCountAnswer($quest->id)}}</td>
                                <td>{{ Carbon\Carbon::parse($quest->created_at)->format('d.m.y') }}</td>
                                <td>{{$quest->end_date}}</td>
                                <td class="current_status_img_{{$quest->id}}" >
                                     
									       	    @if($quest->is_open==1)
									       <img src="{{asset('asset/admin/resources/images/icons/tick_circle.png')}}" title="Открыто" />
									       @else
									       <img src="{{asset('asset/admin/resources/images/icons/exclamation.png')}}" title="Закрыто" />
									       @endif
									       
                                    
                                </td>
                                <td>
                                    <!-- Icons -->
    <!--										<a href="--><!--" title="Редактировать"><img src="--><!--application/views/admin/resources/images/icons/pencil.png" alt="Edit" /></a>&nbsp;&nbsp;&nbsp;-->
                                    <a href="{{route('admin.adminpanel.sq.delete',$quest->id)}}"  onclick="myFunction()" title="Удалить"><img src="{{asset('asset/admin/resources/images/icons/cross.png')}}" alt="Delete" /></a>
                                    <a href="javascript:open_social_q_settings('{{$quest->id}}')" title="Настройки"><img src="{{asset('asset/admin/resources/images/icons/hammer_screwdriver.png')}}" alt="Settings" /></a>
                                </td>
                            </tr>
                           
                           
                           
                           <tr id="q_info_id_{{$quest->id}}" class="questions_info" style="display:none;">
                                <td colspan="8">
                                    <div class="qi_info">
                                        <a href="javascript:close_social_q_block('{{$quest->id}}')" class="qi_close" title="Закрыть"><img src="{{asset('asset/admin/resources/images/icons/cross_grey_small.png')}}"></a>
                                        <div class="qi_loading" style="display: none;"></div>
                                        <div class="qi_count_VQ" style="display: block;"><i>Просмотров:</i> <b><span class="qi_count_v">0</span></b> &nbsp;&nbsp; <i>Ответов:</i> <b><span class="qi_count_q">0</span></b></div>
                                        <div class="qi_rating" style="display: block;">
                                  
                                  </div>
                                    </div>
                                </td>
                            </tr>
                           
                           
                            
                            <tr id="q_settings_id_{{$quest->id}}" class="questions_settings" >
                                <td colspan="8">
                                    <div class="qs_settings">
                                        <div class="qs_table" style="display:block">
                                            <div class="qs_title">Общая - Информация / Настройка</div>
                                            <div class="qs_form">

                                                <form  name="form_razdel" action="/admin/ajax_social_questions_settings" method="post">
                                                    @csrf
                                                    <input id="sq" name="sq_id" type="hidden" value="{{$quest->id}}"/>
                                                    <div class="qs_is_status">
                                                        <fieldset>
                                                            <p>
                                                                <select  name="is_open">
                                                                    <option <?if($quest->is_open==0)echo "selected" ?> value="0">Закрытый</option>
                                                                    <option <?if($quest->is_open==1)echo "selected" ?> value="1">Открытый</option>
                                                                </select>
                                                                <span class="input-notification information">Статус</span> <!-- Classes for input-notification: success, error, information, attention -->
                                                            </p>
                                                            <p>
                                                                <input type="text" name="date_end" id="date_end_{{$quest->id}}" value="{{$quest->end_date}}" />
                                                                <span class="input-notification information">Дата Истечения</span> <!-- Classes for input-notification: success, error, information, attention -->
                                                            </p>
                                                        </fieldset>
                                                    </div>
                                                    <div class="qs_info_table">
                                                        <div class="qs_all_td">
                                                            <!-- JS edit Views -->
                                                        </div>
                                                        </p>
                                                        <input class="button" type="submit" value="Изменить" />
                                                        <br><br><span id="get_Status_8" class="input-notification information" style="display: none;">...</span> <!-- Classes for input-notification: success, error, information, attention -->
                                                        </p>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                              </tbody>

                </table>

            </div> <!-- End #tab1 -->


        </div> <!-- End .content-box-content -->

    </div> <!-- End .content-box -->


    <div class="clear"></div>

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
					<a href="http://test.myldl.ru/">&#169; Copyright 2013 - 2015 MyLDL</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->


				  <script>
function myFunction(e)
{
 
if (confirm("Удалить запись?"))
  {
  
 
  }
else
  {
  
  var evt = e ? e : window.event;
    //abort();

    (evt.preventDefault) ? evt.preventDefault() : evt.returnValue = false;

    return false;
  }
 
}
</script>
 @push('js')

        
         @endpush

@endsection