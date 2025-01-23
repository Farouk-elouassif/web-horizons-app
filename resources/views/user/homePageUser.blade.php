<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{asset('css/homePageUserInvite.css')}}">
    <link rel="stylesheet" href="{{asset('css/post.css')}}">
    <title>Home - Tech Horizons</title>
    <style>

    </style>
</head>
<body>
    @include("user.profile_header")

    <nav class="nav-topics">
        <div class="topics-list">
            <a href="#" class="topic-link active" data-topic="all">All</a>
            @foreach ($subscribedThemes as $subscribedTheme)
                <a href="#" class="topic-link" data-topic="{{$subscribedTheme->nom_theme}}">{{$subscribedTheme->nom_theme}}</a>
            @endforeach
        </div>
    </nav>

    <main class="main-content">
        <div class="articles">
            @foreach ($shuffledArticles as $article)
                <article class="article" data-topic="{{ optional($article->theme)->nom_theme ?? 'Uncategorized' }}">
                    <div class="article-meta">
                        <a href="#" class="article-author">{{ optional($article->author)->nom ?? 'Unknown Author' }}</a>
                        <span>in</span>
                        <a href="#" class="article-author">{{ optional($article->theme)->nom_theme ?? 'Uncategorized' }}</a>
                    </div>
                    <a href="{{ route('article.show', $article->id) }}" class="article-title">{{ $article->titre }}</a>
                    <p class="article-excerpt">{{ Str::limit($article->contenu, 150)}}</p>
                    <div class="article-footer">
                        <span>{{$article->created_at->format('M d, Y')}}</span>
                        <span>·</span>
                        <span>{{ $article->read_time ?? '5' }} min read</span>
                        <span>·</span>
                        <span class="rating-value">Average Rating: {{ (int)$article->averageRating ?? 0 }}</span>
                    </div>
                    <!-- Rating Section -->
                    <div class="rating" data-article-id="{{ $article->id }}">

                    </div>
                </article>
            @endforeach
        </div>
    </main>



        <script src="{{asset('js/homePageUser.js')}}"></script>

</body>
</html>
