<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{asset('css/article.css')}}">
    <title>{{$article->titre }} | Tech Horizons</title>
    <style>
        .delete-btn button{
            background-color: rgb(216, 7, 7);
            border: none;
            padding: 10px;
            color: #fff;
            border-radius: 5px;
            margin-top: 10px;
            transition: all 0.5s linear
        }

        .delete-btn button:hover{
            background-color: rgb(166, 2, 2)
        }
    </style>
</head>
<body>
    @include('user.profile_header')

    <main class="article-container">
        <article>
            <header class="article-meta">
                <h1 class="article-title">{{$article->titre}}</h1>
                <p class="article-subtitle"></p>
                <div class="author-info">
                    <div class="author-avatar">{{strtoupper($article->author->nom[0].$article->author->nom[1])}}</div>
                    <div>
                        <p class="author-name">{{$article->author->nom}}</p>
                        <p class="publish-date">{{$article->created_at->format('M d, Y - H:i')}}</p>
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


    <div class="comments-section">
        @foreach ($comments as $comment)
            <div class="comment">
                <div class="avatar"></div>
                <div>
                    <div class="comment-author">
                        {{ ($comment->user)->nom }}
                    </div>
                    <div class="comment-content">{{ $comment->message }}</div>
                    <div class="comment-date">{{ $comment->created_at->format('M d, Y - H:i') }}</div>
                    @if($user->role === 'Responsable de thème' or $user->id == ($comment->user)->id)
                        <div class="delete-btn">
                            <form action="{{route('comment.destroy', $comment->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete Message</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <form id="comment-form" action="{{ route('user.conversation') }}" method="POST">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <textarea name="message" id="comment-text" placeholder="Join the conversation..." required></textarea>
            <button type="submit">Post</button>
        </form>
    </div>




    <script src="{{asset('js/article.js')}}"></script>
</body>
</html>
