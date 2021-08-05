@extends('layout')
@section('titulo', 'Patrón State')

@section('contenido')
@foreach ($users as $user)
    <form action="{{ route('state', $user) }}" method="POST">
        @csrf
        <h2>{{ $user->name }}</h2>
        @if ($estado = $user->status)
            <div>
                @if ($estado == 'locked')
                    Estado: 🔒 Bloqueado
                @endif

                @if ($estado == 'unlocked')
                    Estado: 🔓 Desbloqueado
                @endif
            </div>
        @endif
        <button>Bloquear o desbloquear</button>
    </form>
@endforeach
@endsection
