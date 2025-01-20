<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/homePageUserInvite.css')}}">
    <title>Home - Tech Horizons</title>
    <style>
        .hidden {
            display: none;
        }

        .nav-topics {
            width: 100%;
            overflow-x: auto; /* Enable horizontal scrolling */
            white-space: nowrap; /* Prevent wrapping of items */
            scrollbar-width: thin; /* For Firefox */
            scrollbar-color: #888 #f1f1f1; /* For Firefox */
        }

        /* WebKit-based browsers (Chrome, Safari) */
        .nav-topics::-webkit-scrollbar {
            height: px; /* Height of the horizontal scrollbar */
        }

        .nav-topics::-webkit-scrollbar-track {
            background: #f1f1f1; /* Color of the track */
            border-radius: 4px;
        }

        .nav-topics::-webkit-scrollbar-thumb {
            background: #888; /* Color of the scroll thumb */
            border-radius: 4px;
        }

        .nav-topics::-webkit-scrollbar-thumb:hover {
            background: #555; /* Color of the scroll thumb on hover */
        }

        /* Topics list styling */
        .topics-list {
            display: inline-block; /* Ensure items stay in a single line */
            padding: 5px 0;
        }

        .topic-link {
            display: inline-block;
            padding: 5px 12px;
            margin-right: 10px;
            background-color: #f1f1f1;
            border-radius: 20px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }

        .topic-link.active {
            background-color: black;
            color: #fff;
        }
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
                    </div>
                </article>
            @endforeach
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const topicLinks = document.querySelectorAll('.topic-link');
            const articles = document.querySelectorAll('.article');

            topicLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Remove active class from all links
                    topicLinks.forEach(link => link.classList.remove('active'));
                    // Add active class to the clicked link
                    this.classList.add('active');

                    const selectedTopic = this.getAttribute('data-topic');

                    articles.forEach(article => {
                        const articleTopic = article.getAttribute('data-topic');

                        if (selectedTopic === 'all' || articleTopic === selectedTopic) {
                            article.style.display = 'block';
                        } else {
                            article.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
