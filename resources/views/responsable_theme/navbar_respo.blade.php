<button id="toggleSidebar" class="toggle-sidebar" style="margin-bottom: 10px">
    <i class="fas fa-bars"></i>
</button>
<nav class="sidebar" >
    <a href="/" class="logo" >Tech Horizons</a>
    <ul class="nav-list">
        <li class="nav-item active" >
            <a href="#" class="nav-link">
                <i class="fas fa-home"></i>
                Tableau de bord
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-newspaper"></i>
                Articles
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-users"></i>
                Abonnés
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-comments"></i>
                Conversations
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-chart-bar"></i>
                Statistiques
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('user.articles')}}" class="nav-link">
                <i class="fas fa-cog"></i>
                Switch To User Mode
            </a>
        </li>
    </ul>
</nav>
