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
					
					<h3>Услуги</h3>
		
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
			   
					<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->

						<table>
							
							<thead>
								<tr>
								<th><input class="check-all" type="checkbox" /></th>
								   <th>№</th>
								   <th>Название</th> 
								   <th>Создал</th>
								   <th>Цена</th>
								   <th>Срок</th>
								   <th>Дата созд.</th>
								   <th>Дата оконч.</th>
								   <th>Статус</th>
								   <th>Уд.</th>
								</tr>
							</thead>
                       @isset($services)
							<tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
											<a class="button" href="#">Удалить выбранные</a>
										</div>
										
										<div class="pagination" style="margin-left: 60px; display: inline-table;">
											{{ $services->links('admin.paginate') }}
								     	</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>

							<tbody>

                      @foreach($services as $service)
								<tr>
									<td><input type="checkbox" class="checkboxes" name="{{$service->id}}" /></td>
									<td>1</td>
									<td><a href="/admin/service/edit/{{$service->id}}">{{$service->title}}</a></td>
									<td><a href="/admim/user/edit/{{$service->user->id}}">{{$service->user->name}}</a></td>
									<td>{{$service->price}}</td>
									<td>{{$service->srok}}</td>
									<td>{{$service->created_at}}</td>
									<td>{{$service->created_at->addDays(7)}}</td>
									@if($service->status==1)
									<td><img src="{{asset('asset/admin/resources/images/icons/tick_circle.png')}}" title="Открыто" /></td>
									@else
										<td><img src="{{asset('asset/admin/resources/images/icons/cross_circle.png')}}" title="Открыто" /></td>
										@endif
									<td style="vertical-align: middle;">
										<!-- Icons -->
										 <a href="/admin/services/delete/{{$service->id}}" title="Удалить"><img src="{{asset('asset/admin/resources/images/icons/cross.png')}}" alt="Delete" /></a>
									</td>
								</tr>
								@endforeach	
							</tbody>
							@endisset
							
							@empty($services)
								<tbody>
								    <tr>
								        <p>Нет записей</p>
								    </tr>
								    </tbody>
							@endempty
						</table>
						
					</div> <!-- End #tab1 -->
					
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			

			<div class="clear"></div>
			
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