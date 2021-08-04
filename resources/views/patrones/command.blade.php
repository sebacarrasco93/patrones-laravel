@extends('layout')
@section('titulo', 'Patrón Command')

@section('contenido')
    @foreach ($users as $user)
        <form action="{{ route('command', $user) }}" method="POST">
            @csrf
            <ul>
                <li>{{ $user->name }}</li>
            </ul>
            <input id="name" name="name" placeholder="Nombre" type="text">
            <button>Acualizar</button>
        </form>
@endforeach
@endsection
