<button id="toggleSidebar" class="toggle-sidebar" style="margin-bottom: 10px">
    <i class="fas fa-bars"></i>
</button>
<nav class="sidebar" >
    <a href="/" class="logo" >Tech Horizons</a>
    <ul class="nav-list">
        <li class="nav-item active" >
            <a href="{{route('editeur.dashboard')}}" class="nav-link">
                <i class="fas fa-home"></i>
                Tableau de bord
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('editeur.users')}}" class="nav-link">
                <i class="fas fa-users"></i>
                Manage Users
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('editeur.articles')}}" class="nav-link">
                <i class="fas fa-newspaper"></i>
                Manage Articles
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('editeur.numeros')}}" class="nav-link">
                <i class="fa-solid fa-arrow-up-9-1"></i>
                Manage Numeros
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('editeur.themes')}}" class="nav-link">
                <i class="fa-regular fa-comment"></i>
                Manage Themes
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('user.articles')}}" class="nav-link">
                <i class="fa-solid fa-repeat"></i>
                Switch To User Mode
            </a>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="sign-out-btn">
                    <svg class="secondary-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sign Out
                </button>
            </form>
        </li>
    </ul>
</nav>
