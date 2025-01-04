<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Medium-like Header</title>
  <link rel="stylesheet" href="{{asset('css/Edit.css')}}">
</head>
<body>
  <header class="header">
    <div class="logo">
      <a href="#">Tech Horizons</a>
    </div>
    <div class="rightside">
        <nav class="nav-links">
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">Topics</a></li>
              <li><a href="#">About</a></li>
              <li><a href="{{route("login.form")}}" class="login-btn">Sign In</a></li>
            </ul>
          </nav>
          <div class="search-login">
            <a href="{{route("register")}}" class="btn signup-btn">Get started</a>
          </div>
          <button class="hamburger" onclick="toggleMenu()">☰</button>
    </div>
  </header>
  <div>

  </div>
  <script src="{{asset("js/Edit.js")}}"></script>
</body>
</html>
