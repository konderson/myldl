<div class="left">
    <ul style="margin-top: 0px;" id="menu">
        <li style="background-image: url(/asset/front/images/pc1.png);"><a href="{{route('profile.index')}}">Лента событий </a></li>
        <li  class="{{Request::is('profile/profile_view')? 'selected-li': ''}}"   style="background-image: url(/asset/front/images/pc2.png);"><a href="{{route('profile.view')}}">Моя Анкета</a></li>
        <li  style="background-image: url(/asset/front/images/myworks.png);"><a href="{{route('profile.mydelo')}}">Мои дела (<span id="relation_count">{{$c_dala}}</span>) </a></li>
        <li style="background-image: url(/asset/front/images/pc4.png);"><a class="left-sms-count" href="/profile/messages">Мои сообщения (<span id="relation_count">{{$c_message}}</span>)</a></li>
        <li style="background-image: url(/asset/front/images/my-adverts.png);"><a href="/profile/uslugi">Мои объявления (<span id="relation_count">{{$c_serv}}</span>)</a></li>
        <li style="background-image: url(/asset/front/images/my-reviews.png);"><a href="/profile/reviews">Мои отзывы (<span id="relation_count">0</span>)	 </a></li>
        <li style="background-image: url(/asset/front/images/pc7.png);"><a href="/profile/relation">Мои связи (<span id="relation_count">{{$c_frend}}</span>)</a></li>
        <li style="background-image: url(/asset/front/images/fav-work.png);"><a href="/profile/izbranniye_dela">Избранные дела 	(<span id="relation_count">{{$c_fdelo}}</span>)	        </a></li>
        <li style="background-image: url(/asset/front/images/pc9.png);"><a href="/profile/vzaimopomoshi">Взаимопомощь (<span id="relation_count">{{$c_help}}</span>) </a></li>
        <li style="background-image: url(/asset/front/images/pc10.png);"><a href="/profile/settings">Настройки</a></li>
        <li>
            <a href="/profile/future_business">
                Будущие дела             </a>
        </li>
        <!--<li>
            <a href="https://myldl.ru/profile/poiski">
                Поиски
            </a>
        </li>
        <li>
            <a href="https://myldl.ru/profile/naxodki">
               Находки
            </a>
        </li>
        <li>
            <a href="https://myldl.ru/profile/hochu_pom">
                Хочу помочь
            </a>
        </li>-->
        <li>
            <a href="/profile/ideas">
                Мои мысли
            </a>
        </li>
    </ul>
</div>