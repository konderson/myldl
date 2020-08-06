@extends('layouts.frontend.app')
@section('title','Люди для людей')
<meta name="description" content="Тест">
        <meta name="keywords" content="">
@push('css')
@endpush
@section('content')
 
   <div class="sm-breadcrumb">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li><li><a href="/users">Пользователи</a></li><li class="active">{{$user->name}}</li>    </ol>
</div>
<!-- сортировка таблицы 
<script src="{{asset('asset/front/js/jquery.dataTables.min.js')}}"></script>-->
<!-- сортировка таблицы -->


<!-- діалог -->
<link href="{{asset('asset/front/js/datepicker/jquery-ui.css')}}" rel="stylesheet">
<script src="{{asset('asset/front/js/datepicker/jquery-ui.js')}}"></script>
<script src="{{asset('asset/front/js/js/dela.js')}}"></script>
<!-- діалог end -->

<!-- AjaxUpload -->
<script type="text/javascript" src="{{asset('asset/front/js/ajaxupload.3.5.js')}}"></script>


          <script type="text/javascript" src="{{asset('asset/front/fancy_box/jquery.fancybox.js?v=2.1.5')}}"></script>
	      <link rel="stylesheet" type="text/css" href="{{asset('asset/front/asset/front/fancy_box/jquery.fancybox.min.css')}}">


<script>
    $(function () {
        $('.fancybox').fancybox();
        $(document).on('click', '#dialog2 .add', function () {
            
                var user_id=$('#user_id_appeal').val();
		var text=$("#text_appeal").val();
    $.ajax({
   url:"/appeal/add",
   method:"POST",
   
   data:{'user_id':user_id,'text':text,'type':2},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            dataType: "html",
			success: function(msg){
				alert(msg);
                  $('#dialog2').html("<center><br /><br /><h3>Ваша жалоба отправлена администратору !</h3><br /><br /></center>");
        setTimeout(function() {
            $.fancybox.close();
            location.reload(0);
        },
        800);  
                }
       
    })
         
        });

       $('#send_msg').click(function(){
          
           $.ajax({
                type: "POST",
                url: "/conversation/send",
                data: {
                     contact_id: $('#user_id_appeal').val(),
                     text: $("#chat-msg").val(),
                },
                 headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
           dataType: "html",
                success: function (msg) {
                    
                setTimeout(function () {
                    $.fancybox.close();
                location.reload(0);
            },
            1000);
                    } 
                   	// ховаєм кнопки
                
            });
       });


        $(document).on('click', '#dialog3 .add', function () {
       
            $.ajax({
                type: "POST",
                url: "/users/add/frend",
                data: {
                    frend_id: "<?php echo ($user->id);?>",
                    
                },
                 headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                dataType: "html",
                success: function (msg) {
                    
                    if (msg == "ok") {
                        $('#dialog3').html("<center><br /><br /><h3>Связи обновлены !</h3><br /><br /></center>");
                    } else {
                        $('#dialog3').html("<center><br /><br /><h3>Пользователь уже был добавлен ранее !</h3><br /><br /></center>");
                    }
                    $('#dialog3 .a-btn, #dialog3 .btn-green').hide();	// ховаєм кнопки
                }
            });
          /*  setTimeout(function () {
                    $.fancybox.close();
                location.reload(0);
            },
            800);*/
        });

        $(document).on('click', '#dialog4 .add', function (e) {
            error = 0;
            $('#modal_tema, #modal_subyect, #modal_otziv').css("border-color", "#ddd");
            if ($('#modal_tema').val() == '') {
                $('#modal_tema').css("border-color", "#D93600");
                error = 1;
            }
            if ($('#modal_subyect').val() == '') {
                $('#modal_subyect').css("border-color", "#D93600");
                error = 1;
            }
            if ($('#modal_otziv').val() == '') {
                $('#modal_otziv').css("border-color", "#D93600");
                error = 1;
            }

            if (error > 0) {
                e.preventDefault();
            }
        });

       /* $(document).on('click', '#dialog5 .add', function () {
            var checked_jobs = $('#collective_work_table_body input:checked');
            var selected_job_ids = [];

            if (checked_jobs.length > 0) {
                $.each(checked_jobs, function (key, job) {
                    selected_job_ids.push($(job).attr('job_id'));
                });

                $.ajax({
                    type: "POST",
                    url: "https://myldl.ru/user/ajax_invite_to_job",
                    data: {
                        invited_user_id: "20266",
                        'ci_csrf_token': $.cookie('hash_cookie_id'),
                        selected_job_ids: selected_job_ids
                    },
                    dataType: "html",
                    success: function (response) {
                        var dela = JSON.parse(response);

                        console.log(dela);
                    }
                });
            }

            setTimeout(function () {
                    $.fancybox.close();
                    //location.reload(0);
                },
                800);
        });*/
/*
        $('#invite_to_job').click(function () {
            $.ajax({
                type: "POST",
                url: "https://myldl.ru/main/ajax_get_user_jobs",
                data: {
                    invited_user_id: "20266",
                    'ci_csrf_token': $.cookie('hash_cookie_id'),
                    types: [2], // Collective: 2, Individual: 1
                    vhod_v_delo: [1] // Открыт всем: 1, По запросу: 2
                },
                dataType: "html",
                success: function (response) {
                    var dela = JSON.parse(response);

                    console.log(dela);
                    html = '';
                    $.each(dela.user_open_jobs, function (key, job) {
                        var used = '';
                        var used_tex = '';

                        if (dela.invited_user_jobs[job.id] == 3) {
                            used = 'disabled';
                            used_tex = '<span class="pull-right text-warning" style="color: red"><small>Пользователь уже является участников этого дела</small></span>';
                        }
                        var status = '<div class="status" style="background-image: url(/static/images/close2.png)">Закрыт</div>';;

                        if (job.status == '1') {
                            status = '<div class="status open" style="background-image: url(/static/images/open.png)">Открыт</div>';
                        }

                        html += '<tr>' +
                            '<td><input ' + used + ' type="checkbox" name="job_' + job.id + '" job_id="' + job.id + '" /> <span>' + job.nazva + " " + used_tex + '</span></td>' +
                            '<td>'+ status +'</td>' +
                            '</tr>';
                    });
                    $("#collective_work_table_body").html(html);
                }
            });
        });
       
        $('#example').dataTable({
            "bFilter": false,
            "bPaginate": false,
            "bInfo": false,
          //  "order": [[3, "asc"]],
            "language": {emptyTable: " "}
        });*/
    })
