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
        <li><a href="/">Главная</a></li><li class="active">Регистрация</li>    </ol>
</div><style>
    span.error p{ color: #FF0000 !important; font-size: 10px!important; }
    section.article{border:none;}
</style>
<div class="col-lg-9 col-lg-offset-0 col-md-8 col-sm-12">
    <div class="content-wrap">
        <section class="article review">
            <h1>  Регистрация пользователя</h1>
            <div class="panel">
                <div class="panel-body">
                   <p>
				       Поздравляем вас с успешной регистрацией на портале "Люди для людей".</br>
               Вам необходимо активировать вашу учётную запись. Данные для активации отправлены на Email. 
                    </p>
                </div>
            </div>
        </section>
    </div>
</div>


  @push('js')
        
         @endpush

@endsection