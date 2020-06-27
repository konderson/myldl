
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title>Admin</title>
		
		<!--                       CSS                       -->
	   <meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Main Popup Plugin -->
		<link rel="stylesheet" href="{{asset('asset/admin/resources/css/ds_popup.css')}}" type="text/css" media="screen" />
		
		<!-- Main Bootstrap Plugin -->
		<link rel="stylesheet" href="{{asset('asset/admin/bootstrap/bootstrap/bootstrap.min.css')}}" type="text/css" media="screen" />
		
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="{{asset('asset/admin/resources/css/reset.css')}}" type="text/css" media="screen" />
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="{{asset('asset/admin/resources/css/style.css')}}" type="text/css" media="screen" />

		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="{{asset('asset/admin/resources/css/invalid.css')}}" type="text/css" media="screen" />
		
		<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
		
		<link rel="stylesheet" href="resources/css/blue.css" type="text/css" media="screen" />
		
		<link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />  
	 
		-->
		
		<!-- Internet Explorer Fixes Stylesheet -->
		
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
		<![endif]-->
		
		<!--                       Javascripts                       -->

		<!-- jQuery -->
		<script type="text/javascript" src="{{asset('asset/admin/resources/scripts/jquery-3.4.1.min.js')}}"></script>
		<!-- Нормальный человек, как только появишься здесь - подключи Jquery через Google CDN, спасибо.
		<script type="text/javascript" src="http://test.myldl.ru/application/views/admin/resources/scripts/jquery-1.3.2.min.js"></script>-->
		<!--<script type="text/javascript" src="http://test.myldl.ru/application/views/admin/resources/scripts/jquery-v1.11.1.js"></script>-->

		<!-- jQuery Cookie -->
    		<script type="text/javascript" src="{{asset('asset/admin/js/jquery.cookie.js?v=1.4.1')}}"></script>

		<!-- jQuery Configuration -->
		<script type="text/javascript" src="{{asset('asset/admin/resources/scripts/simpla.jquery.configuration.js')}}"></script>
		
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="{{asset('asset/admin/resources/scripts/facebox.js')}}"></script>
		<script type="text/javascript">
		 $(document).ready(function() {
			$.facebox.settings.closeImage = 'http://test.myldl.ru/application/views/admin/resources/images/closelabel.png';
			$.facebox.settings.loadingImage = 'http://test.myldl.ru/application/views/admin/resources/images/loading.gif';
			$('a[rel*=modal]').facebox(); // Applies modal window to any link with attribute rel="modal"
		 });
		</script>
		


		<!-- jQuery Bootstrap Plugin -->
		<!--<script type="text/javascript" src="http://test.myldl.ru/application/views/admin/bootstrap/bootstrap/bootstrap.min.js"></script>-->
		
		<!-- jQuery Popup Plugin -->
		<script type="text/javascript" src="http://test.myldl.ru/application/views/admin/resources/scripts/ds_popup.js"></script>
		
		<!-- Internet Explorer .png-fix -->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="/application/views/admin/resources/scripts/DD_belatedPNG_0.0.8a-min.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
				<script type="text/javascript" src="{{asset('asset/admin/resources/scripts/datepicker-ru.js')}}"></script>
			
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
		
	</head>
  
	<body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		@include('layouts.admin.sidebar')
		
			  @yield('content')	
	</div>
	
		@stack('js')
	</body>
  
</html>