<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/about.css')}}">
    <title>About</title>
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
                    <li><a href="{{route("about")}}">About</a></li>
                    <li><a href="{{route("login")}}" class="login-btn">Sign In</a></li>
                </ul>
            </nav>
            <div class="search-login">
                <a href="{{route("register")}}" class="btn signup-btn">Get started</a>
            </div>
            <button class="hamburger" onclick="toggleMenu()">☰</button>
        </div>
    </header>

    <main class="main-content">
        <section class="about-section">
            <h1>About Tech Horizons</h1>
            <p>Tech Horizons is a platform dedicated to exploring the cutting edge of technology and its impact on our world. We bring together thought leaders, innovators, and enthusiasts to share ideas, insights, and visions of the future.</p>
            <p>Our mission is to demystify complex technological concepts and make them accessible to a wider audience. We believe that understanding technology is crucial in navigating our rapidly changing world.</p>
            <p>At Tech Horizons, we cover a wide range of topics including artificial intelligence, blockchain, quantum computing, cybersecurity, and more. Our articles are written by experts in their fields, ensuring high-quality, accurate, and thought-provoking content.</p>
        </section>

        <section class="team-section">
            <h2>Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="team-member-avatar">FE</div>
                    <h3 class="team-member-name">Farouk El Ouassif</h3>
                    <p class="team-member-role">Data Analytics student</p>
                </div>
                <div class="team-member">
                    <div class="team-member-avatar">ZO</div>
                    <h3 class="team-member-name">Zakaria Ouchouch</h3>
                    <p class="team-member-role">Data Analytics student</p>
                </div>
                <div class="team-member">
                    <div class="team-member-avatar">SM</div>
                    <h3 class="team-member-name">Saad Mime</h3>
                    <p class="team-member-role">Data Analytics student</p>
                </div>
                <div class="team-member">
                    <div class="team-member-avatar">YB</div>
                    <h3 class="team-member-name">Youssef Belfalah</h3>
                    <p class="team-member-role">Data Analytics student</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