</script>

   <script>
   $( document ).ready(function() {
	   
	   var active_block='';
	  
        $("#serv_info").hide();
        $("#help_info").hide();
        $("#anketa_info").hide();
        $("#otziv_info").hide();
		 $("#izbran_info").hide();
		active_block='#my_delo';
		
       
       $("#my_delo").click(function(){
           
           $("#name_info").text("Дела");
           $("#serv_info").hide();
           $("#help_info").hide();
		    $("#otziv_info").hide();
           $("#delo_info").show();
		   $("#anketa_info").hide();
		    $("#izbran_info").hide();
		  $(active_block).removeClass('selected-li'); 
		   active_block='#my_delo';
		   $(active_block).addClass('selected-li');
		   var scrollTop = $('#lower-part').offset();
         $(document).scrollTop(scrollTop);
           
       }) ; 
       
       $("#my_serv").click(function(){
           
            $("#name_info").text("Объявления");
            $("#serv_info").show();
           $("#help_info").hide();
           $("#delo_info").hide();
		   $("#anketa_info").hide();
		    $("#otziv_info").hide();
			 $("#izbran_info").hide();
		   $(active_block).removeClass('selected-li'); 
		   active_block='#my_serv';
		   $(active_block).addClass('selected-li');
		    var scrollTop = $('#lower-part').offset();
         $(document).scrollTop(scrollTop);
       }) ; 
       
       $("#my_help").click(function(){
            $("#name_info").text("Взаимопомощь");
            $("#serv_info").hide();
           $("#help_info").show();
           $("#delo_info").hide();
		   $("#anketa_info").hide();
		    $("#otziv_info").hide();
			 $("#izbran_info").hide();
		   $(active_block).removeClass('selected-li'); 
		   active_block='#my_help';
		   $(active_block).addClass('selected-li');
		   		    var scrollTop = $('#lower-part').offset();
         $(document).scrollTop(scrollTop);
		   
       }) ; 
        $("#my_anketa").click(function(){
            $("#name_info").text("Связи");
            $("#serv_info").hide();
            $("#help_info").hide();
            $("#delo_info").hide();
			 $("#otziv_info").hide();
			  $("#izbran_info").hide();
            $("#anketa_info").show();
			$(active_block).removeClass('selected-li'); 
		   active_block='#my_anketa';
		   $(active_block).addClass('selected-li');
		   var scrollTop = $('#lower-part').offset();
         $(document).scrollTop(scrollTop);
			
       }) ; 
	   
	   
	   $("#my_otziv").click(function(){
            $("#name_info").text("Отзывы");
            $("#serv_info").hide();
            $("#help_info").hide();
            $("#delo_info").hide();
			 $("#otziv_info").show();
            $("#anketa_info").hide();
			 $("#izbran_info").hide();
			$(active_block).removeClass('selected-li'); 
		   active_block='#my_otziv';
		   $(active_block).addClass('selected-li');
		   var scrollTop = $('#lower-part').offset();
         $(document).scrollTop(scrollTop);
			
       }) ;
	   
	   
	   
	    $("#my_izbran").click(function(){
            $("#name_info").text("Отзывы");
            $("#serv_info").hide();
            $("#help_info").hide();
            $("#delo_info").hide();
			 $("#otziv_info").hide();
			 $("#izbran_info").show();
            $("#anketa_info").hide();
			$(active_block).removeClass('selected-li'); 
		   active_block='#my_izbran';
		   $(active_block).addClass('selected-li');
		   var scrollTop = $('#lower-part').offset();
         $(document).scrollTop(scrollTop);
			
       }) ;
       
   }); 
   </script>
