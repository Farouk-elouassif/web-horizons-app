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
    <header class="header">
        <div class="header-content">
            <a href="/" class="logo">Tech Horizons</a>
            <div class="header-actions">
                <a href="/about" class="nav-link">About</a>
                <a href="/contact" class="nav-link">Contact</a>
                <a href="/write" class="write-btn">Write</a>
            </div>
        </div>
    </header>

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
            <article class="article">
                <div class="article-meta">
                    <a href="#" class="article-author">Sarah Chen</a>
                    <span>in</span>
                    <a href="#" class="article-author">AI Insights</a>
                </div>
                <a href="#" class="article-title">The Evolution of Machine Learning: From Theory to Practice</a>
                <p class="article-excerpt">A comprehensive look at how machine learning has transformed from academic research into practical applications that shape our daily lives. Understanding the key milestones and breakthrough moments in this journey.</p>
                <div class="article-footer">
                    <span>Jan 14, 2024</span>
                    <span>·</span>
                    <span>8 min read</span>
                </div>
            </article>

            <article class="article">
                <div class="article-meta">
                    <a href="#" class="article-author">James Wilson</a>
                    <span>in</span>
                    <a href="#" class="article-author">Web Architecture</a>
                </div>
                <a href="#" class="article-title">Microservices vs Monoliths: Making the Right Choice</a>
                <p class="article-excerpt">Exploring the advantages and drawbacks of different architectural approaches in modern web development. A practical guide to choosing the right architecture for your next project.</p>
                <div class="article-footer">
                    <span>Jan 13, 2024</span>
                    <span>·</span>
                    <span>6 min read</span>
                </div>
            </article>

            <article class="article">
                <div class="article-meta">
                    <a href="#" class="article-author">Elena Martinez</a>
                    <span>in</span>
                    <a href="#" class="article-author">Security First</a>
                </div>
                <a href="#" class="article-title">Zero Trust Architecture: Beyond the Buzzword</a>
                <p class="article-excerpt">Demystifying the concept of Zero Trust and providing practical implementation strategies for modern organizations. Understanding the principles that make this security model effective.</p>
                <div class="article-footer">
                    <span>Jan 12, 2024</span>
                    <span>·</span>
                    <span>10 min read</span>
                </div>
            </article>
        </div>
    </main>
</body>
</html>

