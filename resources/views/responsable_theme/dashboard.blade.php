<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Responsable Thème - Tech Horizons</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{asset('css/respo_theme_dashboard.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    {{-- @include('user.profile_header') <br> --}}
    <main class="main-content">
        @include('responsable_theme.navbar_respo')
        <div class="dashboard-header">
            <h1>Dashboard Thème: {{ $theme->nom_theme }}</h1>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Total Abonnés</div>
                <div class="stat-value">{{$subscriberCount}}</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Total articles</div>
                <div class="stat-value">{{$articleCount}}</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Articles Publiés</div>
                <div class="stat-value">{{$articlePublieCount}}</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Articles Refusé</div>
                <div class="stat-value">{{$articleRefuseCount}}</div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="section-card">
                <div class="section-header">
                    <h2 class="section-title">Articles en Attente de Modération ({{$articleEnCourCount}})</h2>
                </div>
                <div class="article-list">
                    @foreach ($inProgressArticles as $article)
                        <div class="article-item">
                            <div class="article-header">
                                <div class="article-title"><a href="{{ route('article.show', $article->id) }}" target="_blank">{{$article->titre}}</a></div>

                            </div>
                            <div class="article-meta">
                                Par {{($article->author)->nom}} • Soumis {{$article->created_at->format('M d, Y - H:i')}}
                            </div>
                            <div class="btns">
                                <form action="{{ route('article.publish', $article->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit"  class="action-button" style="background-color: rgb(8, 117, 8)">Accept</button>
                                </form>
                                <form action="{{ route('article.deny', $article->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit"  class="action-button">Deny</button>
                                </form>
                                <form action="{{ route('article.destroy', $article->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-button" style="background-color: rgb(203, 11, 11)" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete this post?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="section-card2">
                <div class="section-header">
                    <h2 class="section-title">Nouveaux Abonnés</h2>
                </div>
                <div class="subscriber-list">
                    @foreach ($latestSubscribers as $follower)
                        <div class="subscriber-item">
                            <div class="subscriber-avatar"></div>
                            <div class="subscriber-info">
                                <div class="subscriber-name">{{$follower->nom}}</div>
                                <div class="subscriber-meta">Rejoint {{$follower->created_at->format('M d, Y - H:i')}}</div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </main>

    <script>
        // Toggle active class for nav items
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                navItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Toggle sidebar
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');

        toggleSidebar.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });
    </script>
</body>
</html>

