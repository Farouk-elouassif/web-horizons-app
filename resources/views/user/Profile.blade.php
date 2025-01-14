<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user->nom}} - Profile</title>
    <link rel="stylesheet" href="{{asset('css/Profile.css')}}">
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="#">Tech Horizons</a>
            <input type="search" name="" id="input_search" placeholder="Search">
        </div>
        <div class="rightside">
            <nav class="nav-links">
                <ul>
                    <li><a href="{{route('createPoste.form')}}">Write</a></li>
                    <li><a href="#">Notifications</a></li>
                    <li><a href="#">Conversations</a></li>
                </ul>
            </nav>
            <div class="search-login">
                <div class="profile-image">
                    <span class="profile-initial">{{$user->nom[0]}}</span>
                </div>
            </div>
            <button class="hamburger" onclick="toggleMenu()">☰</button>
        </div>
    </header>
    <div class="bodypage">
        <div class="leftpage">
            <div id="insideLeft">
                <div class="profile-card">
                    <div class="profile-image">
                        <span class="profile-initial">{{$user->nom[0]}}</span>
                    </div>
                <div class="profile-info">
                    <h2 class="profile-name">{{$user->nom}}</h2>
                    <p class="profile-date">{{$user->date_inscription}} <span class="icon-lock">🔒</span></p>
                </div>
                </div>
            </div>
            <div class="message-box" style="">
                <div id="posts" style="width: 700px; padding:10px">
                    @if($articles->isEmpty())
                        <p>
                            Add your favorite stories to your list. Simply click the
                            <span class="icon">📌</span>
                            on any Medium story to get started.
                        </p>
                    @else
                    <div class="article-list">
                        @foreach($articles as $article)
                            <div class="article-card" style="text-align: start">
                                <!-- Article Title -->
                                <h2>{{ $article->titre }}</h2>

                                <!-- Metadata -->
                                <div class="meta">
                                    <span>
                                        State:
                                        @if ($article->statut == 'Refusé')
                                            <span style="color: red">{{$article->statut}}</span>

                                        @elseif ($article->statut == 'En cours')
                                            <span style="color: gray">{{$article->statut}}</span>

                                        @elseif ($article->statut == 'Retenu')
                                            <span style="color: rgb(0, 183, 255)">{{$article->statut}}</span>
                                        @else
                                            <span style="color: green">{{$article->statut}}</span>
                                        @endif
                                    </span><br>
                                    <span>Date: {{ $article->created_at->format('M d, Y') }}</span>
                                </div>

                                <!-- Engagement Metrics -->
                                <div class="engagement">
                                    <span>1.1K Likes</span>
                                    <span>32 Comments</span>
                                </div>

                                <!-- Actions -->
                                <div class="actions">
                                    <a >
                                        <button>Update</button>
                                    </a>
                                    <form action="{{ route('article.delete', $article->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="rightpage">
        <div class="insideright">
            <div class="secprofile-info">
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
