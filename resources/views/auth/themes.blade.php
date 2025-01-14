<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Horizons - Choose Your Themes</title>
    <link rel="stylesheet" href="{{ asset('css/themes.css') }}">
    <style>

    </style>
</head>
<body>
    <div class="theme-selection-container">
        <header>
            <h1>Welcome to Tech Horizons</h1>
            <p class="subtitle">Choose your favorite topics to personalize your experience.</p>
        </header>

        <form action="{{ route('subscriptions.store') }}" method="POST" id="theme-form">
            @csrf
            <div class="theme-list">
                @foreach($themes as $theme)
                    <div class="theme-card" data-theme-id="{{ $theme->id }}" data-theme-name="{{ $theme->name }}">
                        <h2>{{ $theme->nom_theme }}</h2>
                        <p>{{ $theme->description }}</p>
                    </div>
                @endforeach
            </div>

            <input type="hidden" name="themes" id="selected-themes">
            <button type="submit" id="submit-themes">Continue</button>
        </form>
    </div>

    <script>
        // JavaScript for Theme Selection
        document.addEventListener('DOMContentLoaded', function () {
            const themeCards = document.querySelectorAll('.theme-card');
            const selectedThemesInput = document.getElementById('selected-themes');
            let selectedThemes = [];

            themeCards.forEach(card => {
                card.addEventListener('click', () => {
                    card.classList.toggle('selected');
                    const themeId = card.getAttribute('data-theme-id');

                    if (selectedThemes.includes(themeId)) {
                        selectedThemes = selectedThemes.filter(id => id !== themeId);
                    } else {
                        selectedThemes.push(themeId);
                    }

                    selectedThemesInput.value = selectedThemes.join(',');
                });
            });
        });
    </script>
</body>
</html>
