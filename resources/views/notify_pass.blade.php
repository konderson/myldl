@extends('layouts.frontend.app')
@section('title','Главная Помощь')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
  <main class="col-xs-12">
<div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>    </ol>
</div><style>
    span.error p{ color: #FF0000 !important; font-size: 10px!important; }
    section.article{border:none;}
</style>
<div class="col-lg-9 col-lg-offset-0 col-md-8 col-sm-12">
    <div class="content-wrap">
        <section class="article review">
            <h1> Просим прощение за неудобство! Сайт перешел на новую платформу</h1>
            <div class="panel">
                <div class="panel-body">
                   <p>
                       На вашу почту была отправлена ссылка для смены старого пароля.
                       </br>
                        Перейдите по ссылки из письма и измените пароль	.				   
					</p>
                </div>
            </div>
        </section>
    </div>
</div>


  @push('js')
        
         @endpush

@endsection