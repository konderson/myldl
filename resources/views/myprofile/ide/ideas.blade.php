@extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
<style>
 .green_btb{
     float: right;
    display: inline-block;
    cursor: pointer;
    padding: 18px 40px;
    background-color: #99ca3d;
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.1px;
    text-transform: uppercase;
    margin-bottom: 5px;
    border: 0px;
    text-decoration: none;
    transition: .3s;
}
</style>
          <main class="col-xs-12">
              
              
              <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li><a href="/profile/index">Профиль</a></li><li class="active">Мои мысли</li>    </ol>
</div>﻿
<!-- сортировка таблицы -->
<script src="{{asset('asset/front/js/jquery.dataTables.min.js')}}"></script>




<section>
    <div class="people-outside lenta-sobitii">
     @include('myprofile.left')
        <div class="right">
            <h1 class="title">Мои мысли</h1>
            <input class="green_btb" type="button" onclick="javascript:location.href='/profile/add_idea'" value="Добавить мысль">
			<div style="margin-top:15px;">
            @foreach($ideas as $idea)
            <div class="tables-block future table-affaires">
                <table id="example" class="table table-services table-2columns">
                    <tbody>
			                                <tr>
                            <td>{{$idea->title}}</td>
                            <td>
                                <a href="/profile/edit_idea/{{$idea->id}}">Редактировать</a> |
                                <a class="" href="/profile/delete/{{$idea->id}}">Удалить</a>
                            </td>
                        </tr>
			                            </tbody>
                </table>
            </div>
            @endforeach
			</div>
        </div>
    </div>
</section>       

                
                            


              
                  @push('js')
       
 @endpush
 @endsection