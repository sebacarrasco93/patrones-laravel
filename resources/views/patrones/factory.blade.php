@extends('layout')
@section('titulo', 'Patrón Factory')

@section('contenido')
<form action="{{ route('factory', 'dompdf') }}" method="POST">
    <h2>Descargar con Dompdf</h2>
    @csrf
    <button>Descargar</button>
</form>

<form action="{{ route('factory', 'snappy') }}" method="POST">
    <h2>Descargar con Snappy</h2>
    @csrf
    <button>Descargar</button>
</form>
@endsection
