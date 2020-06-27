 <!DOCTYPE html><html lang="ru">
<head>
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11" />
	<meta name="http-equiv=Cache-Control" content="content=no-cache" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Сайт взаимопомощи, на котором люди оказывают и просят безвозмездную помощь. Некоммерческая помощь людям - это наш профиль, наш девиз - люди для людей. Заходите!" />
	
    <title>Безвоздмездная помощь  всем нуждающимся людям - сайт взаимопомощи ЛДЛ</title>

    <link href="https://myldl.ru/static/css/style.css?v=1" rel="stylesheet" type="text/css" />
	
    <script>baseurl = 'https://myldl.ru/'</script>

        <!-- _________________________________________________________ -->
    <!--    -->
    <!-- _________________________________________________________ -->

    <script src="https://myldl.ru/static/js/jquery/jquery-1.11.3.min.js"></script>
    <script src="https://myldl.ru/static/js/jquery/jquery-ui.min.js"></script>

    <link rel="icon" href="https://myldl.ru/favicon.ico">

    <!-- RedPush
    <script type="text/javascript" src="https://checkpost.me/?pu=gnstqnrwhe5ha3ddf4ytanjw" async></script> -->

    <!--poshmoose
    <script type='text/javascript' async defer src='https://pushmoose.com/static/script/myldl.js'></script>-->

</head>
<body class="page-main">
 <header class="desktop">
            <a href="https://myldl.ru/" class="logo"><img src="https://myldl.ru/static/images/logo.png" alt="logo" /></a>
            <div class="navbar">
                <form class="search" action="https://myldl.ru/search" role="search">
                    <input type="search" placeholder="Поиск по сайту..." name="s"/>
                    <input type="hidden" name="z" value="0"/>
                    <button type="submit"></button>
                </form>
                <div class="login-signup siggned">
                                            <li class="top-sms-count">
							                            <span>
                                <a href="#" id="login-btn2">ДНК<div class="arrow"></div></a>
                                <div class="login-popup2" id="login-popup2">
                                    <ul>
                                        <li><a style="color:blue" href="https://myldl.ru/profile/index">Мой профиль</a></li>

                                    </ul>
                                </div>
                            </span>
                        </li>
                        <li>
                            <a class="logout-link" href="https://myldl.ru/auth/logout"></a>
                        </li>
                                    </div>
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

</body>
</html>