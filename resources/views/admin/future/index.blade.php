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
					
					<h3>Будущие дела</h3>
		
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
								   <th>Планируемая дата</th>
								   <th>Создал</th>
								   <th>Дата</th>
								   <th>Уд.</th>
								</tr>
							</thead>

							<tbody>
								@foreach($futures as $future)
								<tr>
									<td><input type="checkbox" class="checkboxes" name="{{$future->id}}" /></td>
									<td>{{$future->id}}</td>
									<td><a href="/admin/future/edit/{{$future->id}}">{{$future->title}}</a></td>
									<td>{{$future->f_date}}</td>
									<td><a href="/admin/user/edit/{{$future->user->id}}">{{$future->user->name}}</a></td>
									<td>{{ Carbon\Carbon::parse($future->created_at)->format('d.m.Y') }}</td>
									<td style="vertical-align: middle;">
										<!-- Icons -->
										 <a href="/admin/future/delete/{{$future->id}}"   onclick="myFunction()"  title="Удалить"><img src="{{asset('asset/admin/resources/images/icons/cross.png')}}" alt="Delete" /></a>
									</td>
								</tr>
								@endforeach						
								</tbody>
							
							<tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
											<a class="button" href="#">Удалить выбранные</a>
										</div>
										
										<div class="pagination" style="margin-left: 60px; display: inline-table;">
																					</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>

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
		<script>
function myFunction(e)
{
 
if (confirm("Удалить дело?"))
  {
  
 
  }
else
  {
  
  var evt = e ? e : window.event;
    //abort();

    (evt.preventDefault) ? evt.preventDefault() : evt.returnValue = false;

    return false;
  }
 
}
</script>

 @push('js')

        
         @endpush

@endsection