<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{asset('css/history.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historiques - Tech Horizons</title>
    <style>

    </style>
</head>
<body>
    @include('user.profile_header')
    <main class="main-content">
        <div class="history-header">
            <h1>Reading History</h1>
            <div class="history-stats">
                <span>Articles read: {{count($articlesHistory)}}</span>
                <span>•</span>
                <span>Last 30 days</span>
            </div>
        </div>

        <div class="article-grid">
            @foreach ($articlesHistory as $article)
                <div class="article-card">
                    <div class="article-meta">
                        <span>Read on {{$article->created_at->format('M d, Y')}}</span>
                        <span>•</span>
                        <span>5 min read</span>
                    </div>
                    <a href="#" class="article-title">{{$article->article->titre}}</a>
                    <p class="article-excerpt">{{ Str::limit($article->article->contenu, 150)}}</p>
                    <div class="article-footer">
                        <span>By {{($article->article->author)->nom}}</span>
                        <span class="tag">{{($article->article->theme)->nom_theme}}</span>
                    </div>
                </div>
            @endforeach



        </div>
    </main>

    <script>
        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add hover effect to article cards
        document.querySelectorAll('.article-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'transform 0.2s ease';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>
