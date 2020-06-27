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
        <li><a href="/">Главная</a></li><li><a href="/profile/index">Профиль</a></li><li class="active">Взаимопомощь</li>    </ol>
</div>﻿
<!-- сортировка таблицы -->
<script src="{{asset('asset/front/js/jquery.dataTables.min.js')}}"></script>


<script type="text/javascript">
    $(document).ready(function () {

        typeId = '?type=1';

        // $(document).ready(function () {
        //     $('#example').dataTable({
        //         "bFilter": false,
        //         "bPaginate": false,
        //         "bInfo": false,
        //         //"order": [[ 3, "desc" ]]
        //         "language": {emptyTable: " "}
        //     });
        // });
        //
        // $(document).ready(function () {
        //     $('#example1').dataTable({
        //         "bFilter": false,
        //         "bPaginate": false,
        //         "bInfo": false,
        //         //"order": [[ 3, "desc" ]]
        //         "language": {emptyTable: " "}
        //     });
        // });

        // при клике "Хочу помочь"
        $('#main_table').click(function (e) {
            typeId = '?type=1';
            e.preventDefault();
            $('.box-table1').show();
            $('.box-table2, .box-table3').hide();
            $(this).addClass('selected-p');
            $('#arhive_table, #people_table').removeClass('selected-p');
            return false;
        });

        // при клике "Нужна помощь"
        $('#arhive_table').click(function (e) {
            typeId = '?type=2';
            e.preventDefault();
            $('.box-table2').show();
            $('.box-table1, .box-table3').hide();
            $(this).addClass('selected-p');
            $('#main_table, #people_table').removeClass('selected-p');
            return false;
        });

        // при клике "Ищу человека"
        $('#people_table').click(function (e) {
            typeId = '?type=3';
            e.preventDefault();
            $('.box-table3').show();
            $('.box-table1, .box-table2').hide();
            $(this).addClass('selected-p');
            $('#main_table, #arhive_table').removeClass('selected-p');
            return false;
        });

        // удалить poisk
        $('.del_poiski').click(function () {
            if (confirm("Вы действительно хотите удалить взаимопомощь «" + $(this).attr("poiski_name") + "»?")) {
                $(this).parents('tr').remove();
                $.get("/profile/del_vzaimopomosh/" + $(this).attr("poiski_id"));
                coun_vzaimopomosh = parseInt($('#coun_vzaimopomosh').text());
                $('#coun_vzaimopomosh').text(coun_vzaimopomosh - 1);
                countPoiski = parseInt($('#poisk_counter').text());
                $('#poisk_counter').text(countPoiski - 1);
            }
            return false;
        });

        // удалить находку
        $('.del_naxodki').click(function () {
            if (confirm("Вы действительно хотите удалить взаимопомощь «" + $(this).attr("poiski_name") + "»?")) {
                $(this).parents('tr').remove();
                $.get("/del_vzaimopomosh/" + $(this).attr("naxodki_id"));
                coun_vzaimopomosh = parseInt($('#coun_vzaimopomosh').text());
                $('#coun_vzaimopomosh').text(coun_vzaimopomosh - 1);

                countNaxodki = parseInt($('#nahodki_counter').text());
                $('#nahodki_counter').text(countNaxodki - 1);
            }
            return false;
        });

    });
</script>