<!-- ui-dialog -->
<div id="dialog2" title="Пожаловаться на пользователя" style="display: none">
    <h2 class="text-center">Оставьте жалобу на <span>{{$user->name}}</span></h2>
    <div class="form-group" style="margin: 0;">
        <label><b>Жалоба</b></label>
        <textarea class="form-control tfi" id="text_appeal"></textarea>
        <input type="hidden" id="user_id_appeal" value="{{$user->id}}">
    </div>
    <div class="btn-group">
        <button type="button" class="add btn btn-green">Добавить</button>
        <a class="a-btn" onclick="$.fancybox.close();">Отмена</a>
    </div>
</div>

<div id="dialog3" title="Добавить в связи" style="display: none">
    <h2 class="text-center">Добавить <span>{{$user->name}}</span> в связи?</h2>
    <div class="img-box" style="text-align: center;"><img src="{{asset('storage/avatar/'.$user->person->avatar)}}" alt=""/></div>
    <button  type="button" class="add btn btn-green btn-table">Добавить</button>
    <div>
        <a class="a-btn" onclick="$.fancybox.close();">Отмена</a>
    </div>
</div>

<div id="dialog4" title="Оставить отзыв" style="display: none">
    <div id="add-review" class="modalwin">
        <h2 class="text-center">Оставьте <span></span> отзыв</h2>

                    <form action="/add_review" method="POST" id="form_add_otziv">
                <input type="hidden" name="ci_csrf_token"
                       value="">
                <div class="revinfo">
                    <div class="row-raform-group">
                        <input class="radio" type="radio" id="choice-1" name="flag_otziv" value="1" checked="">
                        <label for="choice-1">
                            <span class="like">Положительный</span></label>
                        <input class="radio" type="radio" id="choice-2" name="flag_otziv" value="0">
                        <label for="choice-2">
                            <span class="unlike">Отрицательный</span></label>
                    </div>
                    <div class="form-group">
                        <label for="modal_tema">Заговолок</label>
                        <input class="form-control tfi" type="text" name="tema" id="modal_tema" maxlength="50" placeholder="Заговолок...">
                    </div>
                    <div class="form-group">
                        <label for="modal_subyect">Пользователь*</label>
                        <input class="form-control tfi" type="text" name="subyect" id="modal_subyect"
                               value="{{$user->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="modal_otziv">Отзыв</label>
                        <textarea class="form-control tfi" name="text_otziv" id="modal_otziv" placeholder="Отзыв..."></textarea>
                        <input type="hidden" name="is_user" value="21889">
                    </div>
                </div>
                <div class="btn-group">
                    <button class="btn add btn-green">Добавить</button>
                    <a class="a-btn" onclick="$.fancybox.close();">Отмена</a>
                </div>
            </form>
            </div>
