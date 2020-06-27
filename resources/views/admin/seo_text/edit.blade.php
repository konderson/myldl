	@extends('layouts.admin.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
<div id="main-content"> <!-- Main Content Section with everything -->
			
			<!-- Page Head -->
			<h2>Редактирование записи - {{$st->name}}</h2>
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-content">
			   
						
							<form class="right" action="{{route('admin.adminpanel.seo_text.update')}}" method="post">
                                  @csrf
                                   @method('PUT')
							
							
						
                    <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

                        <input class="text-input small-input" type="text" name="title" value="{{$st->title}}" style="margin-bottom: 10px"/>
                        <br />
						<input class="text-input small-input" type="text" name="keywords" value="{{$st->keyw}}" style="margin-bottom: 10px"/>
						<span class="input-notification information">Мета (keywords)</span>
						<input class="text-input small-input" type="text" name="description" value="{{$st->description}}"/>
						<span class="input-notification information">Мета (description)</span>
						<span class="input-notification information">Название</span>
                        <textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10">
                            {{$st->text}}
                        </textarea>
                        <input type="hidden" name="id" value="{{$st->id}}" />
                        <p><input class="button" type="submit" value="Сохранить" /></p>

                    </fieldset>

							
						</form>
						
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			

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
		
		<script type="text/javascript" src="{{asset('asset/front/js//jquery/ajaxupload.3.5.js')}}"></script>


<script type="text/javascript">

// Масив картинок
var my_mas1 = new Array();
// Видалення картинок
function remove_img(id, nazva){
	var el = document.getElementById('img_'+id);
	el.parentNode.removeChild(el);
	// шукаємо вибране значення в масиві, видаляємо його
	for(var i=0; i<my_mas1.length; i++) {
		if(my_mas1[i]==nazva) {	my_mas1.splice(i,1) }
		//alert(my_mas1[i]);
	}
	document.getElementById('str_images').value = my_mas1;
	$.get("http://test.myldl.ru/profile/ajax_del_img_delo/"+nazva);
}

// Загрузка картинок
$(function(){
	img=1;
	var btnUpload=$('#upload');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
		action: '/help/ajax_upload',
		name: 'userfile',
		data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
                                         
         },
		onSubmit: function(file, ext){
			 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
				// extension is not allowed 
				status.text('Поддерживаемые форматы JPG, PNG или GIF');
				return false;
			}
			status.text('Загружается...');
		},
		onComplete: function(file, response){
			//On completion clear the status
			status.text('');
			//Add uploaded file to list
			if(response==="error"){
				$('<li></li>').appendTo('#files').text('Файл не загружен '+file).addClass('error');				
			} else {
				// response - назва зменшеного файлу
				orig_name = response.replace("_thumb", "");	
				$('#current_image').empty();
				$("#files").append('<img class="thumb" src="/storage/help/'+response+'" alt="" />');
				$('#upload').hide();
				my_mas1.push(orig_name);
				document.getElementById('images').value = my_mas1;
				//img++;	
			}
		}
	});
	
	
	
	
	
});

</script>
 @push('js')

        
         @endpush

@endsection