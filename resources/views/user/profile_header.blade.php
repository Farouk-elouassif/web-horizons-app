<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/profile_header.css')}}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="">Tech Horizons</a>
            <input type="search" name="" id="input_search" placeholder="Search">
        </div>
        <div class="rightside">
            <nav class="nav-links">
                <ul>
                    <li><a href="{{route('user.articles')}}">Home</a></li>
                    <li><a href="{{route('write.form')}}" target="_blank">Write</a></li>
                    <li><a href="{{route('user.analytics')}}">Dashboard</a></li>
                    <li><a href="{{route('user.history')}}">Historiques</a></li>
                </ul>
            </nav>
            <div class="search-login">
                <div class="profile-image">
                    <span class="profile-initial"><a href="{{route('user.dashboard')}}">{{strtoupper($user->nom[0])}}</a></span>
                </div>
            </div>
            <button class="hamburger" onclick="toggleMenu()">☰</button>
        </div>
    </header>
</body>
</html>
