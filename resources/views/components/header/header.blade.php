<header class="">
    <div class="header _container">

        <div class="header__content">

            @php
                $flag = false;
            @endphp
            @auth('admin')
                @php
                    $flag = true;
                @endphp
            @endauth

            @if ($flag)
                <a href="/public/admin" class="fa-solid fa-house"></a>
            @else
                <a href="/public/" class="fa-solid fa-house"></a>
            @endif


            @if (!$check)
                <span class="header_entrance_registr">
                    <a href="/public/login"  class="header_link entrance">Войти</a>
                    <a href="/public/registr" class="header_link registr">Зарегистрироваться</a>
                </span>
            @endif

            @if ($check)
                <span class="header_email_logout">
                    @auth('admin')
                        <span class="header_login">
                            {{$email}}
                        </span>
                    @endauth
                    @auth('web')
                        <span class="header_login">
                            <a href="/public/account/" class="header_login">{{$email}}</a>
                        </span>
                    @endauth

                    <a href="/public/logout" class="header_link exit">Выйти</a>
                </span>
            @endif
        </div>









    </div>
</header>
