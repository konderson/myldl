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
								   <th>№</th>
								   <th>Дата</th>
								   <th>Поступила на дело</th>
								   <th>От</th>
								   <th>Действие</th>
								</tr>
								
							</thead>

							<tbody id="data">

                            @foreach($appeails as $appeail)

								<tr>
									<td>{{$appeail->id}}</td>
									<td>{{ Carbon\Carbon::parse($appeail->created_at)->format('d.m.Y') }}</td>
									<td><a href="/admin/delo/edit/{{$appeail->delo->id}}">{{$appeail->delo->nazva}}</a></td>
									<td><a href="/admin/user/edit/{{$appeail->userFrom->id}}">{{$appeail->userFrom->name}}</a></td>
									<td>
										
										<a href="/admin/appeil/show/{{$appeail->id}}" title="Редактировать"><img src="{{asset('asset/admin/resources/images/icons/pencil.png')}}" alt="Edit" /></a>&nbsp;&nbsp;&nbsp;
						
									</td>
								</tr>
							@endforeach
								
							</tbody>

							<tfoot>

								<tr>
									<td colspan="6" style="text-align: center;">
										<div class="pagination">
										    
										    
										</div>
										<div class="clear"></div>
									</td>
								</tr>

							</tfoot>

						</table>
						
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