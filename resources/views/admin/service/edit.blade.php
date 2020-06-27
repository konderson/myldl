	@extends('layouts.admin.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')

<div id="main-content"> <!-- Main Content Section with everything -->
			
			<!-- Page Head -->
			<h2>Редактирование услуги</h2>
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-content">
			        
			        
						
					<form class="right" action="{{route('admin.adminpanel.service.update')}}" method="post">
                                  @csrf
                                   @method('PUT')
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p><input class="text-input small-input" type="text" name="tema" value="{{$service->title}}" /> <span class="input-notification success">Тема</span> <!-- Classes for input-notification: success, error, information, attention --></p>
								<p><label>Описание</label><textarea name="opisanie">{{$service->description}}</textarea></p>
								<p>
									<label>Раздел</label>
									<select name="razdel_id" class="small-input">
								<option value="1"  <?if($service->razdel_id==1) echo 'selected="selected"'?>>Транспорт</option>
								<option value="2" <?if($service->razdel_id==2) echo 'selected="selected"'?>>Недвижимость</option>
								<option value="3" <?if($service->razdel_id==3) echo 'selected="selected"'?>>Работа</option><option value="4">Вещи</option>
								<option value="5" <?if($service->razdel_id==5) echo 'selected="selected"'?>>Для быта</option><option value="6">Бытовая электроника</option>
								<option value="7" <?if($service->razdel_id==7) echo 'selected="selected"'?>>Хобби и отдых</option>
								<option value="8" <?if($service->razdel_id==8) echo 'selected="selected"'?>>Животные</option>
								<option value="9" <?if($service->razdel_id==9) echo 'selected="selected"'?>>Бизнес</option>
								</select> 
								</p>								
								<p>
									<label>Статус</label>
									<select name="status" class="small-input">
										 	<option value="1" <?if($service->status==1) echo 'selected="selected"'?> >Открыто</option>
														<option value="0"  <?if($service->razdel_id==0) echo 'selected="selected"'?>>Закрыто</option>									</select> 
								</p>
								<p><input class="text-input small-input" type="text" name="country" value="{{$service->country->name}}" /> <span class="input-notification <?if(!empty($service->country)) {echo 'success';} else {echo 'attention'; } ?>">Страна</span></p>
								<p><input class="text-input small-input" type="text" name="city" value="{{$service->city}}" /> <span class="input-notification   <?if(!empty($service->city)) {echo 'success';} else {echo 'attention'; } ?>     ">Город</span></p>
								<p><input class="text-input small-input" type="text" name="cena" value="{{$service->price}}" /> <span class="input-notification <?if(!empty($service->price)) {echo 'success';} else {echo 'attention'; } ?>">Цена</span></p>
								<p><input class="text-input small-input" type="text" name="srok"       
								<?if($service->srok==0) echo 'value="     1 неделя"' ?> 
								<?if($service->srok==1) echo 'value="     2 неделя"' ?> 
								<?if($service->srok==2) echo 'value="     1  месяц"' ?> 
                           /> <span class="input-notification <?if(!empty($service->srok)) {echo 'success';} else {echo 'attention'; } ?>">Срок действия объявления</span></p>
								<p><input class="text-input small-input" type="text" name="tel" value="{{$service->phone}}" /> <span class="input-notification  <?if(!empty($service->phone)) {echo 'success';} else {echo 'attention'; } ?>">Телефон</span></p>
								<input type="hidden" name="id" value="{{$service->id}}" />
								<p><input class="button" type="submit" value="Сохранить" /></p>
							</fieldset>
							
							
							<p>&nbsp;</p>
							<h2>Прикрепленные файлы</h2>
							<h3>Фото:</h3>
							<img src="http://test.myldl.ru/images/uploads/b2fc52b7665c78a54e0234dd8ec34e22_thumb.jpg" style="padding:5px;" />							<p>&nbsp;</p>

							
							
							
							
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
					<a href="http://test.myldl.ru/">&#169; Copyright 2013 - {{date('Y')}} MyLDL</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->


 @push('js')

        
         @endpush

@endsection