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
        <li><a href="/">Главная</a></li><li class="active">Поиск по сайту</li>    </ol>
</div>
<section class="article review">
    <h1>Поиск по сайту - {{$skey}}</h1>
    <div class="panel">
        <div class="panel-body">
           
       {!!$output!!}
        </section>
 

  @push('js')
        
         @endpush

@endsection