</div>

<div id="dialog5" title="Пригласить в дело" style="display: none">
    <h2 class="text-center">Пригласите <span>admin</span> в дело:</h2>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Название дела:</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody id="collective_work_table_body">
            </tbody>
        </table>
    </div>
    <div class="btn-group">
        <button class="btn btn-green add">Добавить</button>
        <a class="a-btn" onclick="$.fancybox.close();">Отмена</a>
    </div>
</div>


<div id="user_send_message">
        <div class="message_title">
		
            <h2>Отправить сообщение</h2>
                    </div>
                    <div class="message_status_img"></div>
            <div class="message_status_loader">
                <div></div>
            </div>
            <div class="wmSendMesFields">
                
				                <div id="inputFieldContainer" class="wmMesField">
                                        <textarea id="chat-msg" name="textMsg" rows="1" cols="50" maxlength="512"
                                                  title="Ваше сообщение" placeholder="Ваше сообщение"></textarea>
                </div>
				                <div id="submitButtonContainer" class="wmSendBtn">
                    <input type="hidden" name="rel_id" value="21889"/>
					                    <input id="send_msg" type="button" class="btn btn-success btn-table" value="Отправить сообщение"/>
					                </div>
            </div>
                </div>

<!-- START - Send New Message ----------------------------------------------------------------- -->
<div id="showcontact">
    <h2 class="text-center">Авторизируйтесь для<br>просмотра данных</h2>
    <form action="{{route('login')}}" class="form" role="form" method="post" accept-charset="UTF-8" id="login-nav LoginForm">
        {{ csrf_field() }}
        <input name="email" type="email" class="form-control email" id="exampleInputEmail2" placeholder="| Логин / E-mail" required>
        <input name="passw" type="password" class="form-control password" id="exampleInputPassword2" placeholder="| Пароль" required>
        <div class="checkbox">
            <label>
                <input type="checkbox"> Запомнить меня
            </label>
        </div>
        <input type="hidden" id="hashLoginID" name="ci_csrf_token" value="">
        <button type="submit" class="btn btn-success btn-block">Войти</button>
        <a class="text-center btn-reg a-btn" href="/register">Новый пользователь?</a>
    </form>
</div>


            <!-- ui-dialog -->


<section>
    <div class="people-outside">
        <div class="people-outside-title">
