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
					
					<h3>Настройки   «Лента событий»   профиля </h3>
				
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
				
				<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->
					<!-- ----------- BEGIN >>> Таблица Комментариев ----------- -->

						<form action="/admin/event_ribbon_profile/update" method="post">
						{{ csrf_field() }}
                         @method('PUT')
						<input type="hidden" name="e_id" value="{{$event->id}}">
						

						<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

							
							
							<p>
								<select name="events_type" class="medium-input">
								
								@foreach($types as $type)
								<option value="{{$type->id}}" <?php if($event->type_id==$type->id)  echo("SELECTED"); ?> >{{$type->name}}  </option>
								@endforeach
								</select>
								<span class="input-notification information">Тип события</span>
							</p>
							<p>
							<textarea name="title"> {!!$event->title!!}</textarea>
								<span class="input-notification information">Загаловок</span>
							</p><br />
							<p>
								<input class="button" type="submit" value="Сохранить" />
								<input class="button" id="no-submit-button" type="button" value="Отменить" style="margin-left: 10px;" />
								<script>$('#no-submit-button').click(function(){window.location.href = '/admin/event_ribbon_profile';});</script>
							</p>

						</fieldset>

						<div class="clear"></div><!-- End .clear -->

					</form>

						
						
						
					</div> <!-- End #tab1 -->
				
			
				
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			

			<div class="clear"></div>
			
	

			<div id="footer">
				<small>
					<a href="/">&#169; Copyright 2013 -{{date("Y")}} MyLDL</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
        
  @push('js')

        
         @endpush

@endsection