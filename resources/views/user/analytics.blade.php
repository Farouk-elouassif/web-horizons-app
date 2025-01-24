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
                <h3>Total Views</h3>
                <div class="number">23,578</div>
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
                <div class="recent-posts">
                    <h2>Articles</h2>
                    @foreach ($articles as $article)
                        <div class="post-item">
                            <div class="post-title">{{$article->titre}}</div>
                            <div class="post-stats">{{$article->statut}} · {{$article->theme->nom_theme}}</div>
                        </div>
                    @endforeach

                </div>

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
