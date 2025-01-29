<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numeros Manager - Tech Horizons</title>

    <link rel="stylesheet" href="{{ asset('css/respo_theme_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/subscribers_section.css') }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    @include('editeur.navbar_editeur')

    <div class="main-content">
        <h1 style="margin-bottom: 3rem">Tech Horizon Numeros Manager ({{$numeros->count()}})</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom Numero</th>
                    <th>Statut</th>
                    <th>Date_creation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="subscriptionsTableBody">
                @foreach ($numeros as $numero)
                    <tr>
                        <td>{{$numero->titre_numero}}</td>
                        <td>{{$numero->statut}}</td>
                        <td>{{$numero->created_at->format('M d, Y')}}</td>
                        <td>
                            <form action="{{route('editeur.deleteNumero', $numero->Id_numero)}}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete?')">
                                    Delete
                                </button>
                            </form>
                            @if($numero->statut == 'Publié')
                                <form action="{{route('editeur.desactivateNumero', $numero->Id_numero)}}" method="POST" class="inline-form" style="margin: 2px">
                                    @csrf
                                    <button type="submit" class="block-btn" onclick="return confirm('Are you sure you want to desactivate?')">
                                        Desactivé
                                    </button>
                                </form>
                            @else
                                <form action="{{route('editeur.publieNumero', $numero->Id_numero)}}" method="POST" class="inline-form">
                                    @csrf
                                    <button type="submit" class="activate-btn" onclick="return confirm('Are you sure you want to delete?')">
                                        Publié
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="add-theme-section" style="margin-top: 2rem">
            <h2 style="margin-bottom: 1rem">Ajouter un Nouveau Numero</h2>
            <form action="{{route('editeur.addNumero')}}" method="POST" class="theme-form">
                @csrf
                <label for="nom_theme">Nom du Numero:</label>
                <input type="text" id="titre_numero" name="titre_numero" required>
                <button type="submit" class="activate-btn">Ajouter Numero</button>
            </form>
        </div>
    </div>
</body>
</html>
