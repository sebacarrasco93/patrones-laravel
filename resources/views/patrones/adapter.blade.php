@extends('layout')
@section('titulo', 'Patrón Adapter')

@section('contenido')
    @foreach ($users as $user)
        <ul>
            <li>
                {{ $user->name }}
            </li>
        </ul>
    @endforeach

    <form action="{{ route('adapter') }}" method="POST">
        @csrf
        <div>
            <h2>Agregar nueva persona</h2>
        </div>
        <div>
            <label for="name">Nombre:</label>
            <input name="name" id="name" type="text" placeholder="Nombre">
        </div>
        <div>
            <label for="email">Email:</label>
            <input name="email" id="email" type="email" placeholder="Email">
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input name="password" id="password" type="password" placeholder="Contraseña">
        </div>
        <button>Agregar</button>
    </form>
@endsection
