 <header class="mobile">
            <div class="logo-mobile">
                <a href="{{route('main.index')}}"><img src="{{asset('asset/front/images/logo.png')}}" alt="logo" /></a>
                <!-- <img src="https://myldl.ru/static/images/logo.png" alt="logo" /> -->
                <span id="burger" class="burger"><!-- &#9776; --></span>
                 <!--
                 <div class="login-signup">

                    <li>
                        <span>
                            <a href="#" id="login-btn2">Вход</a>
                            <div class="login-popup" id="login-popup2">
                                <form action="https://myldl.ru/auth/login" class="form" role="form" method="post" accept-charset="UTF-8">
                                    <input name="email" type="email" class="form-control" placeholder="email" required="">
                                    <input name="passw" type="password" class="form-control" placeholder="password" required="">
                                    <label>
                                        <input type="checkbox"> Запомнить меня
                                    </label>
                                    <input type="hidden" name="ci_csrf_token" value="">
                                    <button type="submit" class="btn btn-success btn-block">Войти</button>
                                </form>
                            </div>
                        </span>
                    </li>
                    <li>
                        <a href="https://myldl.ru/auth/register">Регистрация</a>
                    </li>
                     
                </div>
                -->
                @if(!Auth::check())
                <div class="login-signup ">
                                            <li>
                            <span>
                                <a href="#" id="login-btn2">Вход</a>
                                <div class="login-popup" id="login-popup2">
                                   <form action="{{route('login')}}" class="form" role="form" method="post" accept-charset="UTF-8">
                                        {{ csrf_field() }}
                                        <input name="email" type="email" class="email" placeholder="| Логин / E-mail" required="">
                                        <input name="passw" type="password" class="password" placeholder="| Пароль" required="">
                                        <label>
                                            <input type="checkbox"> Запомнить меня
                                        </label>
                                        <input type="hidden" name="ci_csrf_token" value="">
                                        <button type="submit" class="btn btn-success btn-block">Войти</button>
                                    </form>
                                </div>
                            </span>
                        </li>
                        <li>
                            <a href="{{route('register')}}">Регистрация</a>
                        </li>
                                    </div>
                @else                    
                <div class="login-signup siggned">
                                            <li>
                            <span style="position: relative;">
                                <!-- <a href="#" id="login-btn2">konderson<div class="arrow"></div></a> -->

                                <a href="#" id="login-btn3">{{Auth::user()->name}}<div class="arrow"></div></a>
                                <div class="login-popup3" id="login-popup3">
                                    <ul>
                                        <li><a href="/profile/index">Мой профиль</a></li>
                                        <li><a href="/profile/messages">Мои сообщения</a></li>
                                        <li><a href="/profile/settings">Настройки</a></li>
                                           <li>
                        <a href="{{route('logout')}}" class="dropdown-item "
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">Выход
                        </a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="">
                            @csrf
                        </form>
                    </li>
                                    </ul>
                                </div>
                            </span>
                            <!-- <span>
                                <a href="profile/index" id="login-btn2">konderson</a>
                            </span> -->
                        </li>
                        <li>
                        <a href="{{route('logout')}}" class="logout-link"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        </a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="">
                            @csrf
                        </form>
                    </li>
                                    </div>
                @endif


                <form class="search" action="/search" role="search">
                    <input type="text" placeholder="Поиск по сайту..." name="s">
                    <input type="hidden" name="z" value="0"/>
                    <button type="submit"></button>
                </form>
                <nav id="mobile-nav">
                    <ul>
	                    <li><a href="/news">Новости</a></li><li><a href="/shares">Акции</a></li><li><a href="/diary">Дневник проекта</a></li><li><a href="/projects">Наши проекты</a></li><li><a href="/interview">Интервью</a></li><li><a href="/services">Объявления</a></li><li><a href="/hochu_pom">Хочу помочь</a></li><li><a href="/poiski">Нужна помощь</a></li><li><a href="/naxodki">Ищу человека</a></li><li><a href="https://forum.myldl.ru/">Форум</a></li>                    </ul>
                </nav>
            </div>
        </header>