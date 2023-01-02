<header class="">
    <div class="header _container container h-100" >

        <div class="header__content h-100 d-flex justify-content-sm-between align-content-center flex-wrap" style="flex-direction: row">

            @php
                $flag = false;
            @endphp
            @auth('admin')
                @php
                    $flag = true;
                @endphp
            @endauth

            @if ($flag)
                <a href="/admin" class="fa-solid fa-house header_link" style="color: white !important;"></a>
            @else
                <a href="/" class="fa-solid fa-house" style="color: white !important;"></a>


            @endif


            @if (!$check)
                <span class="header_entrance_registr">
                    <a href="/login"  class="header_link entrance me-5 header_link">Войти</a>
                    <a href="/registr" class="header_link registr header_link">Зарегистрироваться</a>
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
                            <a href="{{route('showAccount')}}" class="header_login header_link me-5">{{$email}}</a>
                        </span>
                    @endauth

                    <a href="/logout" class="header_link exit">Выйти</a>
                </span>
            @endif
        </div>









    </div>
</header>
