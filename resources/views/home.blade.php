<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('favicon.jpeg') }}">
    <link rel="stylesheet" href="{{asset("css/home.css")}}">
</head>
<body>
    @include('home_header')
    <div class="bodyPage">
        <div id="backgim">
            <div class="bodyContent">
                <div class="TitlePage">
                    <p>Technologie</p>
                    <p>Stories & Ideas</p>
                </div>
            <p id="parag">A place to read, write, and deepen your understanding</p>
            <a href="{{route("register")}}" class="secbtn signup-btn">Start Reading</a>
        </div>
    </div>
    <footer>
        <ul class="listFooter">
            <li><a href="mailto:elouassiffarouk@gmail.com" target="_blank">Help</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Team</a></li>
            <li><a href="https://github.com/Farouk-elouassif/web-horizons-app.git" target="_blank">Github</a></li>
        </ul>
    </footer>
    </div>
    <script src="{{asset("js/Edit.js")}}"></script>
</body>
</html>
