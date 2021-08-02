@extends('layout')
@section('titulo', 'Patrón Pipeline')

@section('contenido')
@foreach ($users as $user)
    <form action="{{ route('pipeline', $user) }}" method="POST">
        @csrf
        <h2>{{ $user->name }}</h2>
        <div>
            Categoría: {{ $user->elegibleForCreditCard() }}
        </div>
        <div>
            <label>Monto:</label>
            <input name="balance" type="text" value="{{ $user->balance ?? 0 }}">
        </div>
        <button>Actualizar</button>
    </form>
@endforeach
@endsection
