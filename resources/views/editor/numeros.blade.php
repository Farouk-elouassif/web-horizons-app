@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Your Numeros</h1>
    @foreach($numeros as $numero)
        <div>
            <h2>{{ $numero->title }}</h2>
            <p>{{ $numero->content }}</p>
            <form action="{{ route('editor.deleteNumero', $numero->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('editor.showNumero', $numero->id) }}">View</a>
        </div>
    @endforeach
</div>
@endsection
