@extends('layout')

@section('contenido')
    <a href="{{ route('patrones.factory') }}">Factory</a>
    <a href="{{ route('patrones.factoryMethod') }}">Factory Method</a>
@endsection
