@extends('layouts.admin.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
				<div id="main-content"> <!-- Main Content Section with everything -->
			
			
			
			<!-- Page Head -->
			<h2>Расмотреть жалобу</h2>
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-content">
			   
					  <form class="right" action="{{route('admin.adminpanel.appeal.status')}}" method="post">
                                  @csrf
                                 
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								@if($appeail->type==1)
							    <p><label>На дело </label><a href="/admin/delo/edit/{{$appeail->delo->id}}">{{$appeail->delo->nazva}}</a></p>
							     @endif
								 @if($appeail->type==2)
							    <p><label>На пользователя </label><a href="/admin/user/edit/{{$appeail->userTo->id}}">{{$appeail->userTo->name}}</a></p>
							     @endif
                                <p><label>От</label><a href="/admin/user/edit/{{$appeail->userFrom->id}}">{{$appeail->userFrom->name}}</a></p>								
								<p><label>Жалоба</label><textarea name="about">{{$appeail->text}}</textarea></p>
								
									<label>Активность</label>
									<select name="status" class="small-input">
										 	<option value="0" <?php if ($appeail->status==0)echo 'selected="selected"'?>>Не расмотрена</option>
														<option value="1" <?php if($appeail->status==1)echo 'selected="selected"'?>  >Расмотрена</option>
																						</select> 
								</p>
								<input type="hidden" name="id" value="{{$appeail->id}}" />
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