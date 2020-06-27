	@extends('layouts.admin.app')
@section('title','Меню сайта')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')

<div id="main-content"> <!-- Main Content Section with everything -->
			
			<!-- Page Head -->
			<h2>Главное меню</h2>
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-content">
<style>
#main-content ul, #main-content ol {
    padding: 0px 0;
	cursor: pointer;
}
#main-content ul li {
    padding: 0 0 3px 30px;
}
</style>			   

			<table id="zcontent" border="0" cellpadding="10" cellspacing="10" width="90%">
			<tbody>
			<tr>
				<td valign="top">
				    <ul class="tree_lvl_2">
				      {!!$output!!}
				<td valign="top">
				<form action="/admin/menu/store" method="post" accept-charset="utf-8">
				    @csrf
					<table>
						<tr><td colspan="2">&nbsp;&nbsp;<b>Создание пункта меню</b></td></tr>
						<tr>
						<td width="100px">Название</td>
						<td><input size="30" name="nazva" type="text" value=""></td>
						</tr>
						<tr>
						<td width="200px">Вывод на сайте</td>
						<td><select size="1" name="active">
							<option value="0">Деактивирована</option>
							<option value="1">Активная</option>
						</select></td>
						</tr>
						<tr>
						<td width="100px">Вложенность</td>
						<td><input size="30" name="p_id" type="text" value="" readonly="true"></td>
						</tr>
						<tr>
						<td width="100px">Ссылка</td>
						<td><input size="30" name="banner" type="text" value=""></td>
						</tr>
						<tr>
						<td width="100px">&nbsp;</td>
						<td><input name="id" type="hidden" value="1">
							<input value="Создать" type="submit">							
						</td>
						</tr>
						</table>
					</form>
					
					<p>&nbsp;</p>
					
					<form action="/admin/menu/edit" method="post" accept-charset="utf-8">
					    @csrf
					<table>
						<tr><td colspan="2">&nbsp;&nbsp;<b>Редактирование пункта меню</b></td></tr>
						<tr>
						<td width="100px">Название</td>
						<td><input size="30" name="nazva" type="text" value=""></td>
						</tr>
						<tr>
						<td width="200px">Вывод на сайте</td>
						<td><select size="1" name="active" id="active">
							<option value="0">Деактивирована</option>
							<option value="1">Активная</option>
						</select></td>
						</tr>
						<tr>
						<td width="100px">Вложенность</td>
						<td><input size="30" name="p_id" type="text" value="" readonly="true"></td>
						</tr>
						<tr>
						<td width="100px">Ссылка</td>
						<td><input size="30" name="banner" type="text" value=""></td>
						</tr>
						<tr>
						<td width="100px">&nbsp;</td>
						<td><div style="visibility:hidden;" class="block_ed">
								<input value="Отредактировать" type="submit">	
								<a href="" class="del">&nbsp;&nbsp;Удалить</a>
							</div>
						</td>
						</tr>
					</table>
					</form>
				</td>
			</tr>			
			</tbody>
			</table>	

						
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			

			

			<div id="footer">
				<small>
					<a href="/">&#169; Copyright 2013 - {{date('d')}} MyLDL</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		<script type="text/javascript">
$(document).ready(function(){
	$('.tree_lvl_2 li a').click(function(){
		$('input[name=p_id]').val($(this).attr('id'));
		$('.tree_lvl_2 li a').css('color', '#57A000');
		$(this).css('color', 'red');
	$('input[name=banner]').val($(this).attr("url"));
		$('input[name=nazva]:last').val($(this).text());	
		$('.block_ed').css('visibility','visible');
		
		
		$.ajax({
			type: "GET",
			url: "/ajax_click_menu/"+$(this).attr('id'),
			dataType: "html",
			success: function(msg){
				var obj = jQuery.parseJSON(msg);
				$('input[name=banner]').val(obj.banner);
				if(obj.active == 1) { 
					$('#active option:last').attr('selected', 'selected');						
				} else {
					$('#active option:first').attr('selected', 'selected');					
				}
			}
		});
	});

	
});

</script>

@push('js')

        
         @endpush

@endsection