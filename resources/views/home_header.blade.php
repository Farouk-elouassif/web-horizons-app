<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/home_header.css')}}">
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="#">Tech Horizons</a>
        </div>
        <div class="rightside">
            <nav class="nav-links">
                <ul>
                    <li><a href="{{route("topics")}}" target="_blank">Topics</a></li>
                    <li><a href="{{route("about")}}" target="_blank">About</a></li>
                    <li><a href="{{route("login")}}" class="login-btn">Sign In</a></li>
                </ul>
            </nav>
            <div class="search-login">
                <a href="{{route("register")}}" class="btn signup-btn">Get started</a>
            </div>
            <button class="hamburger" onclick="toggleMenu()">☰</button>
        </div>
    </header>
</body>
</html>
