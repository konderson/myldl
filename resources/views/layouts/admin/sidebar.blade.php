
		<div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
			<h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
		  
			<!-- Logo (221px wide) -->
			<a href="#"><img id="logo" src="http://test.myldl.ru/application/views/admin/resources/images/logo.png" alt="Simpla Admin logo" /></a>
		  
			<!-- Sidebar Profile links -->
			<div id="profile-links">
				Привет, <a href="#messages" rel="modal">Admin</a>
				<!--, you have <a href="#messages" rel="modal" title="3 Messages">3 Messages</a><br />-->
				<br />
				<!--suppress HtmlUnknownAttribute -->
				<a href="/" target="_blank">Просмотр сайта</a> | <a href="/" title="Sign Out">Выход</a>
			</div>        
			
			<ul id="main-nav">  <!-- Accordion Menu -->
				<li>
				    <?php $us='';  if(isset($user)) $us=$user->id ?>
					<a href="/admin/index" class="nav-top-item no-submenu    {{Request::is('admin/index')? 'current': ''}}   {{Request::is('admin/user/edit/'.$us)? 'current': ''}}">Пользователи</a>  <!-- Add the class "no-submenu" to menu items with no sub menu -->
				</li>				
				<li>
				    <?php $us='';  if(isset($delo)) $us=$delo->id ?>
					<a href="/admin/delo/index" class="nav-top-item no-submenu {{Request::is('admin/delo/index')? 'current': ''}}   {{Request::is('admin/delo/edit/'.$us)? 'current': ''}}">Дела</a>
				</li>
				<li>
				    <?php $sv='';  if(isset($service)) $sv=$service->id ?>
				    
					<a href="/admin/service/index" class="nav-top-item no-submenu  {{Request::is('admin/service/index')? 'current': ''}}   {{Request::is('admin/service/edit/'.$sv)? 'current': ''}} ">Услуги</a>
				</li>
				<li>
					<a href="#" class="nav-top-item ">Отзывы</a>
					<ul>
						<li><a href="/admin/reviews">Отзывы</a></li>
						<li><a href="/admin/reviews_otvet">Ответные отзывы</a></li>
					</ul>
				</li>
				<li>
				    
					<a href="#" class="nav-top-item  {{Request::is('admin/hochu_pom/index')? 'current': ''}} {{Request::is('admin/poiski/index')? 'current': ''}} {{Request::is('admin/naxodki/index')? 'current': ''}} ">Взаимопомощь</a>
					<ul>
						<li><a href="/admin/hochu_pom/index">Хочу помочь</a></li>
						<li><a href="/admin/poiski/index">Нужна помощь</a></li>
						<li><a href="/admin/naxodki/index">Ищу человека</a></li>
					</ul>
				</li>
				<li>
				    <?php $fut_id='';  if(isset($future)) $fut_id=$future->id ?>
					<a href="/admin/future/index" class="nav-top-item no-submenu  {{Request::is('admin/future/index')? 'current': ''}}   {{Request::is('admin/future/edit/'.$fut_id)? 'current': ''}}">Будущие дела</a>
				</li>
				<li>
				     <?php $iv='';  if(isset($interview)) $iv=$interview->id ?>
					<a href="/admin/interview/index" class="nav-top-item no-submenu  {{Request::is('admin/interview/index')? 'current': ''}} {{Request::is('admin/interview/edit/'.$iv)? 'current': ''}}  ">Интервью</a>
				</li>
				<li>
				    <?php $pj='';  if(isset($project)) $pj=$project->id ?>
				    
					<a href="/admin/project/index" class="nav-top-item no-submenu {{Request::is('admin/project/index')? 'current': ''}}   {{Request::is('admin/project/edit/'.$pj)? 'current': ''}}   {{Request::is('admin/project/add')? 'current': ''}}">Наши проекты</a>
				</li>
				<li>
				      <?php  $diar='';  if(isset($diary)) $diar=$diary->id ?>
					<a href="/admin/diary/index" class="nav-top-item no-submenu {{Request::is('admin/diary/index')? 'current': ''}}   {{Request::is('admin/diary/edit/'.$diar)? 'current': ''}}   {{Request::is('admin/diary/add')? 'current': ''}}">Дневник</a>
				</li>				
				<li>
				    <?php $nv='';  if(isset($nedit)) $nv=$nedit->id ?>
					<a href="/admin/news/index" class="nav-top-item no-submenu  {{Request::is('admin/news/index')? 'current': ''}}   {{Request::is('admin/news/edit/'.$nv)? 'current': ''}}   {{Request::is('admin/news/add')? 'current': ''}}   ">Новости</a>
				</li>
                <li>
                    <?php $iv='';  if(isset($tag)) $iv=$tag->id ?>
                    <a href="/admin/tag/index" class="nav-top-item no-submenu   {{Request::is('admin/tag/add')? 'current': ''}} {{Request::is('admin/tag/index')? 'current': ''}} {{Request::is('admin/tag/edit/'.$iv)? 'current': ''}}  ">Теги</a>
                </li>
				<li>
					<a href="/admin/texts" class="nav-top-item no-submenu ">Тексты</a>
				</li>
				<li>
					<a href="/admin/article" class="nav-top-item no-submenu ">Статьи</a>
				</li>
				<li>
					<a href="/admin/menu" class="nav-top-item no-submenu ">Меню</a>
				</li>
				<li>
					<a href="#" class="nav-top-item ">Жалобы</a>
					<ul>
						<li><a href="/admin/appeal">На пользователей</a></li>
						<li><a href="/admin/appeal_dela">На дела</a></li>
					</ul>
				</li>
				<li>
					<a href="/admin/comment" class="nav-top-item no-submenu ">Комментарии</a>
				</li>
				<li>
					<a href="/event_ribbon_profile" class="nav-top-item no-submenu ">Лента событий</a>
				</li>
				<li>
					<a href="#" class="nav-top-item ">Поиск по сайту</a>
					<ul>
						<li><a class="search-sys-tables" href="/admin/search_sys_tables">Таблицы</a></li>
						<li><a class="search-sys-filters" href="/admin/search_sys_filters">Фильтры</a></li>
					</ul>
				</li>
				<li>
					<a href="#" class="nav-top-item ">Соц-Опросы</a>
					<ul>
						<li><a class="social-razdeli" href="/admin/razdel/index">Разделы</a></li>
						<li><a class="social-arxiv" href="/admin/social_q_archive">Архив</a></li>
					</ul>
				</li>
			
				<li>
					<a href="/admin/log" class="nav-top-item no-submenu ">События</a>
				</li>
				<li>
					<a href="/admin/text_patterns" class="nav-top-item no-submenu ">Текстовые Паттерны</a>
				</li>
				<li>
					<a href="/admin/seo_texts" class="nav-top-item no-submenu ">SEO Тексты</a>
				</li>
				<li>
					<a href="/admin/banners" class="nav-top-item no-submenu ">Баннеры</a>
				</li>
				<li>
					<a href="#" class="nav-top-item  ">Настройки</a>
					<ul>
						<li><a class="sections_main" href="/admin/profile_settings/change_pass">Смена пароля &rarr;</a></li>

					</ul>
				</li>
				
				<!--<li>
					<a href="http://test.myldl.ru/admin/settings" class="nav-top-item no-submenu">Настройки</a>
				</li>-->
			</ul> <!-- End #main-nav -->

