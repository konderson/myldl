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
        <li><a href="/">Главная</a></li><li class="active">Акции</li>    </ol>
</div>

<section>
		<div class="stock">
			<h1 class="title">Акции</h1>
			<div class="left">
				<div class="left-img">
					<img src="{{asset('asset/front/images/container.png')}}"/>
				</div>
				<div class="error">
					<span class="err-title">Извините, данный раздел сейчас в разработке</span>
					<span class="err-desc">Попробуйте зайти сюда посже</span>
				</div>
			</div>

			<div class="right">
			</div>
		</div>
	</section>

  @push('js')
        
         @endpush

@endsection