<!--            <span class="title-name">--><!--:</span>-->
            <span class="title-login">
                {{$user->name}}       
                 @if($user->isOnline())
                <i class="is_online true"></i>	
                @else
                    <i class="is_online false"></i>
                    @endif
                <span title='Рейтинг'  >0 </span>
            </span>
            <div class="last-seen">
                <p>Последний визит: <span>Был(а) онлайн {{$user->getTime($user->updated_at->timestamp)}} назад</span></p>
            </div>
        </div>

        <div class="left">
            <div class="person-page-photo">
				<span style="color: darkred; font-weight: 700; display: block;"> 
				@if($user->person->help==='need')
					Мне нужна помощь
				@else
				    Хочу помогать
				    @endif
			 </span>
	            	                                <img src="{{asset('storage/avatar/'.$user->person->avatar)}}"/>
	                        </div>
            <div class="upper-part-right show-xs">
                                        <a <?php if(Auth::check()){echo'href="#user_send_message"';}else{ echo'href="#showcontact"';}?> id="write_message" class="fancybox btn hide-xs" data-width="386" data-height="430">Написать сообщение </a>
	                      @if(Auth::check())<div class="a "><a  <?php if(Auth::check()){echo'href="#dialog3"';}else{ echo'href="#showcontact"';}?>  class="fancybox" data-width="386" data-height="480">Добавить в связи</a></div>  @endif            
                        <div class="a"><a <?php if(Auth::check()){echo'href="#dialog4"';}else{ echo'href="#showcontact"';}?> class="fancybox" data-width="386" data-height="430">Оставить отзыв</a></div>
                        <div class="a"><a <?php if(Auth::check()){echo'href="#dialog2"';}else{ echo'href="#showcontact"';}?> class="fancybox" data-width="386" data-height="430">Пожаловаться</a></div>
                         @if(Auth::check())<div class="a "><a  <?php if(Auth::check()){echo'href="#dialog5"';}else{ echo'href="#showcontact"';}?>  class="fancybox" data-width="386" data-height="480">Добавить в дело</a></div>  @endif                                                    
												   </div>
            <div class="mobile-profile-info show-xs">
                           <p><span>Возраст: {{$user::getAge($user->person->birthday)}}</span> </p>
                    <p><span>Город:{{$user->person->city}}</span> </p>
                    <p><span>О себе:{{$user->person->about}}</span> </p>
					<p><span>
					    @if($user->person->help==='need')
					Мне нужна помощь
				@else
				    Хочу помогать
				    @endif
					 </span>  </p>                 
                </div>
            
			<ul>
                <li class="selected-li" id="my_delo" style="background-image: url(/static/images/my-works.png);">
                    <a href="#">Мои дела (<span>{{count($delas)}}</span>)</a>
                </li>
                <li  id="my_serv" style="background-image: url(/static/images/my-adverts.png);">
                    <a href="#">Мои объявления (<span>{{count($services)}}</span>)</a>
                </li>
				
                <li  id="my_otziv" style="background-image: url(/static/images/my-reviews.png);">
                    <a href="#">Мои отзывы (<span>0</span>)</a>
                </li>
                <li id="my_izbran" style="background-image: url(/static/images/fav-work.png);">
                    <a href="#">Избранные дела (<span>0</span>)</a>
                </li>
                <li  id="my_anketa" style="background-image: url(/static/images/pc7.png);">
                    <a href="#">Мои связи (<span>{{count($frends)}}</span>)</a>
                </li>
                <li   id="my_help"style="background-image: url(/static/images/pc9.png);">
                    <a href="#">Взаимопомощь (<span>{{count($helps)}}</span>)</a></li>
            </ul>
        </div>

        <div class="right">
            <div class="upper-part">
                <div class="upper-part-left hide-xs">
                                        <p><span>Возраст: {{$user::getAge($user->person->birthday)}}</span> </p>
                    <p><span>Город:{{$user->person->city}}</span> </p>
                    <p><span>О себе:{{$user->person->about}}</span> </p>
					<p><span>
					    @if($user->person->help==='need')
					Мне нужна помощь
				@else
				    Хочу помогать
				    @endif
					 </span>  </p>
                </div>

                <div class="upper-part-right hide-xs">
	                                    <a <?php if(Auth::check()){echo'href="#user_send_message"';}else{ echo'href="#showcontact"';}?> id="write_message" class="fancybox btn hide-xs" data-width="386" data-height="430">Написать сообщение </a>
	                      @if(Auth::check())<div class="a "><a  <?php if(Auth::check()){echo'href="#dialog3"';}else{ echo'href="#showcontact"';}?>  class="fancybox" data-width="386" data-height="480">Добавить в связи</a></div>  @endif            
                        <div class="a"><a <?php if(Auth::check()){echo'href="#dialog4"';}else{ echo'href="#showcontact"';}?> class="fancybox" data-width="386" data-height="430">Оставить отзыв</a></div>
                        <div class="a"><a <?php if(Auth::check()){echo'href="#dialog2"';}else{ echo'href="#showcontact"';}?> class="fancybox" data-width="386" data-height="430">Пожаловаться</a></div>
	                	                                @if(Auth::check())<div class="a "><a  <?php if(Auth::check()){echo'href="#dialog5"';}else{ echo'href="#showcontact"';}?>  class="fancybox" data-width="386" data-height="480">Добавить в дело</a></div>  @endif 
														</div>
                <script>
                    $(document).ready(function () {
                        $('.fancybox').fancybox({
                            'width':500,
                            'height': 400,
                            'autoDimensions': false,
                            'autoSize':false
                        });
                    });
                </script>
            </div>

            <div class="lower-part">
	            <div class="content-block padding-off">
			            <span class="title" id="name_info">Дела</span>
			            <div id="delo_info">
			                @foreach($delas as $delo)
                   <div class="article-info">
        <div class="article-subtitle">
            <div class="date date-dela"><span>{{ Carbon\Carbon::parse($delo->created_at)->format('d.m') }}</span></div>
            <a href="/delo/{{$delo->id}}">{{$delo->nazva}}</a>
        </div>
        <p>{{substr($delo->nazva, 0, 66)}}...</p>
    </div>
        @endforeach     
        </div><!--//id="delo_info-->
                             <div id="serv_info">
			                @foreach($services as $serv)
                   <div class="article-info">
        <div class="article-subtitle">
            <div class="date date-dela"><span>{{ Carbon\Carbon::parse($serv->created_at)->format('d.m') }}</span></div>
            <a href="/usluga/{{$serv->id}}">{{$serv->title}}</a>
        </div>
        <p>{{ substr($serv->description, 0, 250)}}...</p>
    </div>
        @endforeach     
        </div><!--//id="serv_info-->
                               <div id="help_info">
			                @foreach($helps as $help)
                         <div class="article-info">
             <div class="article-subtitle">
            <div class="date date-dela"><span>{{ Carbon\Carbon::parse($help->created_at)->format('d.m') }}</span></div>
            <a href="/searche/{{$help->id}}">{{$help->title}}</a>
        </div>
        <p>{{ substr($help->description, 0, 250)}}...</p>
    </div>
        @endforeach     
        </div><!--//id="help_info-->
        
                             <div id="anketa_info">
             <form action="#">
			<div class="anketa">
				<div class="exception">
					<table class="connectiontbl no-head" id="example">
						<tbody>

						<tr>
							<td>
								<div class="connect-block mclearfix">

                                    @foreach($frends as $frend)
									
													<div class="connect-info">
														<div class="offline">
															<p>{{$frend->userFrend->name}}</p>
														</div>
														<div class="ci-image">
															<br>
															<a href="/user/{{$frend->userFrend->id}}" class="ci-imglink foreign-profile"><img src="{{asset('storage/avatar/'.$frend->userFrend->person->avatar)}}" alt="" /></a>
														</div>
														<div class="ci-data mclearfix">
															<p class="ci-age">{{$frend->user::getAge($frend->userFrend->person->birthday)}}</p>
															<p class="ci-town">{{$frend->userFrend->person->city}}</p>
														</div>
													</div>
													
													@endforeach
												
								</div>
							</td>
						</tr>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="3" rowspan="1">
								<!--Pagination
                                <div class="pagination">
                                    <a href="#" class="active">1</a>&nbsp;<a href="#">2</a>&nbsp;<a href="#">3</a>
                                </div>
                                end Pagination-->
							</td>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</form>
             </div><!--//id="anketa_info-->
                     <div id="otziv_info">
					 
             <form action="#">
			<div class="anketa">
				<div class="exception">
					<table class="connectiontbl no-head" id="example">
						<tbody>

						<tr>
							<td>
								<div class="connect-block mclearfix">

                                    
												
								</div>
							</td>
						</tr>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="3" rowspan="1">
								<!--Pagination
                                <div class="pagination">
                                    <a href="#" class="active">1</a>&nbsp;<a href="#">2</a>&nbsp;<a href="#">3</a>
                                </div>
                                end Pagination-->
							</td>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</form>
             </div><!--//id="anketa_info-->
				
<div id="izbran_info">
             <form action="#">
			<div class="anketa">
				<div class="exception">
					<table class="connectiontbl no-head" id="example">
						<tbody>

						<tr>
							<td>
								<div class="connect-block mclearfix">

                                    
												
								</div>
							</td>
						</tr>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="3" rowspan="1">
								<!--Pagination
                                <div class="pagination">
                                    <a href="#" class="active">1</a>&nbsp;<a href="#">2</a>&nbsp;<a href="#">3</a>
                                </div>
                                end Pagination-->
							</td>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</form>
             </div><!--//id="anketa_info-->				
					</div>
	                        </div>
        </div>
    </div>
</section>

         


   @push('js')
   @endpush
   @endsection