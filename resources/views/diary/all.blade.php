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
        <li><a href="/">Главная</a></li><li style="color: #8e8e8e;">Дневник проекта</li>    </ol>
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

                <div class="advert-search-row">
                    <form class="search search-people" style="width: 100%;">
                        <input type="text" placeholder="поиск..." id="search_word"/>
                        <input type="submit" class="search-magnify" value="">
                    </form>
                </div>
	              @foreach($diaries as $diary)
				        <div class="advert-row news-row">
                    <div class="date"><span>{{ Carbon\Carbon::parse($diary->created_at)->format('d.m') }}</span></div>
                    <div class="advert-row-body news-row-body">
                        <a class="advert-row-body-title" href="/diary/item/{{$diary->id}}">{{$diary->name}}</a>
                        <p class="adv-info">{!!  strip_tags (mb_substr($diary->text, 0, 150))!!}....</p>
                    </div>
                    <div class="deal-views" style="margin-top: 0px; margin-left: 7%; margin-right: 0%;">
                        <img src="https://myldl.ru/static/images/like.png"/>
                        <span class="like_c">{{$diary->likeCount($diary->id)}}</span>
                        <img src="https://myldl.ru/static/images/dislike.png"/>
                        <span class="dislike_c">{{$diary->dislikeCount($diary->id)}}</span>
                        <span>Коментарии ({{$diary->getCount($diary->id)}})</span>
                    </div>
					</div>
			 @endforeach
					           
				<div class="advert-pages">
					    {{ $diaries->links('paginate') }}
					</div> 
				
                </div>
                
	         
        </div>

        <div class="right">
            <span class="title">Все новости</span>
            <div id="datetimepicker12"></div>
<script>
    $(function(){

        function formatDateToString(date){
            // 01, 02, 03, ... 29, 30, 31
            var dd = (date.getDate() < 10 ? '0' : '') + date.getDate();
            // 01, 02, 03, ... 10, 11, 12
            var MM = ((date.getMonth() + 1) < 10 ? '0' : '') + (date.getMonth() + 1);
            // 1970, 1971, ... 2015, 2016, ...
            var yyyy = date.getFullYear();

            // create the format you want
            return (yyyy + "-" +MM + "-" + dd);
        }

        $('#datetimepicker12').datetimepicker({
            inline: true,
            sideBySide: true,
            format: "L",
            locale: "ru"
        })
            .on('dp.change', function(e) {
                var date = new Date(e.date);

                $(".shorts-list").empty();
                $(".shorts-list").append('<p style="text-align:center;">' +
                    '<br><br>' +
                    '<img src="/application/views/front/images/ajax-loader.gif" /></p>');

                $('#search_word').val('');
                $('.datepicker .day.active').attr('data-date', $('.datepicker .day.active').text());

                $.ajax({
                    type: "POST",
                    url: "https://myldl.ru/diary/ajax_search_date_dnevnik",
                    data: {
                        search_date : formatDateToString(date),
                        'ci_csrf_token' : $.cookie('hash_cookie_id')
                    },
                    dataType: "html",
                    success: function(msg){
                        $(".advert-row.news-row").remove();
                        $(".advert-search-row").after(msg);
                        $(".advert-pages").remove();
                        $("#title_date").text(date[8]+date[9]+'-'+date[5]+''+date[6]+'-'+date[0]+date[1]+date[2]+date[3]);
                    }
                });
            })
            .on('dp.update', function(e) {
                $('.datepicker .day.active').attr('data-date', $('.datepicker .day.active').text());
            });
        $('.datepicker .day.active').attr('data-date', $('.datepicker .day.active').text());
        $('.datepicker').on('click', '.day.active', function () {
            setTimeout(function () {
                $('.datepicker .day.active').attr('data-date', $('.datepicker .day.active').text());
            },50);
        });
    })
</script>        </div>
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