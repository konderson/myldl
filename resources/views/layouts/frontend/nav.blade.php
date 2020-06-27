<header class="desktop">
            <a href="{{route('main.index')}}" class="logo"><img src="{{asset('asset/front/images/logo.png')}}" alt="logo" /></a>
            <div class="navbar">
                <form class="search" action="/search">
                    <input type="search" placeholder="Поиск по сайту..." name="s"/>
                    <button type="submit"></button>
                </form>
                @guest
                <div class="login-signup ">
                                            <li>
                            <span>
                                <a href="#" id="login-btn">Вход</a>
                                <div class="login-popup" id="login-popup">
                                    <form action="{{route('login')}}" class="form" role="form" method="post" accept-charset="UTF-8">
                                        {{ csrf_field() }}
                                        <input name="email"  class="email" placeholder="| Логин / E-mail" required="">
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
                                            <li class="top-sms-count">
							                            <span>
							 
							 @if($count_unread>0)                               
							 <a href="/profile/messages">
							<img src="{{asset('asset/front/images/sms-count.png')}}">
							<!-- Количество новых сообщений	 -->
							<span class="green-span" style="color: #99ca3d;">{{$count_unread}}</span>
							</a>
							@endif
                                <a href="#" id="login-btn2">{{Auth::user()->name}}<div class="arrow"></div></a>
                                <div class="login-popup2" id="login-popup2">
                                    <ul>
                                        <li><a href="{{route('profile.index')}}">Мой профиль</a>
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
                                        
                                        </li>

                                    </ul>
                                </div>
                            </span>
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
                
                @endguest
                <nav>
                    <ul>
                         @php
    function buildMenu($items, $parent)
    {
        foreach ($items as $item) {
            if (isset($item->children)) {
            @endphp
                <li><a href="{{ $item->url }}">{{ $item->name }}</a>       
                        <ul class="subnav">
                            
                             @php buildMenu($item->children, 'subnav-'.$item->id) @endphp
                        </ul>
                        </li> 
                        
                         @php
            } else {
            @endphp
                 <li class="supnav"><a href="{{ $item->url }}" class="supa">{{ $item->name }}</a>
            @php
            }
        }
    }
           buildMenu($menuitems, 'mainMenu')
    @endphp             
    <li class="supnav"><a href="/forum" class="supa">Форум</a>         
                        
                </ul>
                </nav>
            </div>
        </header>



<!-- Left Side Of Navbar -->