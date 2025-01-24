<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <title>{{$user->nom}} - Profile</title>
    <link rel="stylesheet" href="{{asset('css/Profile.css')}}">
    <link rel="stylesheet" href="{{asset('css/post.css')}}">
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
                <h4 class="your-articles">Your Articles</h4>
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
                                    <span class="rating-value">Average Rating: {{ (int)$article->averageRating ?? 0 }}</span>
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
                    <div class="quick-actions-header">
                        <h2 class="quick-actions-title">Quick Actions</h2>
                    </div>

                    <div class="primary-actions">
                        <button class="primary-action-btn">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <span style="font-size: 0.75rem; margin-top: 4px;"><a href="{{route('write.form')}}">New Story</a></span>
                        </button>
                        <button class="primary-action-btn">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span style="font-size: 0.75rem; margin-top: 4px;"><a href="{{route('user.history')}}">My History</a></span>
                        </button>
                    </div>

                    <div class="separator"></div>

                    <div class="secondary-actions">
                        <button class="action-btn">
                            <svg class="secondary-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            Notifications
                        </button>
                        <button class="action-btn">
                            <svg class="secondary-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                            Reading List
                        </button>
                        <button class="action-btn">
                            <svg class="secondary-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                            Share Profile
                        </button>
                        <button class="action-btn">
                            <svg class="secondary-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Settings
                        </button>
                    </div>

                    <div class="separator"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="sign-out-btn">
                                <svg class="secondary-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Sign Out
                            </button>
                        </form>
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
