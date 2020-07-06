
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
		@foreach($comments as $comment)
		<tr >
		
			<td>{{$comment->id}}</td>
			<td>
				<div class="com-table-text">{{$comment->text}}</div>
			</td>
			<td>
			    @if(get_class($comment)==='App\CommentDele')
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="/delo/{{$comment->dela_id}}">Дела</a></strong></div>
						
				@endif
				@if(get_class($comment)==='App\CommentNews')
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="/news/item/{{$comment->news_id}}">Новости</a></strong></div>
						
				@endif
				@if(get_class($comment)==='App\CommentProject')
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="/project/item/{{$comment->project_id}}">Проект</a></strong></div>
						
				@endif
				@if(get_class($comment)==='App\CommentDiary')
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="/diary/item/{{$comment->diary_id}}">Дневник</a></strong></div>
						
				@endif
				@if(get_class($comment)==='App\CommenPoll')
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="/poll/view/{{$comment->q_id}}">Опрос</a></strong></div>
						
				@endif
				@if(get_class($comment)==='App\Future')
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="/profile/future_business/index/{id}{{$comment->dela_id}}">Дела</a></strong></div>
						
				@endif
				@if(get_class($comment)==='App\CommentDele')
				<div class="com-table-otstup"><strong style="border-bottom: 1px dashed green;"><a target="_blank" href="/delo/{{$comment->dela_id}}">Дела</a></strong></div>
						
				@endif
			</td>
			<td>
			@if(isset($comment->user_id))
				<div class="com-table-otstup"><strong><a href="/admin/user_edit/{{$comment->user_id}}">{{$comment->user->name}}</a></strong></div>
			@endif
			@if(isset($comment->name_author))
			<div class="com-table-title">{{$comment->name_author}}</div>
		     @endif
				<div class="com-table-otstup"><span style="font-size: 11px;">{{ Carbon\Carbon::parse($comment->created_at)->format('d.m.Y')}}</span></div>
			</td>
			<td id="k385" class="com_del" style="vertical-align: middle;">
				<a href="http://test.myldl.ru/admin/comment?com_del=385#k385" title="Удалить"><img src="{{asset('asset/admin/resources/images/icons/cross.png')}}" alt="Delete" /></a>
			</td>
		</tr>
		
		@endforeach
			</tbody>

	
							<tfoot>

								<tr>
									<td colspan="6" style="text-align: center;">
										<div class="pagination">
										    {{ $comments->links('admin.paginate') }}
										    
										</div>
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