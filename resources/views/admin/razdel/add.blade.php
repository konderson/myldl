	@extends('layouts.admin.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')


	<div id="main-content"> <!-- Main Content Section with everything -->
			
			<!-- Page Head -->
			<h2>Добавление нового раздела для Соц-Опросов</h2>
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-content">
			   
					<form action="/admin/razdel/store" method="post">
					@csrf

						<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

							<br>
							<p>
								<input class="text-input small-input" type="text" name="name" value="" />
								<span class="input-notification information">Название раздела</span> <!-- Classes for input-notification: success, error, information, attention -->
								<span class="error"></span>
							</p>
							<p>
								<select class="selected" name="flag" >
									<option value="1" SELECTED>Открытый</option>
									<option value="0" >Закрытый</option>
								</select>
								<span class="input-notification information">Флаг</span>&nbsp;&nbsp;
							</p>
							<p><input class="button" type="submit" value="Добавить" /></p><br>

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
			 
				<form action="/admin/razdel/add" method="post">
					@csrf
				
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
 @push('js')

        
         @endpush

@endsection