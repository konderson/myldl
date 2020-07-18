 @extends('layouts.admin.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
 @section('content')
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			
			
			<!-- Page Head -->
			<h2>Редактирование пользователя - LDL</h2>
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-content">
			   
					  <form class="right" action="{{route('admin.adminpanel.profile.update')}}" method="post">
                                  @csrf
                                   @method('PUT')
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p><input class="text-input small-input" type="text" name="name" value="{{$user->name}}" /> <span class="input-notification success">Имя</span> <!-- Classes for input-notification: success, error, information, attention --></p>
								<p><input class="text-input small-input" type="text" name="pass" value="{{$user->password}}" /> <span class="input-notification success">Пароль</span></p>
								<p><input name="chel_org" type="radio" value="1"   <?php if($user->person->chel_org==1)echo("checked") ?>> Человек&nbsp;&nbsp;&nbsp;
								   <input name="chel_org" type="radio" value="2"<?php if($user->person->chel_org==2)echo("checked") ?> > Организация								
								</p>
								<p><input name="pol" type="radio" value="1" <?php if($user->person->pol==1)echo("checked") ?>> Муж.&nbsp;&nbsp;&nbsp;
								   <input name="pol" type="radio" value="2" <?php if($user->person->pol==2)echo("checked") ?>> Жен.								
								</p>
								<p><input class="text-input small-input" type="text" name="email" value="{{$user->email}}" /> <span class="input-notification success">Емейл</span></p>
								<p><input class="text-input small-input" type="text" name="birthday" value="{{$user->person->birthday}}" /> <span class="input-notification  <? if(!empty($user->person->birthday)){echo'success';}else{echo 'attention';}?>">Дата рождения</span></p>
								<p><input class="text-input small-input" type="text" name="city" value="{{$user->person->city}}" /> <span class="input-notification  <? if(!empty($user->person->city)){echo'success';}else{echo 'attention';}?>">Город</span></p>
								<p><label>Статус</label>
								   <input class="text-input medium-input" type="text" name="status_str" value="{{$user->person->status_str}}" /> <span class="input-notification information"></span>
								</p>								
								<p><label>О себе/об организации</label><textarea name="about">{{$user->person->about}}</textarea></p>
								<p><input class="text-input small-input" type="text" name="skype" value="{{$user->person->skype}}" /> <span class="input-notification  <? if(!empty($user->person->skype)){echo'success';}else{echo 'attention';}?>">Skype/ICQ</span></p>
								<p><input class="text-input small-input" type="text" name="site" value="{{$user->person->site}}" /> <span class="input-notification  <? if(!empty($user->person->site)){echo'success';}else{echo 'attention';}?>">Сайт</span></p>
								<p><input class="text-input small-input"  type="text" <?php if(!empty($user->person->dolzhnost)){echo'success';}else{echo 'attention';}?> name="dolzhnost" value="{{$user->person->dolznost}}" /> <span class="input-notification attention">Должность</span></p>
								<p><input class="text-input small-input" type="text" name="dohod" value="{{$user->person->dohod}}" /> <span class="input-notification   <? if(!empty($user->person->dohod)){echo'success';}else{echo 'attention';}?>">Доход в месяц</span></p>
								<p><label>Увлечения</label><textarea name="hobbi">{{$user->person->hobbi}}</textarea></p>
								<p>
									<label>Активность</label>
									<select name="active" class="small-input">
										 	<option value="1" <?php if($user->person->active==0)echo 'selected="selected"'?>>Не подтвержден</option>
														<option value="1" <?php if($user->person->active==1)echo 'selected="selected"'?> >Активирован</option>
														<option value="2" <?php if($user->person->active==2)echo 'selected="selected"'?>>Заблокирован</option>	 
								                         <option value="3" <?php if($user->person->active==3)echo 'selected="selected"'?> >Заблокирован пользовател</option>    
														 <option value="4" <?php if($user->person->active==4)echo 'selected="selected"'?> >Удалена</option>
														 </select>
								</p>
								<input type="hidden" name="id" value="{{$user->id}}" />
								<p><input class="button" type="submit" value="Сохранить" /></p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			

			    
			
				<div id="footer">
				<small>
					<a href="/">&#169; Copyright 2013 - {{date("Y")}} MyLDL</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
			</div>
			 @push('js')
        
         @endpush

@endsection