<script type="text/javascript">
function show_email_name(email, name) {
	$('#poluchatel').html(name);
	$('#pochta').html(email);
	$("input[name=email]").val(email);
}
$(function(){
	$('[data-action=delete]').click(function(e) {
		if (!confirm('Удалить этого пользователя?')) {
			e.preventDefault();
		}
	});
});
</script>
			
			<div id="messages_send" style="display: none"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
				
				<h3>Отправить сообщение</h3>
			 
				<p>
					<strong>Получатель:</strong> <span id="poluchatel"></span><br />
					<strong>Почта:</strong> <span id="pochta"></span><br />
				</p>
			 
				<form action="/admin/user_send_message" method="post">
					<input type="hidden" name="ci_csrf_token" value="">
		
					<fieldset>
					<p><label>Тема письма</label>
						<input class="text-input medium-input" type="text" name="subject" /> <span class="input-notification information"></span>
					</p>
					<p><label>Сообщение</label><textarea class="textarea" name="message" cols="79" rows="5"></textarea></p>
					</fieldset>
					
					<fieldset>
						<input type="hidden" name="email" />
						<input class="button" type="submit" value="Отправить" />
						
					</fieldset>
					
				</form>
				
			</div> <!-- End #messages -->
			
		</div></div> <!-- End #sidebar -->