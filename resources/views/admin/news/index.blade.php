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
					
					<h3>Новости (<a href="/admin/news/add">добавить</a>)</h3>
		
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
			   
					<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->

						<table>
							
							<thead>
								<tr>
								   <th>№</th>
								   <th>Название &nbsp;&nbsp;&nbsp;( Главные новости )</th>
								   <th>Дата</th>
								   <th>Флаги</th>
								   <th>Действие</th>
								</tr>
							</thead>
							
							<tbody>
							@foreach($fnews as $fn)
							<tr>
									<td>{{$fn->id}}</td>
									<td><a href="/admin/news/edit/{{$fn->id}}">{{$fn->name}}</a></td>
									<td>{{ Carbon\Carbon::parse($fn->created_at)->format('d.m.Y') }}</td>
									<td style="text-align: center;">
										<select news_id="{{$fn->id}}" name="flag" style="border: 1px solid #e7c200; border-radius: 4px; background: #ffe45c; padding: 1px 4px;">
										    
										    <option style="background: #e7c200;"value="{{$fn->flag}}" SELECTED>{{$fn->flag}}</option>
										    	<option value="0">0</option>
										     @for ($i = 0; $i< count($fnews); $i++)
										
											<option value="{{$i+1}}">{{$i+1}}</option>
											@endfor
											</select>
									</td>
									<td style="vertical-align: middle;">
										<!-- Icons -->
										 <a href="{{route('admin.adminpanel.news.edit',$fn->id)}}" title="Редактировать"><img src="{{asset('asset/admin/resources/images/icons/pencil.png')}}" alt="Edit" /></a>&nbsp;&nbsp;&nbsp;
										 <a href="{{route('admin.adminpanel.news.delete',$fn->id)}}"  onclick="myFunction()" title="Удалить"><img src="{{asset('asset/admin/resources/images/icons/cross.png')}}" alt="Delete" /></a>
									</td>
								</tr>
							@endforeach						
							</tbody>
							
						</table>
						
						<br><br>
						
						<table>
							
							<thead>
								<tr>
								   <th>№</th>
								   <th>Название &nbsp;&nbsp;&nbsp;( Остальные новости	)</th>
								   <th>Дата</th>
								   <th>Действие</th>
								</tr>
							</thead>
							
							<tbody>
								
							@foreach($news as $nw)
							<tr>
									<td>{{$nw->id}}</td>
									<td><a href="/admin/news/edit/{{$fn->id}}">{{$nw->name}}</a></td>
									<td>{{ Carbon\Carbon::parse($nw->created_at)->format('d.m.Y') }}</td>
									<td style="vertical-align: middle;">
										<!-- Icons -->
										<a href="{{route('admin.adminpanel.news.edit',$nw->id)}}" title="Редактировать"><img src="{{asset('asset/admin/resources/images/icons/pencil.png')}}" alt="Edit" /></a>&nbsp;&nbsp;&nbsp;
										 <a href="{{route('admin.adminpanel.news.delete',$nw->id)}}"  onclick="myFunction()" title="Удалить"><img src="{{asset('asset/admin/resources/images/icons/cross.png')}}" alt="Delete" /></a>
									</td>
								</tr>
							@endforeach	
							</tbody>
							
							<tfoot>
								<tr>
									<td colspan="4" style="text-align: center;">
										<div class="pagination">
										    {{ $news->links('admin.paginate') }}
									</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>

						</table>

<script >
$(document).ready(function(){
	
	// При изменении Флага
	$('select[name=flag]').change(function(){
		window.location.href = "{{route('admin.adminpanel.news.edit.flag')}}?newsID="+$(this).attr('news_id')+"&flag="+$(this).val();
	});

});
</script>
						
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
					<a href="http://test.myldl.ru/">&#169; Copyright 2013 - 2015 MyLDL</a> | <a href="#">Top</a>
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