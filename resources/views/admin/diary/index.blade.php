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
					
					<h3>Дневник(<a href="/admin/diary/add">добавить</a>)</h3>
		
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
			   
					<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->

						<table>
							
							<thead>
								<tr>
								   <th>№</th>
								   <th>Название &nbsp;&nbsp;&nbsp;</th>
								   <th>Дата</th>
								   <th>Действие</th>
								</tr>
							</thead>
							
							<tbody>
							@foreach($diaries as $diary)
							<tr>
									<td>{{$diary->id}}</td>
									<td><a href="/admin/news/edit/{{$diary->id}}">{{$diary->name}}</a></td>
									<td>{{ Carbon\Carbon::parse($diary->created_at)->format('d.m.Y') }}</td>
									<td style="vertical-align: middle;">
										<!-- Icons -->
										 <a href="{{route('admin.adminpanel.diary.edit',$diary->id)}}" title="Редактировать"><img src="{{asset('asset/admin/resources/images/icons/pencil.png')}}" alt="Edit" /></a>&nbsp;&nbsp;&nbsp;
										 <a href="{{route('admin.adminpanel.diary.delete',$diary->id)}}"  onclick="myFunction()" title="Удалить"><img src="{{asset('asset/admin/resources/images/icons/cross.png')}}" alt="Delete" /></a>
									</td>
								</tr>
							@endforeach						
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4" style="text-align: center;">
										<div class="pagination">
										    {{ $diaries->links('admin.paginate') }}
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