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
        <li><a href="/">Главная</a></li><li class="active">Авторизоваться</li>    </ol>
</div><style>
    span.error p{ color: #FF0000 !important; font-size: 10px!important; }
    section.article{border:none;}
</style>
<div class="col-lg-9 col-lg-offset-0 col-md-8 col-sm-12">
    <div class="content-wrap">
        <section class="article review">
            <h1>  Ошибка авторизации</h1>
            <div class="panel">
                <div class="panel-body">
                   <p>
                    Не удалось войти на сайт, возможные причины:<br />1. Неверно указан логин или пароль<br />2. Вы не активировали аккаунт         </p>
                </div>
            </div>
        </section>
    </div>
</div>


  @push('js')
        
         @endpush

@endsection