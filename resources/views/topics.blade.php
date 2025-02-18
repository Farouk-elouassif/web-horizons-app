<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
  <title>Topics</title>
  <link rel="stylesheet" href="{{asset('css/topics.css')}}">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    @include('home_header')

    <!-- Topics Section -->
    <section class="topics">
        <div class="container">
            <h1>Explore Topics</h1>
        <div class="topics-grid">
            @foreach ($themes as $theme)
                <div class="topic-card">
                    <h2>{{$theme->nom_theme}}</h2>
                    <p>{{$theme->description}}</p>
                </div>
            @endforeach
        </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <ul class="listFooter">
            <li><a href="mailto:elouassiffarouk@gmail.com" target="_blank">Help</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Team</a></li>
            <li><a href="https://github.com/Farouk-elouassif/web-horizons-app.git" target="_blank">Github</a></li>
        </ul>
    </footer>
</body>
</html>
