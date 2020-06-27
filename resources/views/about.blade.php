@extends('layouts.frontend.app')
@section('title','Главная Помощь')

@push('css')

@endpush
@section('content')

     <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li class="active">О проекте</li>     </ol>
</div><style>
    span.error p{ color: #FF0000 !important; font-size: 10px!important; }
    section.article{border:none;}
</style>
<div class="col-lg-9 col-lg-offset-0 col-md-8 col-sm-12">
    <div class="content-wrap">
        <section class="article review">
            <h1>О проекте</h1>
            <div class="panel">
                <div class="panel-body">
                    <p>Социальный ресурс, где собираются активные люди, неравнодушные к чужим страданиям. Люди выкладывают фото и видео совершенных благих дел, выкладывают свои идеи, как помочь нуждающимся людям, объединяются в группы для реализации совместных проектов.</p>
<p>Принцип-нужна помощь-зайди на ЛДЛ- должен уложиться в головах людей.</p>
<p>В разделе <a href="/users"><strong>Люди</strong></a> отображены все пользователи ресурса. В <a href="/affairs"><strong>Делах</strong></a> можно найти все дела пользователей и присоединиться к тем, какие вызывают симпатию. Если вы хотите получить бесплатно какую-то вещь или услугу, то обязательно посетите раздел <a href="/services"><strong>Объявления</strong></a>. Оставляйте отзывы в разделе <strong>Отзывы</strong> на других людей, предприятия и фирмы, если вы хотите поблагодарить их за что-то или указать на их недоработки.</p>
<p><a href="/diary"><strong>Дневник проекта</strong></a>- раздел, в котором можно ознакомиться с наиболее значимыми событиями в развитии <strong><a href="/">ЛДЛ</a></strong>.</p>
<p><a href="/interview"><strong>Интервью</strong></a>- раздел с интервью интересных людей, которые обозначили целью своей жизни помощь другим людям.</p>
<p><strong>Взаимопомощь</strong>- раздел для тех, кто <a href="/poiski"><strong>ищет помощь</strong></a> и тех, кто <a href="/hochu_pom"><strong>хочет помочь</strong></a>, а так же для оперативного <strong><a href="/naxodki">поиска пропавших людей</a></strong>.</p>
<p>Ознакомьтесь с результатами опросов на актуальные темы в разделе <strong><a href="/poll">Опросы</a>, </strong>черпайте полезную информацию из наших статей в разделе&nbsp;<strong><a href="/news">Новости</a>&nbsp;</strong>и на <strong><a href="https://forum.myldl.ru/">Форуме</a>.</strong></p>
<p>Если вы понимаете, что вам близка идея ЛДЛ и вы хотите оставить пожелания по работе ресурса, поделиться идеями, предложить сотрудничесво, то посетите страничку с <a href="../../contacts">контактной информацией</a> и свяжитесь с нами по любому из указанных способов.</p>
<p><strong>На сайте писать личные сообщения пользователю LDL&nbsp;<a href="/users/"></a></strong></p>                </div>
            </div>
        </section>
    </div>
</div>  
        
        
  @push('js')
        
         @endpush

@endsection