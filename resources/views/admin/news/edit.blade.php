	@extends('layouts.admin.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
<div id="main-content"> <!-- Main Content Section with everything -->
			
			<!-- Page Head -->
			<h2>Редактирование новости - Парсинг Instagram без api на php</h2>
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-content">
			   
						
							<form class="right" action="{{route('admin.adminpanel.news.update')}}" method="post">
                                  @csrf
                                   @method('PUT')
							
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>
									<input class="text-input small-input" type="text" name="title" value="{{$news->name}}" />
									<span class="input-notification information">Название</span> <!-- Classes for input-notification: success, error, information, attention -->&nbsp;&nbsp;&nbsp;
									<select class="selected" name="flag" >
										<option style="background: #e7c200;" value="{{$news->flag}}" SELECTED>{{$news->flag}}</option>
											<option value="0">0</option>
										@for($i=0;$i<$count;$i++)
										<option value="{{$i+1}}">{{$i+1}}</option>
										@endfor
										</select>
									<span class="input-notification information">Флаг</span>&nbsp;&nbsp;
                                    <br />
                                    <input class="text-input small-input" type="text" name="mtitle" value="{{$news->title}}" />
                                    <span class="input-notification information">Meta title</span>
                                    <input class="text-input small-input" type="text" name="description" value="{{$news->description}}" />
                                    <span class="input-notification information">Meta description</span>
                                    <input class="text-input small-input" type="text" name="keywords" value="{{$news->keyw}}" />
                                    <span class="input-notification information">Meta keywords</span>
								</p>
								<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10"><p>{!!$news->text!!}</p></textarea>
                                <p>Теги:</p>
                                
                                @foreach($tags as $tag)
                                       <label>
                                        <input
                                                type="checkbox"
                                                name="tags[]"
                                                value="{{$tag->id}}"
                                        >
                                        {{$tag->name}}
                                        </label>
                                  @endforeach                        
                                								<input type="hidden" name="id" value="{{$news->id}}" />
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