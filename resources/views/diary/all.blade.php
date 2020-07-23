@extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')
<style>
/*--фиксированное позиционирование для IE6--*/
*html #fade {
    position: absolute;
}
*html .popup_block {
    position: absolute;
}


    .pagination li{
    list-style-type: none;
    float: left;
    margin-left: 10px;
}
.pagination li span {
    color: #000;
}

.active{
    display: inline-block;
    cursor: pointer;
    padding: 5px 10px;
    background-color: #99ca3d;
    color: #fff;
    font-weight: 700;
    letter-spacing: 0.1px;
    margin-right: 3px;
    text-decoration: none;
    text-transform: uppercase;
    margin-bottom: 5px;
}
.pagination li span{
    color:#fff;
}

.pagination li a {
    margin-left:-8px;
    color: #000;
    text-decoration: none;
}

</style>
@endpush
@section('content')
          <main class="col-xs-12">
              
              
    <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li class="active">Дневник проекта</li>    </ol>
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
                <h1 class="title">Дневник проекта</h1>
                <div class="advert-body">

					 <div style="clear: both"></div>           
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-1014859909801067"
     data-ad-slot="1433540716"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

					                        
					       @foreach($diaries as $diary)
					                        <div class="advert-row news-row">
                            <div class="date"><span>{{ Carbon\Carbon::parse($diary->created_at)->format('d.m.Y') }}</span></div>
                                <a href="/diary/item/{{$diary->id}}"  style="margin-right: 15px;" class="advert-row-body-title">{{$diary->name}}</a>
                            <div class="advert-row-body news-row-body">
                                <p class="adv-info">{!!  strip_tags (substr($diary->text, 0, 150))!!}....</p>
                            </div>
                        </div>
					                          @endforeach
					<div class="advert-pages">
					    {{ $diaries->links('paginate') }}
					</div> 
					</div>
            </div>
            
            <div class="right">
                <span class="title">Читаемые новости</span>
                <div class="advert-body">
                    
                    @foreach($ldiaries as $ldiary)
					                        <div class="article-info">
                            <div class="article-subtitle">
                                <div class="date"><span>{{ Carbon\Carbon::parse($ldiary->created_at)->format('d.m.Y') }}</span></div>
                                <a href="/diary/item/{{$ldiary->id}}">{{$ldiary->name}}</a>
                            </div>
                        </div>
					 @endforeach             
                        </div>
					                </div>
                   <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-1014859909801067",
          enable_page_level_ads: true
     });
</script>
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