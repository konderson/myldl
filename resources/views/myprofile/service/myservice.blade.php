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
        <li><a href="/">Главная</a></li><li><a href="/profile/index">Профиль</a></li><li class="active">Мои Услуги</li>    </ol>
</div>

<!-- сортировка таблицы
<script src="https://myldl.ru/application/views/front/datatables/js/jquery.dataTables.min.js"></script>
<!-- сортировка таблицы -->


<script type="text/javascript">
$(document).ready(function() {
	
	// $('#example').dataTable();
	//$('#example').dataTable({
	//	"bFilter": false,
	//	"bPaginate": false,
	//	"bInfo": false,
	//	"ordering": false,
	//	"language":{ emptyTable:" " }
	//});

	$('#main_table').click(function(){
		$('#example').show();
		$('#example2, #example3').hide();
		$('.buttons').show();
		$(this).addClass('selected-p');
        $('#arhive_table, #all_table').removeClass('selected-p');
		return false;
	});

    $('#arhive_table').click(function(){
        $('#example2').show();
        $('#example, #example3').hide();
        $('.buttons').hide();
        $(this).addClass('selected-p');
        $('#main_table, #all_table').removeClass('selected-p');
        return false;
    });

    $('#all_table').click(function(){
        $('#example3').show();
        $('#example, #example2').hide();
        $('.buttons').show();
        $(this).addClass('selected-p');
        $('#main_table, #arhive_table').removeClass('selected-p');
        return false;
    });
	
	$('.del_usluga').click(function(){
		if (confirm("Вы действительно хотите удалить услугу «"+$(this).attr("usluga_name")+"»?")) {
			//document.location.href = "https://myldl.ru/profile/del_usluga/"+$(this).attr("usluga_id");
			$.get("https://myldl.ru/profile/del_usluga/"+$(this).attr("usluga_id"));
			uslug = parseInt($('#uslug').text());
			$('#uslug').text(uslug-1);
            uslug_deystv = parseInt($('#uslug_deystv').text());
            $('#uslug_deystv').text(uslug_deystv-1);
            uslug_all = parseInt($('#uslug_all').text());
            $('#uslug_all').text(uslug_all-1);
            $('a[usluga_id=' + $(this).attr("usluga_id") + ']').parents('tr').remove();
		}
		return false;
	});
	
	$('.del_usluga_arhiv').click(function(){
        if (confirm("Вы действительно хотите удалить услугу «"+$(this).attr("usluga_name")+"»?")) {
			$.get("/del_usluga/"+$(this).attr("usluga_id"));
			uslug = parseInt($('#uslug').text());
			$('#uslug').text(uslug-1);
			uslug_arh = parseInt($('#uslug_arh').text());
			$('#uslug_arh').text(uslug_arh-1);
            uslug_all = parseInt($('#uslug_all').text());
            $('#uslug_all').text(uslug_all-1);
            $('a[usluga_id=' + $(this).attr("usluga_id") + ']').parents('tr').remove();
		}
		return false;
	});

});
</script>

<section>
    <div class="people-outside lenta-sobitii">
	    
@include('myprofile.left')
        <div class="right">
            <h1 class="title">Мои объявления</h1>
            <a href="/profile/add_usluga" class="add-btn">Добавить</a>

            <div class="advert-categories">
                <p id="main_table" class="selected-p"><span class="spaninspan">Активные (<span id="uslug_deystv">{{count($services_a)}}</span>)</span></p>
                <p id="arhive_table"><span class="spaninspan">Неактивные (<span id="uslug_arh">{{count($services_nota)}}</span>)</span></p>
            </div>

            <div class="lenta-table">
                <table id="example">
                    <tr>
                        <th>Фото:</th>
                        <th>Название объявления:</th>
                        <th>Срок размещения (дней)</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                       @foreach($services_a as $serv)
                    
                    <tr>
                        
                          <td><span><img src="{{asset('storage/help/'.App\Service::getPhoto($serv->images))}}"/></span></td>
                            <td>{{$serv->title}}</td>
                            <td>{{$serv->srok}}</td>
                            <td><a href="/close_usluga/{{$serv->id}}">Закрыть</a></td>
                              <td><a href="/service/edit/{{$serv->id}}"><img class="edit-btn" src="{{asset('asset/front/images/edit.png')}}"/></a></td>
                            <td><a class="del_usluga_arhiv" href="#" usluga_name="{{$serv->name}}" usluga_id="{{$serv->id}}"><img class="close-btn" src="{{asset('asset/front/images/close.png')}}"/></a></td>
                        </tr>
                        @endforeach
                        
                    

		                            </table>
                <table id="example2" style="display:none">
                    <tr>
                        <th>Фото:</th>
                        <th>Название объявления:</th>
                        <th>Срок размещения (дней)</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($services_nota as $snot)
<tr>
 <td><span><img src="{{asset('storage/help/'.App\Service::getPhoto($snot->images))}}"/></span></td>
                            <td>{{$snot->title}}</td>
                            <td>
					            {{$snot->srok}}                        </td>
                            <td><a href="/open_usluga/{{$snot->id}}">Опубликовать</a></td>
                            <td><a href="/service/edit/{{$snot->id}}"><img class="edit-btn" src="{{asset('asset/front/images/edit.png')}}"/></a></td>
                            <td><a class="del_usluga_arhiv" href="#" usluga_name="{{$snot->name}}" usluga_id="{{$snot->id}}"><img class="close-btn" src="{{asset('asset/front/images/close.png')}}"/></a></td>
                        </tr>
                     @endforeach

		                            </table>
            </div>
        </div>
    </div>
</section>      
              
              
              
              

              
                  @push('js')
       
 @endpush
 @endsection