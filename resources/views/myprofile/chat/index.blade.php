@extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')

@endpush
@section('content')
  <style>
        section .moya-anketa .right .right-sms .contact-photo:after {
            display:none;
        }
        section .moya-anketa .right .right-sms .load-more {
            position:inherit;
            color: #fff;
            width: 50%;
            margin-left: 25%;
            margin-right: 25%;
            text-transform: uppercase;
            font-weight: 700;
            margin-top: 10px;
            border: 0px;
            background-color: #99ca3d;
            padding: 5px 12px;
            text-align: center;
            cursor: pointer;
            display:none;
        }
        section .moya-anketa .right .right-sms .load-more:focus {
            outline: none;
        }
        section .moya-anketa .right .right-sms .load-more:active {
            background-color: #89bc28;
        }


        .popupButton {
            display: inline-block;
            font-family: arial,sans-serif;
            font-size: 14px;
            font-weight: bold;
            color: rgb(68,68,68);
            text-decoration: none;
            user-select: none;
            padding: .2em 1.2em;
            margin-left:1em;
            outline: none;
            border: 1px solid rgba(0,0,0,.1);
            border-radius: 2px;
            background: rgb(245,245,245) linear-gradient(#f4f4f4, #f1f1f1);
            transition: all .218s ease 0s;
        }
        .popupButton:hover {
            color: rgb(24,24,24);
            border: 1px solid rgb(198,198,198);
            background: #f7f7f7 linear-gradient(#f7f7f7, #f1f1f1);
            box-shadow: 0 1px 2px rgba(0,0,0,.1);
        }
        .popupButton:active {
            color: rgb(51,51,51);
            border: 1px solid rgb(204,204,204);
            background: rgb(238,238,238) linear-gradient(rgb(238,238,238), rgb(224,224,224));
            box-shadow: 0 1px 2px rgba(0,0,0,.1) inset;
        }
        .popupTitle{
            border-radius: 5px;
            width: 100%;
            background: #fff;
            padding: 5%;

        }
        #close-user-in-dialog{
            margin: 40px auto 0px 25%;
            width: 20%;
            padding: 10px;
            background-color: #ebebeb;
            border-radius: 5px;
            box-shadow: 0px 0px 10px #000;
            position: fixed;
            z-index: 9;
        }
        .del-msg{
            float:right;
            display:none;
        }
        .right-message:hover .del-msg{

            display:flex;

        }
        section .moya-anketa .right .right-sms .chat .right-message .message{
            width:75%;
        }
        a.user-anketa {
            text-decoration: none;
            color: black;
        }
        .is-read {
            margin-left: 12%;
            font-size: 12px;
            font-style: italic;
            color: dimgrey;
            float: right;
        }
        #btnSmile{
            background: url(/asset/front/images/smile.png) center center no-repeat;
            background-color: rgb( 153, 202, 61 );
            box-shadow: 0px 8px 30px -10px rgb( 162, 204, 50 );
            width: 55px;
            height: 55px;
            border: none;

        }
        #btnSend {
    background: url(/asset/front/images/send-message.png) center center no-repeat;
        background-color: rgba(0, 0, 0, 0);
    background-color: rgb( 153, 202, 61 );
    box-shadow: 0px 8px 30px -10px rgb( 162, 204, 50 );
    width: 55px;
    height: 55px;
    border: none;
}
      .message {
              list-style: none;
}
   .right-message  p{
              margin-left:20px;
}
      }
        .closeSmileBox{
            float: right;
            margin-bottom: 5px;
            margin-left: 100%;
            cursor:pointer;
        }
        .smile-box-img{
            cursor:pointer;
        }
        img .imgspan{
            display:flex;
        }
        #smileBox{
        width: 80%;
        padding: 10px;
        background-color: #ebebeb;
        border-radius: 5px;
        box-shadow: 0px 0px 10px #000;
        position: absolute;
        z-index: 9;

       }
       .closeSmileBox{
       float: right;
       margin-bottom: 5px;
       margin-left: 100%;
       cursor:pointer;
       }
       .smile-box-img{
       cursor:pointer;
       }
       img .imgspan{
       display:flex;
       }
    </style>
          <main class="col-xs-12">
              
              
              <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li><a href="/profile/index">Профиль</a></li><li class="active">Мои Сообщении</li>    </ol>
</div>
<!-- сортировка таблицы -->





<section>
    <div class="people-outside lenta-sobitii moya-anketa">
     @include('myprofile.left')
       
       <div class="right wmMain" id="app">
                <p class="title">Сообщения</p>
       <chat-app :user="{{auth()->user()}}"></chat-app>
                
               
                    
        </div>
        
       
    </div>
</section>       

                
                            


              
     @push('js')
 <script src="{{ asset('js/app.js') }}"></script>
 
 @endpush
 @endsection