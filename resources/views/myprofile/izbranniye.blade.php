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
 	$('#choice-0, #choice-1, #choice-2, #choice-3, #choice-4').click(function(){
		$(".table-affaires > tbody").empty();
		$(".table-affaires > tbody").append('<tr><td colspan="5" style="text-align:center;"><img src="{{asset('asset/front/images/ajax-loader.gif')}}" /></td></tr>');
		$.ajax({
			type: "POST",
			url: "/profile/ajax_dela",
			data: {
				'choice_1': $('input[name=choice_1]:checked').val(),
				'choice_2': $('input[name=choice_2]:checked').val(),
				'choice_3': $('input[name=choice_3]:checked').val(),
				'choice_4': $('input[name=choice_4]:checked').val(),
				'choice_5': $('input[name=choice_5]:checked').val(),
			},
			 headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
			dataType: "html",
			success: function(msg){
				$(".table-affaires > tbody").empty();
				$(".table-affaires > tbody").append(msg);
			}
		});
	});
});
</script>

<section>
    <div class="people-outside lenta-sobitii">
        
        @include('myprofile.left')
        
        <div class="right">
            <h1 class="title">Избранные дела</h1>
            <a href="{{route('profile.adddelo')}}" class="add-btn">Добавить</a>
            <div class="lenta-options checkbox" style="margin-top: 15px;">
                <input name="choice_2" type="checkbox" id="choice-1" checked/><span>Открытые</span>
                <input name="choice_3" type="checkbox" id="choice-2" checked/><span>Закрытые</span>
                <input name="choice_4" type="checkbox" id="choice-3" checked/><span>Индивидуальные</span>
                <input name="choice_5" type="checkbox" id="choice-4" checked/><span>Коллективные</span>
            </div>

            <div class="lenta-table">
                <table class="table-affaires">
                    <thead>
                    <tr>
                        <th>Дата:</th>
                        <th>Название дела:</th>
                        <th>Город:</th>
                        <th>Участников:</th>
                        <th>Статус:</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
               @foreach($features as $delo)
       
       <tr>
                        <td><span class="table-span-bold">{{ Carbon\Carbon::parse($delo->delo->created_at)->format('d.m.Y') }}</span></td>
                        <td><a href="/delo/{{$delo->delo->id}}" title="Закрыто">{{$delo->delo->nazva}}</a></td>
                        <td><span class="table-span-bold">{{$delo->delo->city}}</span></td>
                        <td><span class="table-span-bold">1</span></td>
                        <td><span class="table-span-opened">{{$delo->delo->status==0?'Закрыто':'Открыто'}}</span></td>
                        <td>
                            <a href="/profile/delete/delo/izbranoe/{{$delo->id}}" onclick="return confirm('Вы действительно хотите удалить дело «{{$delo->delo->nazva}}»?')"><img src="{{asset('asset/front/images/close.png')}}"/></a>
                        </td>
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