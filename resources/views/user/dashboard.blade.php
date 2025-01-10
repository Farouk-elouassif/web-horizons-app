<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome to the User Dashboard</h1>
    <p>You are logged in as a user.</p>

    {{-- <form action="{{ route('logout') }}" method="POST"> --}}
    {{-- @csrf --}}
    {{-- <button type="submit">Logout</button> --}}
    <button><a href="{{route('createPoste.form')}}">Create Post</a></button>
    <button id="showPosts">Show My Posts</button>

    <div id="posts" style="display: none">
        @if($articles->isEmpty())
        <p>You have not created any articles yet.</p>
        @else
            <ul>
                @foreach($articles as $article)
                    <li>
                        <h2>{{ $article->titre }}</h2>
                        <p>{{ $article->contenu }}</p>
                        <small>Created at: {{ $article->created_at->format('Y-m-d H:i:s') }}</small>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</form>
<script src="{{asset('js/userDashboard.js')}}"></script>
</body>
</html>
