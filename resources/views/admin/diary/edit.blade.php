	@extends('layouts.admin.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
<div id="main-content"> <!-- Main Content Section with everything -->
			
			<!-- Page Head -->
			<h2>Редактирование записи - {{$diary->name}}</h2>
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-content">
			   
						
							<form class="right" action="{{route('admin.adminpanel.diary.update')}}" method="post">
                                  @csrf
                                   @method('PUT')
							
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>
									<input class="text-input small-input" type="text" name="title" value="{{$diary->name}}" />
									<span class="input-notification information">Название</span> <!-- Classes for input-notification: success, error, information, attention -->&nbsp;&nbsp;&nbsp;
									
								</p>
								<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10"><p>{!!$diary->text!!}</p></textarea>
                                                    
                            	<input type="hidden" name="id" value="{{$diary->id}}" />
								<p><input class="button" type="submit" value="Сохранить" /></p>
								
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
					<a href="http://test.myldl.ru/">&#169; Copyright 2013 - 2015 MyLDL</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
 @push('js')

        
         @endpush

@endsection