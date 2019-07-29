<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pentip</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <base href="{{ url('/') }}">
</head>
<body>
    <div id="app">
        <ul>
            <!-- Authentication Links -->
                <li><a href="{{ route('home') }}">Home</a></li>
            @guest
                <li>
                    <a href="{{ route('login') }}">Login</a>
                </li>
                
                <li>
                    <a href="{{ route('register') }}">Register</a>
                </li>
            @else
                <li><a href="{{ route('users.show', auth()->user()->id) }}">My Profile</a></li>
                <li><a href="{{ route('posts.feed') }}">My Feed</a></li>
                <li><a href="{{ route('posts.create') }}">Create New Post</a></li>
                <li><a href="{{ route('users.notifications') }}">Notifications ({{ auth()->user()->unreadNotifications()->count() }})</a></li>
                <li>

                        <a  href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </li>
            @endguest
        </ul>

        <div>
            <form method="get" action="{{ route('posts.search') }}">
                <input type="search" name="search" id="search">
                <button type="submit">Search</button>
            </form>
        </div>

        <main>
            @yield('content')
        </main>
    </div>
    
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'baseUrl' => url('/')
        ]); ?>
    </script>
</body>
</html>
