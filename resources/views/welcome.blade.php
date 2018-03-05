<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    SPORTS TOURNAMENTS
                </div>
                @auth
                <div class="links">
                    
                    <?php if (\Auth::user()->status==1): ?>
                        <!--</div><a href="/admin/registers/create">Register team to a tournament</a>-->
                        <a href="/admin/tournaments/create">Create New tournament</a>
                        <a href="/admin/registers">Teams in tournaments</a>
                        <a href="/admin/tournaments">Tournaments</a>
                        <a href="/admin/teams">Teams</a>
                        <a href="/admin/users">Accounts</a>
                    <?php else: ?>
                        <a href="{{ url('new-team') }}">Create new team </a>
                        <a href="/new-register">Register team to a tournament</a>
                    <?php endif ?>
                </div>
                @endauth
            </div>
        </div>
    </body>
</html>
