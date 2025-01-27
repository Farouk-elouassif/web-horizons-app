<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{asset('css/analytics.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>
<body>
    @include('user.profile_header')

    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Articles read</h3>
                <div class="number">{{$articlesHistory}}</div>
            </div>
            <div class="stat-card">
                <h3>Topics Followed</h3>
                <div class="number">{{count($subscribedThemes)}}</div>
            </div>
            <div class="stat-card">
                <h3>Total Articles</h3>
                <div class="number">{{count($articles)}}</div>
            </div>
            <div class="stat-card">
                <h3>Average Ratings</h3>
                <div class="number">{{(int) $averageRating}}</div>
            </div>
        </div>

        <div class="content-grid">
            <div>
                <div class="topics-section">
                    <div class="topics-header">
                        <h2>Topics You Follow <span class="topic-count">({{count($subscribedThemes)}})</span></h2>
                    </div>
                    <div id="topicsList">
                        @foreach ($subscribedThemes as $subscribedTheme)
                            <div class="topic-item">
                                <span class="topic-name">{{ $subscribedTheme->nom_theme }}</span>
                                <form action="{{ route('user.deleteSub', $subscribedTheme->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="add-topic" style="margin-top: 15px;">
                        <p style="font-weight: bold;">Add Topic to your Topics:</p>
                        <form action="{{ route('user.addTheme') }}" method="POST">
                            @csrf
                            <select name="theme_id" id="unsubscribedThemes" class="dropdown-button">
                                @foreach ($unsubscribedThemes as $unsubscribedTheme)
                                    <option value="{{ $unsubscribedTheme->id }}">{{ $unsubscribedTheme->nom_theme }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn1">Add Topic</button>
                        </form>
                    </div>
                </div>
                <div style="margin-top: 25px;">
                    <select id="statusFilter" onchange="filterArticles()">
                        <option value="all">Tous les statuts</option>
                        <option value="Publié">Publiés</option>
                        <option value="EnCours">En Cours</option>
                        <option value="Refusé">Refusés</option>
                    </select>
                    <input type="text" id="searchInput" placeholder="Rechercher des articles..." oninput="filterArticles()">
                    <table style="margin-top: 25px;">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Topic</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="articlesTableBody">
                            @foreach ($articles as $article)
                                <tr>
                                    <td><a href="{{ route('article.show', $article->id) }}" target="_blank">{{$article->titre}}</a></td>
                                    <td>{{($article->theme)->nom_theme}}</td>
                                    <td>
                                        @if ($article->statut === 'Publié')
                                            <span class="status status-published">Publié</span>
                                        @elseif($article->statut === 'En cours')
                                            <span class="status status-review">EnCours</span>
                                        @elseif($article->statut === 'Refusé')
                                            <span class="status status-draft">Refusé</span>
                                        @endif
                                    </td>
                                    <td>{{$article->created_at->format('M d, Y - H:i')}}</td>
                                    <td class="actions" style="padding: 1.5rem">
                                        <form action="{{ route('article.destroy', $article->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete this post?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="sidebar">
                <div class="sidebar-card">
                    <h2>Popular Tags</h2>
                    @foreach ($subscribedThemes as $subscribedTheme)
                        <div class="tag">{{$subscribedTheme->nom_theme}}</div>
                    @endforeach

                </div>

                <div class="sidebar-card">
                    <h2>Views Over Time</h2>
                    <div class="chart-container">
                        Chart placeholder - Static version
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('js/analytics.js')}}"></script>

</body>
</html>
