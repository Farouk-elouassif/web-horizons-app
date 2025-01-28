<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Editeur - Tech Horizons</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{asset('css/respo_theme_dashboard.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    {{-- @include('user.profile_header') <br> --}}
    <main class="main-content">
        @include('editeur.navbar_editeur')
        <div class="dashboard-header">
            <h1>Editeur Dashboard</h1>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Total Abonnés</div>
                <div class="stat-value">{{$users->count()}}</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Total articles</div>
                <div class="stat-value">{{$articlesCount}}</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Total Numeros</div>
                <div class="stat-value">{{$numerosCount}}</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Total Themes</div>
                <div class="stat-value">{{$themesCount}}</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Total Responsables Themes</div>
                <div class="stat-value">{{$responsables}}</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Total Articles read</div>
                <div class="stat-value">{{$totalArticlesRead}}</div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="section-card">
                <div class="section-header">
                    <h2 class="section-title">Latest articles</h2>
                </div>
                <div class="article-list">
                    @foreach ($latestArticles as $article)
                        <div class="article-item">
                            <div class="article-header">
                                <div class="article-title"><a href="{{ route('article.show', $article->id) }}" target="_blank">{{$article->titre}}</a></div>

                            </div>
                            <div class="article-meta">
                                Par {{($article->author)->nom}} • Soumis {{$article->created_at->format('M d, Y - H:i')}} • In {{$article->theme->nom_theme}}
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="section-card2" style="height: auto">
                <div class="section-header">
                    <h2 class="section-title">Latest Users Joined</h2>
                </div>
                <div class="subscriber-list" >
                    @foreach ($latestUsers as $follower)
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

