	@extends('layouts.admin.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')

<div id="main-content"> <!-- Main Content Section with everything -->
			
			<!-- Page Head -->
			<h2>Редактирование дела - 84</h2>
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-content">
			   
					<form class="right" action="{{route('admin.adminpanel.delo.update')}}" method="post">
                                  @csrf
                                   @method('PUT')
							
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p><input class="text-input small-input" type="text" name="nazva" value="{{$delo->nazva}}" /> <span class="input-notification success">Название</span> <!-- Classes for input-notification: success, error, information, attention --></p>
								<p><label>Описание</label><textarea name="opisanie">{{$delo->opisanie}}</textarea></p>
								<p><label>Тип</label>
								   <input name="tip" type="radio" value="1" <?if($delo->tip==1)  echo "checked"  ?> > Индивидуальное&nbsp;&nbsp;&nbsp;
								   <input name="tip" type="radio" value="2" <?if($delo->tip==2) echo "checked"?> > Коллективное								
								</p><label>Вход в дело</label>
								<p><input name="vhod_v_delo" type="radio" value="1" <?if($delo->vhod_v_delo==1) echo "checked"?> checked> Открыто всем&nbsp;&nbsp;&nbsp;
								   <input name="vhod_v_delo" type="radio" value="2" <?if($delo->vhod_v_delo==2) echo "checked"?> > По запросу								
								</p>
								<p>
									<label>Статус</label>
									<select name="status" class="small-input">
										 	<option value="1"  <?if($delo->status==1) echo 'selected="selected"'?>>Открыто</option>
														<option value="0"  <?if($delo->status==0) echo 'selected="selected"'?>>Закрыто</option>									</select> 
								</p>
								<p><input class="text-input small-input" type="text" name="country" value="{{$delo->country->name}}" /> <span class="input-notification success">Страна</span></p>
								<p><input class="text-input small-input" type="text" name="city" value="{{$delo->city}}" /> <span class="input-notification success">Город</span></p>
								<p><input class="text-input small-input" type="text" name="bydzet" value="{{$delo->bydzet}}" /> <span class="input-notification success">Бюджет</span></p>
								<p><input class="text-input small-input" type="text" name="vremya" value="{{$delo->vremya}}" /> <span class="input-notification success">Затраченное время</span></p>
								<p><input class="text-input small-input" type="text" name="effekt" value="{{$delo->effekt}}" /> <span class="input-notification success">Эффект</span></p>
								<p><label>Для чего это делалось</label><textarea name="dlya_chego">{{$delo->dlya_chego}}</textarea></p>
								<p><input class="text-input small-input" type="text" name="blagodarnost" value="{{$delo->blagodarnost}}" /> <span class="input-notification success">Благодарность</span></p>
								<input type="hidden" name="id" value="{{$delo->id}}" />
								<p><input class="button" type="submit" value="Сохранить" /></p>
							</fieldset>
							
							
							<p>&nbsp;</p>
							<h2>Прикрепленные файлы</h2>
							<h3>Фото:</h3>
														<p>&nbsp;</p>
							<h3>Видео:</h3>
														
							
							
							
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