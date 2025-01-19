<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user->nom}} - Profile</title>
    <link rel="stylesheet" href="{{asset('css/Profile.css')}}">
    <link rel="stylesheet" href="{{asset('css/post.css')}}">
    <style>
        .quick-actions {
            background: rgb(236, 230, 224);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: fixed;
            width: 35%
        }

        .quick-actions h3 {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 16px;
            color: #292929;
            margin: 0 0 15px 0;
        }

        .action-button {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 12px;
            margin-bottom: 8px;
            border: none;
            border-radius: 4px;
            background: #f8f8f8;
            cursor: pointer;
            text-align: left;
            color: #292929;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 14px;
            transition: background 0.2s ease;
        }

        .action-button:last-child {
            margin-bottom: 0;
        }

        .action-button:hover {
            background: #f0f0f0;
        }

        .action-button i {
            margin-right: 12px;
            color: #757575;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .action-divider {
            height: 1px;
            background: #e6e6e6;
            margin: 12px 0;
        }
    </style>
</head>
<body>
    @include('user.profile_header')
    <div class="bodypage">
        <div class="leftpage">
            <div id="insideLeft">
                <div class="profile-card">
                    <div class="profile-img">
                        <span class="profile-initial">{{strtoupper($user->nom[0])}}</span>
                    </div>
                <div class="profile-info">
                    <h2 class="profile-name">{{$user->nom}}</h2>
                    <p class="profile-date">{{$user->created_at->format('M d, Y')}} <span class="icon-lock">🔒</span></p>
                </div>
                </div>
            </div>
            <div class="mesage-box" style="">
                <h4>Your Articles</h4>
                <div id="posts" style="width: 700px; padding:10px">
                    @if($articles->isEmpty())
                        <p class="msg">You dont have any Artics yet</p>
                    @else
                    <div class="articles">
                        @foreach ($articles as $article)
                            <article class="article">
                                <div class="article-meta">
                                    <span ><strong>In</strong></span>
                                    <a href="#" class="article-author">{{ optional($article->theme)->nom_theme ?? 'Uncategorized' }}</a>
                                </div>
                                <a href="{{ route('article.show', $article->id) }}" class="article-title">{{ $article->titre }}</a>
                                <p class="article-excerpt">{{ Str::limit($article->contenu, 150)}}</p>
                                <div class="article-footer">
                                    <span>{{$article->created_at->format('M d, Y')}}</span>
                                    <span>·</span>
                                    <span>{{ $article->read_time ?? '5' }} min read</span>
                                    <span>·</span>
                                    <span>
                                        State:
                                        @if ($article->statut == "Refusé")
                                            <span style="color: red">{{$article->statut}}</span>
                                        @elseif ($article->statut == "En cours")
                                        <span style="color: grey">{{$article->statut}}</span>
                                        @elseif ($article->statut == "Retenu")
                                        <span style="color: rgb(10, 10, 207)">{{$article->statut}}</span>
                                        @else
                                        <span style="color: rgb(6, 101, 6)">{{$article->statut}}</span>
                                        @endif
                                    </span>
                                    <span>·</span>
                                    <span>
                                        <form action="{{ route('article.delete', $article->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-button" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete this post?')">Delete</button>
                                        </form>
                                    </span>
                                </div>
                            </article>
                        @endforeach



                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="rightpage">
        <div class="insideright">
            <div class="quick-actions">
                <h3>Quick Actions</h3>
                <button class="action-button">
                    <i class="fas fa-edit"></i>
                    New Story
                </button>
                <button class="action-button">
                    <i class="fas fa-cog"></i>
                    Account Settings
                </button>
                <button class="action-button">
                    <i class="fas fa-bookmark"></i>
                    Saved Stories
                </button>
                <div class="action-divider"></div>
                <button class="action-button">
                    <i class="fas fa-chart-line"></i>
                    Stats & Analytics
                </button>
                <button class="action-button">
                    <i class="fas fa-users"></i>
                    Manage Followers
                </button>
                <div class="action-divider"></div>
                <button class="action-button">
                    <i class="fas fa-moon"></i>
                    Dark Mode
                </button>
            </div>
        </div>
        <footer class="footer-links">
            <ul>
                <li><a href="#">Help</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Team</a></li>
                <li><a href="#">Github</a></li>
            </ul>

        </footer>
        </div>
    </div>
    <script src="Edit.js"></script>
</body>
</html>
