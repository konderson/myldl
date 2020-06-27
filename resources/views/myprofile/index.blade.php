         @extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
          <main class="col-xs-12">
        

    <script>
    $( document ).ready(function() {
        var count=$('#counter').text();
    $('#more_all').click(function(){
        count++;
        $('#counter').empty();
         $.ajax(

        {

            url: '/profile/ajax_lenta?page=' +count ,

            type: "get",

            datatype: "html"

        }).done(function(data){

            //$("#datapost").html(data);
             $('.table tbody').append(data);

            location.hash = count;
            
        

        }).fail(function(jqXHR, ajaxOptions, thrownError){

              alert('No response from server');

        });
      
    });
   });
   </script>

  <script>
    $(document).on('click', '.filter-list span', function(e){
          e.preventDefault();
          filter = $(this).parent().attr('data-filter');
          var url='';
          $('.layer').html("");
          if(filter==='all'){
              url='/profile/ajax_lenta';
          }
          
          
    });
    </script>


       
        
<div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li class="active">Профиль</li>    </ol>
</div><script src="{{asset('asset/front/js/profile/index.js')}}"></script>
<style>
    .selected{
        font-weight:600;
    }
</style>

<section>
    <div class="people-outside lenta-sobitii">
	    
    @include('myprofile.left')
       <div class="right">
            <h1 class="title">Лента событий</h1>
            <div class="lenta-options subtab-menu filter-list">
                <label data-filter="all" class="checked"><span>Все</span></label>
                <label data-filter="lync"><span>Мои связи</span></label>
                <label data-filter="business"><span>Мои дела</span></label>
                <label data-filter="faworites"><span>Избранные дела</span></label>
                <label data-filter="notshow"><span>Непрочитанные </span></label>
            </div>
            <div class="layer">                <div class="lenta-table">
                    <table class="table">
                        <tbody><tr>
                            <th>Фото:</th>
                            <th>Название события:</th>
                            <th>Раздел:</th>
                            <th>Дата:</th>
                        </tr>
                        @foreach($events as $event)
                            <tr>
                            <td><img src="{{asset('storage/avatar/'.$event->user->person->avatar)}}" style="max-width: 100px;"></td>
                            <td>{!!$event->title!!}</td>
                            <td><span class="table-span-bold">Мои связи</span></td>
                            <td><span class="table-span-bold">{{$event->created_at}}</span></td>
                        </tr>
                        @endforeach
                         <p style="display:none" id="counter">1</p>
                </tbody> 
                </table><button id="more_all" style="background-color: #89bc28;color:#fff;border:none;padding:5px;">Показать еще</button>
               
                </div>

	            	            </div>
    </div>
</section>        
 @push('js')
        
         @endpush

@endsection