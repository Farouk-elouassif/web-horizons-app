<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/article.css')}}">
    <title>{{$article->titre }}| Tech Horizons</title>

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
                    <li><a href="{{route('write.form')}}" target="_blank">Write</a></li>
                    <li><a href="#">Notifications</a></li>
                    <li><a href="#">Conversations</a></li>
                </ul>
            </nav>
            <div class="search-login">
                <div class="profile-image">
                    <span class="profile-initial">{{strtoupper($user->nom[0])}}</span>
                </div>
            </div>
            <button class="hamburger" onclick="toggleMenu()">☰</button>
        </div>
    </header>

    <main class="article-container">
        <article>
            <header class="article-meta">
                <h1 class="article-title">{{$article->titre}}</h1>
                <p class="article-subtitle"></p>
                <div class="author-info">
                    <div class="author-avatar">{{strtoupper($article->author->nom[0].$article->author->nom[1])}}</div>
                    <div>
                        <p class="author-name">{{$article->author->nom}}</p>
                        <p class="publish-date">{{$article->created_at->format('M d, Y')}}</p>
                        <p class="read-time">5 min read</p>
                    </div>
                </div>
            </header>


            <div class="article-content">
                <article>
                    {{$article->contenu}}
                </article>
            </div>

            <div class="rating" data-article-id="{{ $article->id }}">
                <form action="{{ route('rate.article') }}" method="POST" class="rating-form">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <input type="hidden" name="rating" value="0" class="rating-input">
                    <span class="star" data-value="1">&#9733;</span>
                    <span class="star" data-value="2">&#9733;</span>
                    <span class="star" data-value="3">&#9733;</span>
                    <span class="star" data-value="4">&#9733;</span>
                    <span class="star" data-value="5">&#9733;</span>
                    <span class="rating-value">({{ (int)$article->averageRating ?? 0 }})</span>
                </form>
            </div>
            <footer class="article-footer">
                <div class="tags">
                    <a href="#" class="tag">{{$article->theme->nom_theme}}</a>
                </div>

            </footer>
        </article>
    </main>
    <script src="{{asset('js/article.js')}}"></script>
</body>
</html>

