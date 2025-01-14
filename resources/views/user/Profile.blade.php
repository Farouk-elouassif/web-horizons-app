<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user->nom}} - Profile</title>
    <link rel="stylesheet" href="{{asset('css/Profile.css')}}">
    <link rel="stylesheet" href="{{asset('css/post.css')}}">
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
                    <li><a href="{{route('write.form')}}" target="_blank">Write</a></li>
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
                        @foreach ($articles as $article)
                            <div class="article-cover">
                                <!-- Title -->
                                <h2>{{$article->titre}}</h2>

                                <!-- Metadata -->
                                <div class="meta">
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
                                    <span>•</span>
                                    <span>{{$article->created_at->format('M d, Y')}}</span>
                                    <span>•</span>
                                    <span>{{$article->theme->nom_theme}}</span>
                                </div>

                                <!-- Call-to-Action Button -->
                                <a href="#" class="cta-button">Read Article</a>
                                <form action="{{ route('article.delete', $article->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete this post?')" style="background-color: rgb(224, 11, 11);">Delete</button>
                                </form>
                            </div>
                        @endforeach
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
