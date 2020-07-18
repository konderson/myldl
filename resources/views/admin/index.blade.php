
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
					
					<h3>Пользователи</h3>
				
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
				
				<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->
					
						<table>
							
							<thead>
							<tr>
								<th><input type="edit" name="user[id]" placeholder="ID" value="" style="width:50px;" class="srchtxt"></th>
								<th><input type="edit" name="user[name]" placeholder="Имя" value="" style="width:160px;" class="srchtxt"></th>
								<th><input type="edit" name="user[email]" placeholder="Логин" value="" style="width:315px;" class="srchtxt"></th>
								<th><input type="edit" name="user[tel]" placeholder="Телефон" value="" style="width:110px;" class="srchtxt"></th>
								<th><input type="edit" name="user[date_reg]" placeholder="Дата регистрации" value="" style="width:140px;" class="srchtxt"></th>
								<th colspan="2"><select name="user[active]" style="width:100%" class="srchsel">
								<option value="">Все</option>
								<option value="5" >Не подтвержден<img src="{{asset('asset/admin/resources/images/icons/exclamation.png')}}" title="Не подтвержден" /></option>
								<option value="1" >Активный<img src="{{asset('asset/admin/resources/images/icons/tick_circle.png')}}" title="Активный" /></option>
								<option value="2" >Заблокирован<img src="{{asset('asset/admin/resources/images/icons/cross_sircle.png')}}" title="Заблокирован" /></option>
								<option value="3" >Заблокирован по собственному желанию<img src="{{asset('asset/admin/resources/images/icons/cross_sircle.png')}}" title="Заблокирован по собственному желанию"/></option>
								<option value="4" >Удален по собственному желанию<img src="{{asset('asset/admin/resources/images/icons/cross_sircle.png')}}" title="Заблокирован по собственному желанию"/></option>
								</select></th>
								<th></th>
							</tr>
								
								<tr>
								   <th>№</th>
								   <th>Имя</th>
								   <th>Логин</th>
								   <th>Телефон</th>
								   <th>Дата регистрации</th>
								   <th>Статус</th>
								   <th>Действие</th>
								</tr>
								
							</thead>

							<tbody id="data">
                                
                            @foreach($users as $user)

								<tr>
									<td>{{$user->id}}</td>
									<td>{{$user->name}}</td>
									<td><a href="/admin/user/edit/{{$user->id}}">{{$user->email}}</a></td>
									<td>{{$user->person->mob_tel}}</td>
									<td>{{ Carbon\Carbon::parse($user->created_at)->format('d.m.Y') }}</td>
									
									@if($user->person->active==3)
									<td><img src="{{asset('asset/admin/resources/images/icons/cross_circle.png')}}" title="Заблокирован по собственному желанию" />
									</td>
									@endif
									
										@if($user->person->active==2)
									<td><img src="{{asset('asset/admin/resources/images/icons/cross_circle.png')}}" title="Заблокирован" />
									</td>
									@endif
										@if($user->person->active==1)
									<td><img src="{{asset('asset/admin/resources/images/icons/tick_circle.png')}}" title="Активный" />
									</td>
									@endif
								
										@if($user->person->active==0)
									<td><img src="{{asset('asset/admin/resources/images/icons/exclamation.png')}}" title="Не подтвержден" />
									</td>
									@endif
									
									
									<td>
										<!-- Icons -->
										<a href="#messages_send" rel="modal" onclick="show_email_name('<?php echo $user->email?>', '<?php echo $user->name?>')" title="Отправить сообщение"><img src="{{asset('asset/admin/resources/images/icons/mail.png')}}" alt="Edit" /></a>&nbsp;&nbsp;&nbsp;
										<a href="user/edit/{{$user->id}}" title="Редактировать"><img src="{{asset('asset/admin/resources/images/icons/pencil.png')}}" alt="Edit" /></a>&nbsp;&nbsp;&nbsp;
										<a onclick="myFunction()" href="/admin/user/delete/{{$user->id}}" title="Удалить"><img src="{{asset('asset/admin/resources/images/icons/cross.png')}}" alt="Delete" /></a>
									</td>
								</tr>
							@endforeach
								
							</tbody>

							<tfoot id="fbody">

								<tr>
									<td colspan="6" style="text-align: center;">
										<div class="pagination">
										    {{ $users->links('admin.paginate') }}
										    
										</div>
										<div class="clear"></div>
									</td>
								</tr>

							</tfoot>

						</table>
						
					</div> <!-- End #tab1 -->
				
				  <script>
function myFunction(e)
{
 
if (confirm("Удалить этого пользователя?"))
  {
  
 
  }
else
  {
  alert("You pressed Cancel!");
  var evt = e ? e : window.event;
    abort();

    (evt.preventDefault) ? evt.preventDefault() : evt.returnValue = false;

    return false;
  }
 
}
</script>	
				<script type="text/javascript">
				$('.srchtxt').blur(function(){
				var link = '?';
				$('.srchtxt').each(function(index, elem){
					if($([elem]).val() != '')
					link += $(elem).attr('name') + '=' + $([elem]).val() + '&';
				});
				$('.srchsel').each(function(index, elem){
					if($(elem).find(':selected').val() != '')
					link += $(elem).attr('name') + '=' + $(elem).find(':selected').val() + '&';
				});
				console.log(link);
		
				$.ajax({url: 'user/filter'+link, success: function(result){
					//console.log("Res "+result);
				    $('#data').empty().html(result);
					 $('#fbody').empty().html('');
				//var resultHtmlBody = $(result).find('div.content-box-content').html();
				
				//$('div.content-box-content').html(resultHtmlBody);	
				}});
			});	
	
			$('.srchsel').change(function(){
				var link = '?';
				$('.srchtxt').each(function(index, elem){
					if($([elem]).val() != '')
					link += $(elem).attr('name') + '=' + $(elem).val() + '&';
				});
				$('.srchsel').each(function(index, elem){
					if($(elem).find(':selected').val() != '')
					link += $(elem).attr('name') + '=' + $(elem).find(':selected').val() + '&';
				});
				console.log(link);
		
				$.ajax({url: 'user/filter'+link, success: function(result){
				 $('#data').empty().html(result);	
				 $('#fbody').empty().html('');
				}});
	});	

				</script>	
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			

			<div class="clear"></div>
			
			

			<div id="footer">
				<small>
					<a href="/">&#169; Copyright 2013 - {{date('Y')}} MyLDL</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
        
  @push('js')

        
         @endpush

@endsection