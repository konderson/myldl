     @extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')

<div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li><a href="/profile/index">Профиль</a></li><li class="active">Избранные Дела</li>    </ol>
</div>
<script type="text/javascript">
   $(document).ready(function() {
   $('#search').keyup(function(){
    var str=$('#search').val();
	$.ajax({
			type: "POST",
			url: "/profile/relation/search",
			data: {
				'str':str,
			},
			 headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
			dataType: "html",
			success: function(msg){
				alert(msg);
			}
		});
    });
    });
</script>

<section>
    <div class="people-outside lenta-sobitii">
        
        @include('myprofile.left')
        <div class="right">
            <h1 class="title">Мои связи</h1>

            <div class="advert-categories" style="flex-flow: column; margin-bottom: 10px;">
                <span style="margin-bottom: 10px;">
                    
                <input name="status" type="checkbox" value="online">
                <p style='border: 0px;'class="selected-p">В сети (<span>0</span>)</p>
                </span>
                <input id="search" type="search" class="form-control" placeholder="Поиск">
                <style>
                    #search {
                        width: 360px;
                        max-width: 100%;
                        margin-right: 1%;
                        padding: 10px;
                        border: 2px solid #99ca3d;
                        margin-bottom: 15px;
                    }
                </style>
            </div>
            
            <div class="people-frame">
	       @foreach($frends as $frend)
	            <div class="person">
	           <div class="person-photo">
                            <div class="avatar" style="background-image: url(/storage/avatar/{{$frend->userFrend->person->avatar}});"></div>
                             @if(!$frend->user->isOnline())
                            <span class="offline status" style="background-color: #ca3d3d;" title="Офлайн"></span>
                            @else
                            <span class="status" title="Онлайн"></span>
                            @endif
                        <span class="status" style="background-color: #ca3d3d;"></span>
                        <span class="close mem-close del-relation" r_id="{{$frend->id}}"></span>
                           </div>
                        <div>
                        <a href="/user/{{$frend->userFrend->id}}">{{$frend->userFrend->name}}</a>
                    </div>
                       </div>
                         @endforeach
        </div>
    </div>
       
  
</section>
 @push('js')
        
         @endpush

@endsection