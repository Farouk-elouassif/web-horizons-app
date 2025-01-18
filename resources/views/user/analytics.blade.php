<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: rgb(236, 230, 224);
            color: #292929;
            line-height: 1.6;
        }

        .navbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #292929;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .stat-card h3 {
            color: #757575;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .stat-card .number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .stat-card .trend {
            color: #03A678;
            font-size: 0.9rem;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        .recent-posts {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }

        .post-item {
            padding: 1rem 0;
            border-bottom: 1px solid #E6E6E6;
        }

        .post-item:last-child {
            border-bottom: none;
        }

        .post-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .post-stats {
            color: #757575;
            font-size: 0.9rem;
        }

        .sidebar-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }

        .tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: #E6E6E6;
            border-radius: 15px;
            margin: 0.25rem;
            font-size: 0.9rem;
        }

        .chart-container {
            width: 100%;
            height: 200px;
            margin-top: 1rem;
            background: #E6E6E6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #757575;
        }

        .trend.negative {
            color: #DC2626;
        }

        /* New styles for topic management */
        .topics-section {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .topics-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .add-topic {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .add-topic input {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #E6E6E6;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.2s;
        }

        .btn-primary {
            background-color: #03A678;
            color: white;
        }

        .btn-primary:hover {
            background-color: #028c65;
        }

        .topic-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            border: 1px solid #E6E6E6;
            border-radius: 4px;
            margin-bottom: 0.5rem;
        }

        .topic-item:last-child {
            margin-bottom: 0;
        }

        .topic-name {
            font-weight: 500;
        }

        .topic-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-delete {
            color: #DC2626;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.25rem;
        }

        .btn-delete:hover {
            color: #b91c1c;
        }

        .topic-count {
            color: #757575;
            font-size: 0.9rem;
            margin-left: 0.5rem;
        }
    </style>
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
                <h3>Followers</h3>
                <div class="number">1,245</div>
                <div class="trend">↑ 8% this month</div>
            </div>
            <div class="stat-card">
                <h3>Total Posts</h3>
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
                    <h2>Recent Posts</h2>
                    <div class="post-item">
                        <div class="post-title">How to Write Better Code</div>
                        <div class="post-stats">1,234 views · 89 likes · 23 comments</div>
                    </div>
                    <div class="post-item">
                        <div class="post-title">The Future of Web Development</div>
                        <div class="post-stats">2,341 views · 156 likes · 34 comments</div>
                    </div>
                    <div class="post-item">
                        <div class="post-title">Understanding JavaScript Promises</div>
                        <div class="post-stats">897 views · 67 likes · 12 comments</div>
                    </div>
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

    <script>
        function addTopic() {
            const input = document.getElementById('topicInput');
            const topicName = input.value.trim();

            if (topicName) {
                const topicsList = document.getElementById('topicsList');
                const topicItem = document.createElement('div');
                topicItem.className = 'topic-item';
                topicItem.innerHTML = `
                    <span class="topic-name">${topicName}</span>
                    <button class="btn-delete" onclick="deleteTopic(this)">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                topicsList.appendChild(topicItem);
                input.value = '';
                updateTopicCount();
            }
        }

        function deleteTopic(button) {
            button.closest('.topic-item').remove();
            updateTopicCount();
        }

        function updateTopicCount() {
            const count = document.querySelectorAll('.topic-item').length;
            document.querySelector('.topic-count').textContent = `(${count})`;
        }
    </script>
</body>
</html>
