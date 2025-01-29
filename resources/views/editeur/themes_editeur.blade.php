<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Themes Manager - Tech Horizons</title>

    <link rel="stylesheet" href="{{ asset('css/respo_theme_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/subscribers_section.css') }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    @include('editeur.navbar_editeur')

    <div class="main-content">
        <h1 style="margin-bottom: 3rem">Tech Horizon Themes Manager ({{$themes->count()}})</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom Theme</th>
                    <th>Number of subscribers</th>
                    <th>Date_creation</th>
                    <th>Responsable</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="subscriptionsTableBody">
                @foreach ($themes as $theme)
                    <tr>
                        <td>{{$theme->nom_theme}}</td>
                        <td>{{$theme->subscribers->count()}}</td>
                        <td>{{$theme->created_at->format('M d, Y')}}</td>
                        <td>
                            @if ($theme->users->first())
                                {{$theme->users->first()->nom}}
                            @else
                                No Responsable
                            @endif
                        </td>
                        <td>
                            <form action="{{route('editeur.deleteTheme', $theme->id)}}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete?')">
                                    Delete Theme
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="add-theme-section" style="margin-top: 2rem">
            <h2 style="margin-bottom: 1rem">Ajouter un Nouveau Thème</h2>
            <form action="{{route('editeur.addTheme')}}" method="POST" class="theme-form">
                @csrf
                <label for="nom_theme">Nom du Thème:</label>
                <input type="text" id="nom_theme" name="nom_theme" required>
                <label for="nom_theme">Description:</label>
                <input type="text" id="description" name="description" style="width: 400px" required>
                <button type="submit" class="activate-btn">Ajouter Thème</button>
            </form>
        </div>
    </div>
</body>
</html>
