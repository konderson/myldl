
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
					
					<h3>Дела</h3>
		
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
								   <th>Тип</th>
								   <th>Вход в дело</th>
								   <th>Статус</th>
								   <th>Уд.</th>
								</tr>
							</thead>

							<tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
											<a class="button" href="#">Удалить выбранные</a>
										</div>
										
										<div class="pagination" style="margin-left: 60px; display: inline-table;">
										  {{ $delas->links('admin.paginate') }}
										</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>

							<tbody>
                      
                      @foreach($delas as $delo)

								<tr>
									<td><input type="checkbox" class="checkboxes" name="{{$delo->id}}" /></td>
									<td>{{$delo->id}}</td>
									<td><a href="/admin/delo/edit/{{$delo->id}}">{{$delo->nazva}}</a></td>
									<td><a href="/admin/user/edit/{{$delo->userOne['id']}}">{{$delo->userOne['name']}}</a></td>
									<td>
									@if($delo->vhod_v_delo==1)
										Индивидуальное
									@endif
									@if($delo->vhod_v_delo==2)
										Коллективное
									@endif
								</td>
									<td>
									    @if($delo->status==0)
										Открыто всем
									@endif
									@if($delo->status==1)
									Закрыто
									@endif
									   </td>
									   <td>
									       	    @if($delo->status==0)
									       <img src="{{asset('asset/admin/resources/images/icons/tick_circle.png')}}" title="Открыто" />
									       @else
									       <img src="{{asset('asset/admin/resources/images/icons/exclamation.png')}}" title="Открыто" />
									       @endif
									       </td>
									<td style="vertical-align: middle;">
										<!-- Icons -->
										 <a href="/admin/delo/delete/{{$delo->id}}"  onclick="myFunction()" title="Удалить"><img src="http://test.myldl.ru/application/views/admin/resources/images/icons/cross.png" alt="Delete" /></a>
									</td>
								</tr>
								@endforeach
							</tbody>
							
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
					<a href="/">&#169; Copyright 2013 - {{date('Y')}} MyLDL</a> | <a href="#">Top</a>
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