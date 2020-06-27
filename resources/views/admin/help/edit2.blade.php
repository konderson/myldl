		@extends('layouts.admin.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')

<div id="main-content"> <!-- Main Content Section with everything -->
			
			<!-- Page Head -->
			<h2>Редактирование взаимопомощи </h2>
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-content">
			   
						<form class="right" action="{{route('admin.adminpanel.poiski.update')}}" method="post">
                                  @csrf
                                   @method('PUT')
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>
									<input class="text-input small-input" type="text" name="title" value="{{$help->title}}" />
									<span class="input-notification <?if(!empty($help->title)) {echo 'success';} else {echo 'attention'; } ?>">Тема</span>
									<!-- Classes for input-notification: success, error, information, attention -->
								</p><br><br>

								<p>
									<label>Описание</label>
									<textarea name="description">{{$help->description}}</textarea>
								</p>
							
                                <p>
                                    <input class="text-input small-input" type="text" name="email" value="{{$help->email}}" />
                                    <span class="input-notification <?if(!empty($help->email)) {echo 'success';} else {echo 'attention'; } ?>">E-mail</span>
                                    <!-- Classes for input-notification: success, error, information, attention -->
                                </p>
                                <p>
                                    <input class="text-input small-input" type="text" name="phone" value="{{$help->phone}}" />
                                    <span class="input-notification <?if(!empty($help->phone)) {echo 'success';} else {echo 'attention'; } ?>">Телефон</span>
                                    <!-- Classes for input-notification: success, error, information, attention -->
                                </p>
                                <p>
                                    <input class="text-input small-input" type="text" name="social" value="{{$help->cocial}}" />
                                    <span class="input-notification <?if(!empty($help->cocial)) {echo 'success';} else {echo 'attention'; } ?> ">Соц. сети</span>
                                    <!-- Classes for input-notification: success, error, information, attention -->
                                </p
								<p>
									<label>Раздел</label>
									<select name="razdel_id" class="small-input">
										<option value="1"   <?if($help->type==1) echo 'selected="selected"'?>>Хочу помочь</option>
										<option value="2" <?if($help->type==2) echo 'selected="selected"'?>>Нужна помощь</option>
										<option value="3" <?if($help->type==1) echo 'selected="selected"'?> >Ищу человека</option>
									</select>
								</p>								
								<p>
									<label>Статус</label>
									<select name="status" class="small-input">
										<option value="1" <?if($help->status==1) echo 'selected="selected"'?> selected="selected">Действует</option>
										<option value="0" <?if($help->status==0) echo 'selected="selected"'?>>Архив</option>
									</select>
								</p><br>
								<p>
									<label>Местонахождения</label>
									<input class="text-input small-input" type="text" name="country" value="{{$help->country->name}}" />
									<span class="input-notification <?if(!empty($help->country->id)) {echo 'success';} else {echo 'attention'; } ?>">Страна</span>
								</p>
								<p>
									<input class="text-input small-input" type="text" name="country" value="{{$help->getRegion($help->city_id)}}" />
									<span class="input-notification success">Регион</span>
								</p>
								<p>
									<input class="text-input small-input" type="text" name="city" value="{{$help->city}}" />
									<span class="input-notification <?if(!empty($help->city)) {echo 'success';} else {echo 'attention'; } ?>>" >Город</span>
								</p><br>
							<br>
								<input type="hidden" name="id" value="{{$help->id}}" />
								<p><input class="button" type="submit" value="Сохранить" /></p>
							</fieldset>
							
							
							<p>&nbsp;</p>
							<h2>Прикрепленные файлы</h2>
							<h3>Фото:</h3>
							<img src="http://test.myldl.ru/images/uploads/3264a51e3cfea0ec2ae756361888f075_thumb.jpg" style="padding:5px;" />							<p>&nbsp;</p>

							
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