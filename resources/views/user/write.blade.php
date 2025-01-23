<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <title>Article Editor</title>
    <link rel="stylesheet" href="{{ asset('css/write.css') }}">
</head>
<body>
    @include('user.profile_header')
    <form action="{{ route('write.submit') }}" method="POST">
        @csrf
        <div class="editor-container">
            <header class="editor-header">
                <div class="dropdown">
                    <select name="theme" id="theme" class="dropdown-button">
                        @foreach($subscribedThemes as $subscribedTheme)
                            <option value="{{ $subscribedTheme->id }}">{{ $subscribedTheme->nom_theme }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="publish-button" type="submit">Publish</button>
            </header>
            <main class="editor-main">
                <input type="text" class="editor-title" placeholder="Title" name="title">
                <textarea class="editor-body" placeholder="Tell your story..." name="article"></textarea>
            </main>
            <footer class="editor-footer">
                <p>Select text to change formatting, add headers, or create links.</p>
            </footer>
        </div>
    </form>
</body>
</html>
