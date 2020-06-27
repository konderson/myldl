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
        <li><a href="https://myldl.ru/">Главная</a></li><li class="active">Интервью</li>    </ol>
</div><script type="text/javascript">
    $(document).ready(function() {

        $("#search_word").on('submit', function(e){
            e.preventDefault();

            $(".advert-row").remove();
            $(".advert-search-row").after('<p style="text-align:center;" class="advert-search-row-load"><br><br><img src="https://myldl.ru/application/views/front/images/ajax-loader.gif" /></p>');
            $.ajax({
                type: "POST",
                url: "https://myldl.ru/main/ajax_search_interview",
                data: {
                    'search_word': $("#search_word input[type='text']").val(),
                    'ci_csrf_token' : $.cookie('hash_cookie_id')
                },
                dataType: "html",
                success: function(msg){
                    $(".advert-row, .advert-search-row-load").remove();
                    $(".advert-search-row").after(msg);
                }
            });
        });

    });
</script>


<section>
    <div class="advert">
        <div class="left">
            <h1 class="title">Интервью</h1>
            <div class="advert-body">
                <div class="advert-search-row">
                    <form class="search search-people" style="width: 100%;" id="search_word">
                        <input type="text" placeholder="поиск..."/>
                        <input type="submit" class="search-magnify" value="">
                    </form>
                </div>


             @foreach($ivs as $iv)
                	<div class="advert-row">
		<div class="date"><span>{{ Carbon\Carbon::parse($iv->created_at)->format('d.m.Y') }}</span></div>
			<a href="/interview/item/{{$iv->id}}" class="advert-row-body-title"  style="margin-left:20px;">{{$iv->name}}</a>
		<div class="image">
			<img src="{{asset('storage/help/'.$iv->image)}}"/>
		</div>
		<div class="advert-row-body">
			<p class="adv-info" style="font-size: 14px;"><p>{!! substr($iv->tex, 0, 150)!!}....</p>
		</div>

		                  <div class="deal-views">
	                    
<img src="{{asset('asset/front/images/like.png')}}" class="stat-item thumbs-up likebut" section_id="12" post_id="{{$iv->id}}"/>
<span id="like_c{{$iv->id}}">{{$iv->likeCount($iv->id)}}</span>
<img src="{{asset('asset/front/images/like.png')}}" class="stat-item thumbs-down dislikebut" section_id="12" post_id="{{$iv->id}}"/>
<span id="dislike_c{{$iv->id}}">{{$iv->dislikeCount($iv->id)}}</span>                        
                        <img src="{{asset('asset/front/images/comments.png')}}"/>
                        <span>{{$iv->getCount($iv->id)}}</span>
                    </div>
	</div>
	            @endforeach

	                        </div>
        </div>

      <div class="right">
            <span class="title">Популярные интервью</span>
            <div class="advert-body">
                
                @foreach($ivs as $ivp)
	                                <div class="article-info">
                        <div class="article-subtitle">
                            <div class="date"><span>{{ Carbon\Carbon::parse($ivp->created_at)->format('d.m.Y') }}</span></div>
                            <a href="/interview/item/{{$ivp->id}}">{{$ivp->name}}</a>
                        </div>
                    </div>
                    @endforeach
	                                
	                        </div>
        </div>
    </div>
</section>


             <script type="text/javascript">
    $(document).ready(function(){


          $('.likebut').click(function(){
         
      var delo_id=$(this).attr('post_id');
    $.ajax({
   url:"/like/store",
   method:"POST",
   
   data:{'post_id':delo_id,'type_id':'2'},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
       
       if(data.error){
        alert(data.error)
        
       }
       else{
              
           $('#like_c'+delo_id).html(data.count);
       }
    
   }
  
  });
  
          });

 $('.dislikebut').click(function(){
         
      var delo_id=$(this).attr('post_id');
    $.ajax({
   url:"/like/store/dislike",
   method:"POST",
   
   data:{'post_id':delo_id,'type_id':'2'},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   success:function(data)
   {
       
       if(data.error){
        alert(data.error)
        
       }
       else{
              
           $('#dislike_c'+delo_id).html(data.count);
       }
    
   }
  
  });
  
          });

});
       </script>



              
                       
                  @push('js')
       
 @endpush
 @endsection