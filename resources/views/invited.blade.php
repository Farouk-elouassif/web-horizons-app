 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizons</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            line-height: 1.5;
            color: rgba(0, 0, 0, 0.8);
            background-color: rgb(236, 230, 224);
        }

        .header {
            padding: 1rem 2rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            background: rgb(236, 230, 224);;
            z-index: 100;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: black;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-link {
            text-decoration: none;
            color: rgba(0, 0, 0, 0.8);
            font-size: 0.95rem;
        }

        .write-btn {
            background-color: #000;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .nav-topics {
            padding: 0.75rem 2rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            background: rgb(236, 230, 224);;

        }

        .topics-list {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .topic-link {
            color: rgba(0, 0, 0, 0.6);
            text-decoration: none;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .topic-link.active {
            color: black;
            font-weight: 500;
        }

        .main-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        .articles {
            display: flex;
            flex-direction: column;
            gap: 3rem;
        }

        .article {
            padding-bottom: 3rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .article:last-child {
            border-bottom: none;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
        }

        .article-author {
            color: #000;
            font-weight: 500;
            text-decoration: none;
        }

        .article-title {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 0.75rem;
            color: #000;
            text-decoration: none;
            line-height: 1.3;
        }

        .article-title:hover {
            text-decoration: underline;
        }

        .article-excerpt {
            color: rgba(0, 0, 0, 0.7);
            font-size: 1.1rem;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .article-footer {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: rgba(0, 0, 0, 0.6);
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .header, .nav-topics {
                padding: 1rem;
            }

            .main-content {
                padding: 2rem 1rem;
            }

            .article-title {
                font-size: 1.5rem;
            }

            .article-excerpt {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    @include("home_header")

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

                    <a href="#" class="article-title">{{ $article->titre }}</a>
                    <!-- Display article excerpt -->
                    <p class="article-excerpt">{{ Str::limit($article->contenu, 150)}}</p>
                    <div class="article-footer">
                        <!-- Display formatted date -->
                        <span>{{$article->created_at->format('M d, Y')}}</span>
                        <span>·</span>
                        <!-- Display read time (if available) -->
                        <span>{{ $article->read_time ?? '5' }} min read</span>
                    </div>
                </article>
            @endforeach



        </div>
    </main>
</body>
</html>

