
		@extends('layouts.admin.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
	<div id="main-content"> <!-- Main Content Section with everything -->
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					<h3>Комментарии</h3>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
			   
					<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->

<!-- ----------- Филтры ----------- -->

<div class="comments-filter">

	<form id="comments-filter-send" method="post" accept-charset="utf-8">
		<input type="hidden" name="ci_csrf_token" value="">
		
		<!-- Header table -->
		<div class="comments-filter-header">
			<label style="cursor: pointer;">
				<strong style="border-bottom: 1px dashed blue;">Фильтр для комментариев</strong>&nbsp;&nbsp;&nbsp;
				<input name="filter_checkbox" type="checkbox"  />
			</label>
		</div><!-- End Header table .comments-filter-header -->
		
		<!-- Body table -->
		<div class="comments-filter-body" style="display: none;">
			
			<!-- Sections Filter -->
			<div class="comments-filter-input">
				<div class="comments-filter-name">
					<strong>Разделы:</strong>
				</div>
				
				<!--<script type="text/javascript">$('.selectpicker').selectpicker();</script>-->
			</div><!-- End Sections Filter .comments-filter-input -->

			<!-- Date Filter -->
			<div class="comments-filter-input">
				<div class="comments-filter-name">
					<strong>Период:</strong>
				</div>
				<div class="comments-filter-value">
					<strong>&nbsp;от&nbsp;</strong>
					<input type="date" name="filter_date_form" value="2019-07-05" />
					<strong>&nbsp;до&nbsp;</strong>
					<input type="date" name="filter_date_before" value="2020-07-04" />
				</div>
			</div><!-- End Date Filter .comments-filter-input -->

			<!-- Search Filter -->
			<div class="comments-filter-input">
				<div class="comments-filter-name">
					<strong>Поиск:</strong>
				</div>
				<div class="comments-filter-value">
					<input class="comments-filter_search" type="text" name="filter_search" value="" placeholder="Введите искомую фразу..." />
				</div>
			</div><!-- End Search Filter .comments-filter-input -->

			<!-- Footer table -->
			<div class="comments-filter-button">
				<input id="filter_reset" type="button" value="Сбросить" />
				<input type="button" name="filter_btn" value="Отменить" />
				<input type="hidden" name="filter_submit-ok" value="1" />
				<input type="submit" value="Отфильтровать" />
			</div><!-- End Footer table .comments-filter-header -->
		</div>
		
	</form>

</div><!-- End .comments-filter -->


<!-- ----------- Таблица Комментариев ----------- -->

<table>

	<thead>
		<tr>
		   <th>№</th>
		   <th>Коментарий</th>
		   <th>Категории</th>
		   <th>Имя&nbsp;/&nbsp;Дата</th>
		   <th>Уд.</th>
		</tr>
	</thead>

	<tbody>
		
		<tr >
			<td>1</td>
			<td>
				<div class="com-table-text">тест2</div>
			</td>
			<td>
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="http://test.myldl.ru/diary/item/15#k385">diary</a></strong></div>
				<div class="com-table-title"></div>
			</td>
			<td>
				<div class="com-table-otstup"><strong><a href="http://test.myldl.ru/admin/user_edit/11836">LDLe</a></strong></div>
				<div class="com-table-otstup"><span style="font-size: 11px;">09.01.2020___10:53:08</span></div>
			</td>
			<td id="k385" class="com_del" style="vertical-align: middle;">
				<a href="http://test.myldl.ru/admin/comment?com_del=385#k385" title="Удалить"><img src="http://test.myldl.ru/application/views/admin/resources/images/icons/cross.png" alt="Delete" /></a>
			</td>
		</tr>
		<tr >
			<td>2</td>
			<td>
				<div class="com-table-text">test</div>
			</td>
			<td>
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="http://test.myldl.ru/searche/106#k384">searche</a></strong></div>
				<div class="com-table-title"></div>
			</td>
			<td>
				<div class="com-table-otstup"><strong><a href="http://test.myldl.ru/admin/user_edit/8"></a></strong></div>
				<div class="com-table-otstup"><span style="font-size: 11px;">27.11.2019___17:42:05</span></div>
			</td>
			<td id="k384" class="com_del" style="vertical-align: middle;">
				<a href="http://test.myldl.ru/admin/comment?com_del=384#k384" title="Удалить"><img src="http://test.myldl.ru/application/views/admin/resources/images/icons/cross.png" alt="Delete" /></a>
			</td>
		</tr>
		<tr >
			<td>3</td>
			<td>
				<div class="com-table-text">test</div>
			</td>
			<td>
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="http://test.myldl.ru/5#k383"></a></strong></div>
				<div class="com-table-title"></div>
			</td>
			<td>
				<div class="com-table-otstup"><strong><a href="http://test.myldl.ru/admin/user_edit/8"></a></strong></div>
				<div class="com-table-otstup"><span style="font-size: 11px;">27.11.2019___17:25:17</span></div>
			</td>
			<td id="k383" class="com_del" style="vertical-align: middle;">
				<a href="http://test.myldl.ru/admin/comment?com_del=383#k383" title="Удалить"><img src="http://test.myldl.ru/application/views/admin/resources/images/icons/cross.png" alt="Delete" /></a>
			</td>
		</tr>
		<tr >
			<td>4</td>
			<td>
				<div class="com-table-text">test</div>
			</td>
			<td>
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="http://test.myldl.ru/diary/item/15#k382">diary</a></strong></div>
				<div class="com-table-title"></div>
			</td>
			<td>
				<div class="com-table-otstup"><strong><a href="http://test.myldl.ru/admin/user_edit/8"></a></strong></div>
				<div class="com-table-otstup"><span style="font-size: 11px;">27.11.2019___17:23:24</span></div>
			</td>
			<td id="k382" class="com_del" style="vertical-align: middle;">
				<a href="http://test.myldl.ru/admin/comment?com_del=382#k382" title="Удалить"><img src="http://test.myldl.ru/application/views/admin/resources/images/icons/cross.png" alt="Delete" /></a>
			</td>
		</tr>
		<tr >
			<td>5</td>
			<td>
				<div class="com-table-text">test</div>
			</td>
			<td>
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="http://test.myldl.ru/delo/103#k381">Дела</a></strong></div>
				<div class="com-table-title"></div>
			</td>
			<td>
				<div class="com-table-otstup"><strong><a href="http://test.myldl.ru/admin/user_edit/8"></a></strong></div>
				<div class="com-table-otstup"><span style="font-size: 11px;">27.11.2019___17:21:31</span></div>
			</td>
			<td id="k381" class="com_del" style="vertical-align: middle;">
				<a href="http://test.myldl.ru/admin/comment?com_del=381#k381" title="Удалить"><img src="http://test.myldl.ru/application/views/admin/resources/images/icons/cross.png" alt="Delete" /></a>
			</td>
		</tr>
		<tr >
			<td>6</td>
			<td>
				<div class="com-table-text">test</div>
			</td>
			<td>
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="http://test.myldl.ru/news/item/28#k380">news</a></strong></div>
				<div class="com-table-title"></div>
			</td>
			<td>
				<div class="com-table-otstup"><strong><a href="http://test.myldl.ru/admin/user_edit/8"></a></strong></div>
				<div class="com-table-otstup"><span style="font-size: 11px;">27.11.2019___17:18:05</span></div>
			</td>
			<td id="k380" class="com_del" style="vertical-align: middle;">
				<a href="http://test.myldl.ru/admin/comment?com_del=380#k380" title="Удалить"><img src="http://test.myldl.ru/application/views/admin/resources/images/icons/cross.png" alt="Delete" /></a>
			</td>
		</tr>
		<tr >
			<td>7</td>
			<td>
				<div class="com-table-text">Проверка комментов</div>
			</td>
			<td>
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="http://test.myldl.ru/searche/104#k379">searche</a></strong></div>
				<div class="com-table-title"></div>
			</td>
			<td>
				<div class="com-table-otstup"><strong><span style="color: #646464;">Сергей</span></strong></div>
				<div class="com-table-otstup"><span style="font-size: 11px;">24.05.2019___09:53:58</span></div>
			</td>
			<td id="k379" class="com_del" style="vertical-align: middle;">
				<a href="http://test.myldl.ru/admin/comment?com_del=379#k379" title="Удалить"><img src="http://test.myldl.ru/application/views/admin/resources/images/icons/cross.png" alt="Delete" /></a>
			</td>
		</tr>
		<tr >
			<td>8</td>
			<td>
				<div class="com-table-text">Работает?</div>
			</td>
			<td>
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="http://test.myldl.ru/searche/101#k378">searche</a></strong></div>
				<div class="com-table-title"></div>
			</td>
			<td>
				<div class="com-table-otstup"><strong><span style="color: #646464;">Дмитрий</span></strong></div>
				<div class="com-table-otstup"><span style="font-size: 11px;">24.05.2019___09:09:00</span></div>
			</td>
			<td id="k378" class="com_del" style="vertical-align: middle;">
				<a href="http://test.myldl.ru/admin/comment?com_del=378#k378" title="Удалить"><img src="http://test.myldl.ru/application/views/admin/resources/images/icons/cross.png" alt="Delete" /></a>
			</td>
		</tr>
		<tr >
			<td>9</td>
			<td>
				<div class="com-table-text">ввввв</div>
			</td>
			<td>
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="http://test.myldl.ru/news/item/151#k377">news</a></strong></div>
				<div class="com-table-title"></div>
			</td>
			<td>
				<div class="com-table-otstup"><strong><a href="http://test.myldl.ru/admin/user_edit/8"></a></strong></div>
				<div class="com-table-otstup"><span style="font-size: 11px;">04.04.2019___18:06:46</span></div>
			</td>
			<td id="k377" class="com_del" style="vertical-align: middle;">
				<a href="http://test.myldl.ru/admin/comment?com_del=377#k377" title="Удалить"><img src="http://test.myldl.ru/application/views/admin/resources/images/icons/cross.png" alt="Delete" /></a>
			</td>
		</tr>
		<tr >
			<td>10</td>
			<td>
				<div class="com-table-text">Интересно<img src="http://test.myldl.ru/application/views/front/images/smiles/cool.gif" alt="cool" /></div>
			</td>
			<td>
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="http://test.myldl.ru/news/item/147#k376">news</a></strong></div>
				<div class="com-table-title"></div>
			</td>
			<td>
				<div class="com-table-otstup"><strong><span style="color: #646464;">антон</span></strong></div>
				<div class="com-table-otstup"><span style="font-size: 11px;">04.04.2019___16:38:26</span></div>
			</td>
			<td id="k376" class="com_del" style="vertical-align: middle;">
				<a href="http://test.myldl.ru/admin/comment?com_del=376#k376" title="Удалить"><img src="http://test.myldl.ru/application/views/admin/resources/images/icons/cross.png" alt="Delete" /></a>
			</td>
		</tr>	</tbody>

	<tfoot>
		<tr>
			<td colspan="5" style="text-align: center;">
				<div class="pagination">
					<a class="number current">1</a><a href="http://test.myldl.ru/admin/comment/10" data-ci-pagination-page="2">2</a><a href="http://test.myldl.ru/admin/comment/20" data-ci-pagination-page="3">3</a><a href="http://test.myldl.ru/admin/comment/30" data-ci-pagination-page="4">4</a><a href="http://test.myldl.ru/admin/comment/40" data-ci-pagination-page="5">5</a><a href="http://test.myldl.ru/admin/comment/50" data-ci-pagination-page="6">6</a><a href="http://test.myldl.ru/admin/comment/60" data-ci-pagination-page="7">7</a><a href="http://test.myldl.ru/admin/comment/70" data-ci-pagination-page="8">8</a><a href="http://test.myldl.ru/admin/comment/80" data-ci-pagination-page="9">9</a><a href="http://test.myldl.ru/admin/comment/90" data-ci-pagination-page="10">10</a><a href="http://test.myldl.ru/admin/comment/100" data-ci-pagination-page="11">11</a><a href="http://test.myldl.ru/admin/comment/10" data-ci-pagination-page="2" rel="next">></a><a href="http://test.myldl.ru/admin/comment/360" data-ci-pagination-page="37">>></a>				</div> <!-- End .pagination -->
				<div class="clear"></div>
			</td>
		</tr>
	</tfoot>

</table>

<!-- Всплывающее окно -->
<div class="popup-body popup-body-style"></div>
<div class="popup popup-style">
	<div class="popup-close popup-close-style"></div>
	<div class="comments-del-title">#</div>
	<a class="comments-del-btn-yes" href="#">#</a><div class="comments-del-btn-no">Отменить</div>
</div>
<!-- End - Всплывающее окно -->


					</div> <!-- End #tab1 -->
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->

<!-- Main Js Management -->
<script type="text/javascript">
$(function() {
//    $(".popup-anch a").simplePopup();
});
$(document).ready(function(){
	
	// когда стоит галочка в филтрации
	if ($('input[name=filter_checkbox]').is(":checked"))
		$('.comments-filter-body').show(300);  //показываем таблицу филтра
	
	// выбрана-ли филтрация комментария
	$('input[name=filter_checkbox]').click(function(){
		var bodyT = $('.comments-filter-body');
		if ($(this).is(":checked"))
			bodyT.show(300);  //показываем таблицу филтра
		else
			bodyT.hide(300);  //скрываем таблицу филтра
	});
	
	// при сбросе настроек филтра
	$('#filter_reset').click(function(){
		$('input[name=filter_checkbox]').attr('checked', 'true');  // обратно ставим галочку в выборе филтра
		$('input[name=filter_search]').val('');
		var dateFrom = '2019-07-05';
		var dateBefore = '2020-07-04';
		$('input[name=filter_date_form]').val(dateFrom);
		$('input[name=filter_date_before]').val(dateBefore);
		$(".comments-filter_sections [value='0']").attr({'selected':'selected'});
	});
	
	// при нажатие на "Отменить" в филтре
	$('input[name=filter_btn]').click(function(){
		$('#comments-filter-send').append('<input type="hidden" name="filter_submit-no" value="1" />');
		$('input[name=filter_submit-ok]').attr({'name':'filter_submit_false'});
		$('#comments-filter-send').submit();
	});
	
	// Запрос на удаления комментария
	$(".com_del").on("click", "a", function (event) {
		event.preventDefault();  //отменяем стандартную обработку нажатия по ссылке
		var delUrl = $(this).attr('href');  //получаем URL адрес
		$('.comments-del-btn-yes').attr({'href':delUrl});  //устанавливаем URL для удаления коммента
		$('.comments-del-title').text('Удалить сообщения');  //устанавливаем загаловок
		$('.comments-del-btn-yes').text('Удалить');  //устанавливаем название кнопки
	}).simplePopup();
	
	// Запрос на восстановления комментария
	$(".com_mod").on("click", "a", function (event) {
		event.preventDefault();  //отменяем стандартную обработку нажатия по ссылке
		var modUrl = $(this).attr('href');  //получаем URL адрес
		$('.comments-del-btn-yes').attr({'href':modUrl});  //устанавливаем URL для удаления коммента
		$('.comments-del-title').text('Восстановить сообщения');  //устанавливаем загаловок
		$('.comments-del-btn-yes').text('Восстановить');  //устанавливаем название кнопки
	}).simplePopup();
	
	// закрываем после клика - удалить/восстановить комментария
	$('.comments-del-btn-yes').click(function(){
		$('.popup-body, .popup').fadeOut(300, 0);
	});
	
	// отмена удаления/восстановить комментария
	$('.comments-del-btn-no').click(function(){
		$('.comments-del-btn-yes').attr({'href':'#'});  //удалем URL из кнопки удаления коммента
		$('.popup-body, .popup').fadeOut(300, function () {
			$('.comments-del-title').text('#');  //обнуляем загаловок
			$('.comments-del-btn-yes').text('#');  //обнуляем название кнопки 
		});
	});
	
});
</script>

			<div class="clear"></div>
			
			
			<div id="footer">
				<small>
					<a href="/">&#169; Copyright 2013 - {{date('Y')}} MyLDL</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
			
		
			
        
  @push('js')

        
         @endpush

@endsection