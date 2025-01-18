<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/homePageUserInvite.css')}}">
    <title>Tech Horizons</title>
</head>
<body>
    @include("user.profile_header")

    <nav class="nav-topics">
        <div class="topics-list">
            <a href="#" class="topic-link active">All</a>
            <a href="#" class="topic-link">Artificial Intelligence</a>
            <a href="#" class="topic-link">Web Development</a>
            <a href="#" class="topic-link">Programming</a>
            <a href="#" class="topic-link">Data Science</a>
            <a href="#" class="topic-link">Cybersecurity</a>
            <a href="#" class="topic-link">Tech News</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="articles">
            @foreach ($articles as $article)
                <article class="article">
                    <div class="article-meta">
                        <a href="#" class="article-author">{{ optional($article->author)->nom ?? 'Unknown Author' }}</a>
                        <span>in</span>
                        <a href="#" class="article-author">{{ optional($article->theme)->nom_theme ?? 'Uncategorized' }}</a>
                    </div>
                    <a href="{{ route('login', $article->id) }}" class="article-title">{{ $article->titre }}</a>
                    <p class="article-excerpt">{{ Str::limit($article->contenu, 150)}}</p>
                    <div class="article-footer">
                        <span>{{$article->created_at->format('M d, Y')}}</span>
                        <span>·</span>
                        <span>{{ $article->read_time ?? '5' }} min read</span>
                    </div>
                </article>
            @endforeach



        </div>
    </main>
</body>
</html>

