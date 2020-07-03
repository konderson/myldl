 @extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
          <main class="col-xs-12">        
<div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li><a href="/profile/index">Профиль</a></li><li class="active">Добавить мысль</li>    </ol>
</div>
        <script src="{{asset('asset/front/js/profile/add_delo.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/front/js//jquery/ajaxupload.3.5.js')}}"></script>
<script src="{{asset('asset/admin/resources/scripts/tinymce/tinymce.min.js')}}"></script>
		<script>
tinymce.init({
    	selector:'.ckeditor', 
		language: 'ru_RU',
    plugins: 'image code',
    toolbar: 'undo redo | image code',
    
    // without images_upload_url set, Upload tab won't show up
    images_upload_url: '/admin/news/upload',
    
    // override default upload handler to simulate successful upload
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
      
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '/admin/news/upload');
      var token = '{{ csrf_token() }}';
           xhr.setRequestHeader("X-CSRF-Token", token);
        xhr.onload = function() {
            var json;
        
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
        
            json = JSON.parse(xhr.responseText);
        
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
        
            success(json.location);
        };
      
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
      
        xhr.send(formData);
    },
});
</script>
<!-- AjaxUpload -->

<!-- jQuery Masked Input Plugin -->



<script type="text/javascript">
    $(document).ready(function () {
      
                                });


</script>



<section>
    <div class="people-outside lenta-sobitii moya-anketa">
	    
@include('myprofile.left')

     <form class="right" action="/profile/idea/update" method="post" >
             @method('PUT')
             @csrf
           
            <div class="field-for-edit">
                <span class="edit-label">Тема</span>
                <input type="text" class="tfi" value="{{$idea->title}}" id="title" name="title"/>
            </div>
              
            <div class="field-for-edit">
                <span class="edit-label">Содержание</span>
                <textarea class="ckeditor" cols="80" id="editor2" name="content">{!!$idea->description!!}</textarea>
            </div>

            <div class="field-for-edit" style="margin-top: 25px;">
                <input type="hidden" name="id" value="{{$idea->id}}" />
                <button type="submit" class="btn btn-default tab-btn save">Сохранить</button>
                <button type="button" class="btn btn-default tab-btn cancel" onclick="javascript:location.href = '/profile/ideas'">Отменить</button>
            </div>
        </form>
    </div>
</section> 
    @push('js')
       
 @endpush
 
 
 
@endsection