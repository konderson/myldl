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
        <li><a href="/">Главная</a></li><li><a href="/profile/index">Профиль</a></li><li class="active">Будущие дела</li>    </ol>
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
			$.get("/profile/usluga/delete"+$(this).attr("usluga_id"));
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
            <h1 class="title">Мои будущие дела</h1>
            <a href="/profile/future_business/add" class="add-btn">Добавить</a>

            

            <div class="lenta-table">
                <table id="example">
                    <tr>
                       
                        <th>Название объявления:</th>
                        <th>Дата начала</th>
                        <th></th>
                        <th></th>
                    </tr>
                       @foreach($futures as $future)
                    
                    <tr>
                        
                         
                            <td><a href="/profile/future_business/index/{{$future->id}}">{{$future->title}} </a></td>
                            <td>{{$future->f_date}}</td>
                            
                              <td><a href="/profile/future_business/edit/{{$future->id}}"><img class="edit-btn" src="{{asset('asset/front/images/edit.png')}}"/></a></td>
                            <td><a class="del_usluga_arhiv" href="/profile/future_business/delete" usluga_name="{{$future->name}}" usluga_id="{{$future->id}}"><img class="close-btn" src="{{asset('asset/front/images/close.png')}}"/></a></td>
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