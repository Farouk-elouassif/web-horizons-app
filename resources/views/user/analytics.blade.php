<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/analytics.css')}}">
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
                <div class="trend">↑ 12% this month</div>
            </div>
            <div class="stat-card">
                <h3>Topics Followed</h3>
                <div class="number">1,245</div>
                <div class="trend">↑ 8% this month</div>
            </div>
            <div class="stat-card">
                <h3>Total Articles</h3>
                <div class="number">42</div>
                <div class="trend">+3 this month</div>
            </div>
            <div class="stat-card">
                <h3>Engagement Rate</h3>
                <div class="number">5.7%</div>
                <div class="trend negative">↓ 2% this month</div>
            </div>
        </div>

        <div class="content-grid">
            <div>
                <div class="recent-posts">
                    <h2>Articles</h2>
                    @foreach ($articles as $article)
                        <div class="post-item">
                            <div class="post-title">{{$article->titre}}</div>
                            <div class="post-stats">{{$article->statut}} · {{$article->theme->nom_theme}} · 23 comments</div>
                        </div>
                    @endforeach

                </div>

                <div class="topics-section">
                    <div class="topics-header">
                        <h2>Topics You Follow <span class="topic-count">(8)</span></h2>
                    </div>
                    <div class="add-topic">
                        <input type="text" placeholder="Enter a topic to follow..." id="topicInput">
                        <button class="btn btn-primary" onclick="addTopic()">Add Topic</button>
                    </div>
                    <div id="topicsList">
                        <div class="topic-item">
                            <span class="topic-name">Programming</span>
                            <button class="btn-delete" onclick="deleteTopic(this)">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="topic-item">
                            <span class="topic-name">Web Development</span>
                            <button class="btn-delete" onclick="deleteTopic(this)">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="topic-item">
                            <span class="topic-name">UX Design</span>
                            <button class="btn-delete" onclick="deleteTopic(this)">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="topic-item">
                            <span class="topic-name">Artificial Intelligence</span>
                            <button class="btn-delete" onclick="deleteTopic(this)">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar">
                <div class="sidebar-card">
                    <h2>Popular Tags</h2>
                    <div class="tag">Technology</div>
                    <div class="tag">Writing</div>
                    <div class="tag">Programming</div>
                    <div class="tag">Design</div>
                    <div class="tag">Productivity</div>
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