<section>
    <div class="people-outside lenta-sobitii">
     @include('myprofile.left')
        <div class="right">
            <h1 class="title" style="width: 100%;">Взаимопомощь</h1>
            <a href="/profile/add_vzaimopomosh" class="add-btn">Добавить</a>

            <div class="advert-categories">
                <p class="selected-p" id="main_table"><span class="spaninspan">Хочу помочь (<span id="poisk_counter">{{$count_need}}</span>)</span></p>
                <p id="arhive_table"><span class="spaninspan">Нужна помощь (<span id="nahodki_counter">{{$coun_whelp}}</span>)</span></p>
                <p id="people_table"><span class="spaninspan">Ищу человека (<span id="nahodki_counter">{{$coun_search}}</span>)</span></p>
            </div>

            <div class="lenta-table">
                <div class="box-table1">
                    <table>
                        <tr>
                            <th>Фото:</th>
                            <th>Название:</th>
                            <th>Статус:</th>
                            <th></th>
                            <th></th>
                        </tr>
                                            @foreach($helps as $help)
                                            @if($help->type==1)
                                            
                                            
                                            <tr>
                                    <td><span><img src="{{asset('storage/help/'.$help->images)}}"></span></td>
                                    <td><a href="/searche/{{$help->id}}">{{$help->title}}</a></td>
                                    <td><span class="table-span-opened">
                                      @if($help->status==1)
                                      Действует
                                      @else
                                      Архив
                                      @endif
                                        
                                    </span></td>
                                    <td><a href="/profile/edit/{{$help->id}}"><img src="{{asset('asset/front/images/edit.png')}}"></a></td>
                                    <td><span class="del_poiski" poiski_name="{{$help->title}}" poiski_id="{{$help->id}}"><img src="{{asset('asset/front/images/close.png')}}"></span></td>
                                </tr>
                                          @endif  
                                            @endforeach
                                            
                                            
                                    
                
                                                                                                                            </table>
                </div>
                <div class="tables-block box-table2" style="display:none">
                    <table class="table table-2columns" id="example1">
                        <thead  style="border-bottom: 1px solid #f5f6f7;">
                        <tr>
                            <th>Фото:</th>
                            <th>Название:</th>
                            <th>Статус:</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
			            				            			            				            			            				            			            				            					  
			            	 @foreach($helps as $help)
                                            @if($help->type==2)
                                            
                                            
                                            <tr>
                                    <td><span><img src="{{asset('storage/help/'.$help->images)}}"></span></td>
                                    <td><a href="/searche/{{$help->id}}">{{$help->title}}</a></td>
                                    <td><span class="table-span-opened">
                                      @if($help->status==1)
                                      Действует
                                      @else
                                      Архив
                                      @endif
                                        
                                    </span></td>
                                    <td><a href="/profile/edit/{{$help->id}}"><img src="{{asset('asset/front/images/edit.png')}}"></a></td>
                                    <td><span class="del_poiski" poiski_name="{{$help->title}}" poiski_id="{{$help->id}}"><img src="{{asset('asset/front/images/close.png')}}"></span></td>
                                </tr>
                                          @endif  
                                            @endforeach			            			            				            			            				            			            				            					  
				  </tbody>
                    </table>
                </div>
                <div class="tables-block box-table3" style="display:none">
                    <div class="table-box">

                    </div>
                    <table class="table table-2columns" id="example1">
                        <thead  style="border-bottom: 1px solid #f5f6f7;">
                        <tr>
                            <th>Фото:</th>
                            <th>Название:</th>
                            <th>Статус:</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                             @foreach($helps as $help)
                                            @if($help->type==3)
                                            
                                            
                                            <tr>
                                    <td><span><img src="{{asset('storage/help/'.$help->images)}}"></span></td>
                                    <td><a href="/searche/{{$help->id}}">{{$help->title}}</a></td>
                                    <td><span class="table-span-opened">
                                      @if($help->status==1)
                                      Действует
                                      @else
                                      Архив
                                      @endif
                                        
                                    </span></td>
                                    <td><a href="/searche/{{$help->id}}"><img src="{{asset('asset/front/images/edit.png')}}"></a></td>
                                    <td><span class="del_poiski" poiski_name="{{$help->title}}" poiski_id="{{$help->id}}"><img src="{{asset('asset/front/images/close.png')}}"></span></td>
                                </tr>
                                          @endif  
                                            @endforeach		
                            
				          </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>       

                
                            


              
                  @push('js')
       
 @endpush
 @endsection