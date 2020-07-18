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

						<table>

							<thead>
								<tr>
								   <th>№</th>
								   <th>Загаловок</th>
								   <th>Тип события</th>
								   <th>Действие</th>
								</tr>
							</thead>

							<tbody>
								@foreach($events as $event)
								<tr>
									<td>{{$event->id}}</td>
									<td>{{$event->title}}</td>
									<td><strong>{{$event->typeEvent->name}}</strong></td>
									<td style="vertical-align: middle;">
										<!-- Icons -->
										<a href="/admin/event_ribbon_profile_set/{{$event->id}}" title="Редактировать" onclick="return confirm('Перейти к редактированию события ?');"><img src="{{asset('asset/admin/resources/images/icons/pencil.png')}}" alt="Edit" /></a>&nbsp;&nbsp;&nbsp;
										<a href="/admin/event_ribbon_profile_del/{{$event->id}}" title="Удалить" onclick="return confirm('Удалить событие  ?');"><img src="{{asset('asset/admin/resources/images/icons/cross.png')}}" alt="Delete" /></a>
									</td>
								</tr>
								@endforeach
															</tbody>

						</table>

						<tfoot id="fbody">

								<tr>
									<td colspan="6" style="text-align: center;">
										<div class="pagination">
										    {{ $events->links('admin.paginate') }}
										    
										</div>
										<div class="clear"></div>
									</td>
								</tr>

							</tfoot>
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