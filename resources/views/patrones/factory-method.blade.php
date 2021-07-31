@extends('layout')
@section('titulo', 'Patrón Factory Method')

@section('contenido')
<form action="{{ route('factoryMethod', 'dompdf') }}" method="POST">
    <h2>Descargar con Dompdf</h2>
    @csrf
    <button>Descargar</button>
</form>

<form action="{{ route('factoryMethod', 'snappy') }}" method="POST">
    <h2>Descargar con Snappy</h2>
    @csrf
    <button>Descargar</button>
</form>
@endsection
